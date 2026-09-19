<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (class_exists(\Composer\CaBundle\CaBundle::class)) {
            $caPath = \Composer\CaBundle\CaBundle::getSystemCaRootBundlePath();
            if ($caPath && file_exists($caPath)) {
                putenv('SSL_CERT_FILE=' . $caPath);
                putenv('CURL_CA_BUNDLE=' . $caPath);
                if (!ini_get('curl.cainfo')) {
                    @ini_set('curl.cainfo', $caPath);
                }
                if (!ini_get('openssl.cafile')) {
                    @ini_set('openssl.cafile', $caPath);
                }
            }
        }
    }
}
