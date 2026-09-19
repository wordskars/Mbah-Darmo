<?php

namespace App\Services;

use App\Models\Menu;
use Composer\CaBundle\CaBundle;
use DateTimeImmutable;
use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Throwable;

class FirebaseService
{
    protected ?Client $httpClient = null;
    protected ?array $serviceAccount = null;
    protected ?string $projectId = null;
    protected ?string $storageBucket = null;

    public function __construct()
    {
        $this->loadServiceAccount();
        $this->initHttpClient();
    }

    /**
     * Muat data kredensial service account dari file JSON.
     * Menggunakan absolute path fallback agar selalu ditemukan baik via CLI maupun Web Request.
     */
    protected function loadServiceAccount(): void
    {
        $configCreds = config('firebase.projects.app.credentials') ?: env('FIREBASE_CREDENTIALS');

        $candidates = array_filter([
            $configCreds && file_exists($configCreds) && !is_dir($configCreds) ? $configCreds : null,
            $configCreds ? base_path($configCreds) : null,
            storage_path('firebase/serviceAccountKey.json'),
            base_path('storage/firebase/serviceAccountKey.json'),
        ]);

        $resolvedPath = null;
        foreach ($candidates as $cand) {
            if ($cand && file_exists($cand) && !is_dir($cand)) {
                $resolvedPath = $cand;
                break;
            }
        }

        if ($resolvedPath) {
            $content = file_get_contents($resolvedPath);
            $this->serviceAccount = json_decode($content, true);
            $this->projectId = $this->serviceAccount['project_id'] ?? null;
        } else {
            Log::error('FirebaseService: File serviceAccountKey.json tidak ditemukan di lokasi manapun.');
        }

        $this->storageBucket = config('firebase.projects.app.storage.default_bucket') 
            ?: env('FIREBASE_STORAGE_DEFAULT_BUCKET', ($this->projectId ? $this->projectId . '.appspot.com' : null));
    }

    /**
     * Inisialisasi Guzzle Client dengan CA Root Bundle (mencegah error cURL 60 di Windows).
     */
    protected function initHttpClient(): void
    {
        $options = [
            'timeout' => 15,
        ];

        if (class_exists(CaBundle::class)) {
            $caPath = CaBundle::getSystemCaRootBundlePath();
            if ($caPath && file_exists($caPath)) {
                $options['verify'] = $caPath;
                putenv('SSL_CERT_FILE=' . $caPath);
                putenv('CURL_CA_BUNDLE=' . $caPath);
            }
        }

        $this->httpClient = new Client($options);
    }

    /**
     * Dapatkan OAuth2 Access Token dari Google API dengan caching.
     */
    public function getAccessToken(): ?string
    {
        if (!$this->serviceAccount) {
            $this->loadServiceAccount();
            if (!$this->serviceAccount) {
                return null;
            }
        }

        return Cache::remember('firebase_oauth2_access_token_v2', 3000, function () {
            try {
                $signer = new Sha256();
                $key = InMemory::plainText($this->serviceAccount['private_key']);
                $now = new DateTimeImmutable();
                $config = Configuration::forSymmetricSigner($signer, $key);

                $jwtToken = $config->builder()
                    ->issuedBy($this->serviceAccount['client_email'])
                    ->permittedFor('https://oauth2.googleapis.com/token')
                    ->issuedAt($now)
                    ->expiresAt($now->modify('+1 hour'))
                    ->withClaim('scope', 'https://www.googleapis.com/auth/datastore https://www.googleapis.com/auth/devstorage.full_control https://www.googleapis.com/auth/cloud-platform')
                    ->getToken($signer, $key)
                    ->toString();

                $response = $this->httpClient->post('https://oauth2.googleapis.com/token', [
                    'form_params' => [
                        'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                        'assertion'  => $jwtToken,
                    ],
                ]);

                $data = json_decode((string) $response->getBody(), true);
                return $data['access_token'] ?? null;
            } catch (Throwable $e) {
                Log::error('FirebaseService - Gagal mendapatkan Access Token: ' . $e->getMessage());
                return null;
            }
        });
    }

    /**
     * Upload file gambar ke Firebase Storage (dengan fallback lokal jika bucket belum aktif).
     */
    public function uploadMenuImage(UploadedFile $file, string $folder = 'menus'): string
    {
        $extension = $file->getClientOriginalExtension() ?: 'jpg';
        $filename = $folder . '/' . Str::uuid() . '.' . $extension;

        $token = $this->getAccessToken();

        // 1. Coba upload ke Firebase Storage jika token dan bucket tersedia
        if ($token && $this->storageBucket) {
            try {
                $uploadUrl = "https://storage.googleapis.com/upload/storage/v1/b/{$this->storageBucket}/o?uploadType=media&name=" . urlencode($filename);
                $mimeType = $file->getMimeType() ?: 'image/jpeg';

                $response = $this->httpClient->post($uploadUrl, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type'  => $mimeType,
                    ],
                    'body' => fopen($file->getRealPath(), 'r'),
                ]);

                if ($response->getStatusCode() === 200 || $response->getStatusCode() === 201) {
                    return "https://firebasestorage.googleapis.com/v0/b/{$this->storageBucket}/o/" . rawurlencode($filename) . "?alt=media";
                }
            } catch (Throwable $e) {
                Log::warning('Firebase Storage upload gagal. Menyimpan ke penyimpanan lokal: ' . $e->getMessage());
            }
        }

        // 2. Fallback: Simpan di local storage
        return $file->store('menus', 'public');
    }

    /**
     * Hapus gambar dari Firebase Storage atau local storage.
     */
    public function deleteImage(?string $imageUrl): void
    {
        if (empty($imageUrl)) {
            return;
        }

        try {
            if (Str::contains($imageUrl, 'firebasestorage.googleapis.com') || Str::contains($imageUrl, 'storage.googleapis.com')) {
                $token = $this->getAccessToken();
                if ($token && $this->storageBucket) {
                    $objectPath = null;
                    if (preg_match('/\/o\/([^?]+)/', $imageUrl, $matches)) {
                        $objectPath = urldecode($matches[1]);
                    } elseif (preg_match('/storage\.googleapis\.com\/[^\/]+\/(.+)$/', $imageUrl, $matches)) {
                        $objectPath = urldecode($matches[1]);
                    }

                    if ($objectPath) {
                        $deleteUrl = "https://storage.googleapis.com/storage/v1/b/{$this->storageBucket}/o/" . urlencode($objectPath);
                        $this->httpClient->delete($deleteUrl, [
                            'headers' => ['Authorization' => 'Bearer ' . $token],
                        ]);
                    }
                }
            } else {
                if (Storage::disk('public')->exists($imageUrl)) {
                    Storage::disk('public')->delete($imageUrl);
                }
            }
        } catch (Throwable $e) {
            Log::warning('Gagal menghapus gambar: ' . $e->getMessage());
        }
    }

    /**
     * Format nilai PHP ke format representasi field Firestore.
     */
    protected function formatFirestoreValue(mixed $value): array
    {
        if (is_null($value)) {
            return ['nullValue' => null];
        }
        if (is_bool($value)) {
            return ['booleanValue' => $value];
        }
        if (is_int($value)) {
            return ['integerValue' => (string) $value];
        }
        if (is_float($value)) {
            return ['doubleValue' => $value];
        }
        return ['stringValue' => (string) $value];
    }

    /**
     * Simpan / Perbarui data Menu ke Cloud Firestore.
     */
    public function syncMenuToFirestore(Menu $menu): bool
    {
        $token = $this->getAccessToken();
        if (!$token || !$this->projectId) {
            Log::error('FirebaseService - Tidak dapat menyinkronkan ke Firestore: Kredensial atau Project ID tidak ditemukan.');
            return false;
        }

        try {
            $docId = (string) $menu->id;
            $url = "https://firestore.googleapis.com/v1/projects/{$this->projectId}/databases/(default)/documents/menus/{$docId}";

            $fields = [
                'id'                      => $this->formatFirestoreValue((int) $menu->id),
                'category_id'             => $this->formatFirestoreValue((int) $menu->category_id),
                'name'                    => $this->formatFirestoreValue((string) $menu->name),
                'slug'                    => $this->formatFirestoreValue((string) $menu->slug),
                'price'                   => $this->formatFirestoreValue((float) $menu->price),
                'short_description_hover' => $this->formatFirestoreValue($menu->short_description_hover),
                'description'             => $this->formatFirestoreValue($menu->description),
                'image'                   => $this->formatFirestoreValue($menu->image),
                'spice_level'             => $this->formatFirestoreValue($menu->spice_level),
                'is_available'            => $this->formatFirestoreValue((bool) $menu->is_available),
                'is_featured'             => $this->formatFirestoreValue((bool) $menu->is_featured),
                'created_at'              => $this->formatFirestoreValue($menu->created_at?->toIso8601String() ?? now()->toIso8601String()),
                'updated_at'              => $this->formatFirestoreValue($menu->updated_at?->toIso8601String() ?? now()->toIso8601String()),
            ];

            $response = $this->httpClient->patch($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type'  => 'application/json',
                ],
                'json' => [
                    'fields' => $fields,
                ],
            ]);

            return $response->getStatusCode() === 200;
        } catch (Throwable $e) {
            Log::error('FirebaseService - Gagal menyimpan menu ke Cloud Firestore: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Hapus dokumen Menu dari Cloud Firestore.
     */
    public function deleteMenuFromFirestore(int|string $menuId): bool
    {
        $token = $this->getAccessToken();
        if (!$token || !$this->projectId) {
            Log::error('FirebaseService - Tidak dapat menghapus dari Firestore: Kredensial atau Project ID tidak ditemukan.');
            return false;
        }

        try {
            $docId = (string) $menuId;
            $url = "https://firestore.googleapis.com/v1/projects/{$this->projectId}/databases/(default)/documents/menus/{$docId}";

            $response = $this->httpClient->delete($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);

            return $response->getStatusCode() === 200;
        } catch (Throwable $e) {
            Log::error('FirebaseService - Gagal menghapus menu dari Cloud Firestore: ' . $e->getMessage());
            return false;
        }
    }
}
