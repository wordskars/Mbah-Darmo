<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'discount_type', 'discount_value',
        'banner_image', 'source', 'ai_strategy_text', 'is_active', 'valid_until',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'valid_until' => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * URL banner lengkap baik dari upload lokal maupun generator AI.
     */
    public function getBannerUrlAttribute(): ?string
    {
        if (empty($this->banner_image)) {
            return null;
        }

        if (str_starts_with($this->banner_image, 'http://') || str_starts_with($this->banner_image, 'https://')) {
            return $this->banner_image;
        }

        return asset('storage/'.$this->banner_image);
    }

    /**
     * Headline singkat (e.g. Combo Berkah, Weekend Special).
     */
    public function getHeadlineAttribute(): string
    {
        $source = $this->ai_strategy_text ?: $this->description;
        if (! empty($source) && preg_match('/HEADLINE:\s*(.+)/i', $source, $m)) {
            $headline = trim(preg_replace('/[*_"`]/', '', $m[1]));
            if (! empty($headline)) {
                return $headline;
            }
        }

        return 'Promo Spesial';
    }

    /**
     * Judul promo bersih tanpa embel-embel tag.
     */
    public function getCleanTitleAttribute(): string
    {
        $source = $this->ai_strategy_text ?: $this->description;
        if (! empty($source) && preg_match('/JUDUL:\s*(.+)/i', $source, $m)) {
            $clean = trim(preg_replace('/[*_"`]/', '', $m[1]));
            if (! empty($clean)) {
                return $clean;
            }
        }

        return $this->title ?: 'Promo Istimewa Warung Mbah Darmo';
    }

    /**
     * Narasi copywriting menggugah selera untuk etalase publik.
     */
    public function getCopywritingAttribute(): string
    {
        $source = $this->ai_strategy_text ?: $this->description;
        if (! empty($source) && preg_match('/COPYWRITING:\s*(.+)/i', $source, $m)) {
            $copy = trim(preg_replace('/[*_"`]/', '', $m[1]));
            if (! empty($copy)) {
                return $copy;
            }
        }

        if (! empty($this->description) && ! str_contains($this->description, 'HEADLINE:')) {
            return trim($this->description);
        }

        return 'Nikmati cita rasa autentik heritage Jawa khas Warung Mbah Darmo dengan penawaran terbaik hari ini!';
    }

    /**
     * Ringkasan strategi / keunggulan bundling jika ada.
     */
    public function getStrategyPreviewAttribute(): ?string
    {
        $source = $this->ai_strategy_text ?: $this->description;
        if (! empty($source) && preg_match('/STRATEGI:\s*(.+)/i', $source, $m)) {
            return trim(preg_replace('/[*_"`]/', '', $m[1]));
        }

        return null;
    }

    /**
     * Teks ajakan bertindak (CTA) untuk tombol promo.
     */
    public function getCtaTextAttribute(): string
    {
        $source = $this->ai_strategy_text ?: $this->description;
        if (! empty($source) && preg_match('/CTA:\s*(.+)/i', $source, $m)) {
            $cta = trim(preg_replace('/[*_"`]/', '', $m[1]));
            if (! empty($cta)) {
                return $cta;
            }
        }

        return 'Pesan Sekarang';
    }

    /**
     * Format label diskon yang ramah dan konsisten untuk badge UI.
     */
    public function getFormattedDiscountAttribute(): ?string
    {
        if (! empty($this->discount_value)) {
            $val = trim($this->discount_value);
            if (is_numeric($val)) {
                return "Diskon {$val}%";
            }
            if (str_ends_with($val, '%') && ! str_starts_with(strtolower($val), 'diskon')) {
                return "Diskon {$val}";
            }

            return $val;
        }

        $source = $this->ai_strategy_text ?: $this->description;
        if (! empty($source) && preg_match('/DISKON:\s*(.+)/i', $source, $m)) {
            $val = trim(preg_replace('/[*_"`]/', '', $m[1]));
            if (! empty($val)) {
                return is_numeric($val) ? "Diskon {$val}%" : $val;
            }
        }

        if ($this->discount_type === 'bundling') {
            return 'Paket Bundling Hemat';
        }

        return null;
    }
}
