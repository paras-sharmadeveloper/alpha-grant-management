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
        // Sync Carbon timezone with the tenant/app timezone setting
        \Carbon\Carbon::setLocale(config('app.locale'));

        // Apply tenant timezone to Carbon on every request
        app()->booted(function () {
            try {
                $tz = function_exists('get_timezone') ? get_timezone() : config('app.timezone');
                \Carbon\Carbon::setTestNow(); // clear any test now
                date_default_timezone_set($tz);
                config(['app.timezone' => $tz]);
            } catch (\Exception $e) {
                // fallback silently
            }
        });
    }
}
