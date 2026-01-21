<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
        // Set default string length for MySQL compatibility
        Schema::defaultStringLength(191);

        // Enable query logging in development
        if (app()->environment('local')) {
            DB::listen(function ($query) {
                if ($query->time > 100) { // Log slow queries (>100ms)
                    logger()->warning('Slow Query: ' . $query->sql, [
                        'time' => $query->time . 'ms',
                        'bindings' => $query->bindings
                    ]);
                }
            });
        }

        // Performance optimizations for production
        if (app()->environment('production')) {
            // Disable debugbar if installed
            if (class_exists('\Barryvdh\Debugbar\ServiceProvider')) {
                $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            }

            // Optimize Eloquent
            \Illuminate\Database\Eloquent\Model::preventAccessingMissingAttributes();
            \Illuminate\Database\Eloquent\Model::preventSilentlyDiscardingAttributes();
        }
    }
}
