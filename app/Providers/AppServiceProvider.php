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

        // ULTRA PERFORMANCE OPTIMIZATIONS
        $this->optimizePerformance();

        // Enable query logging in development
        if (app()->environment('local')) {
            DB::listen(function ($query) {
                if ($query->time > 50) { // Log very slow queries (>50ms)
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

    private function optimizePerformance(): void
    {
        // Database connection optimizations
        DB::whenQueryingForLongerThan(500, function () {
            logger()->error('Query took longer than 500ms');
        });

        // Optimize SQLite database connections
        config(['database.connections.sqlite.foreign_key_constraints' => false]);
        config(['database.connections.sqlite.journal_mode' => 'WAL']);
        config(['database.connections.sqlite.synchronous' => 'NORMAL']);

        // ULTRA-FAST Cache optimizations - using file cache for maximum speed
        config(['cache.default' => 'file']);

        // ULTRA-FAST Session optimizations - using file sessions for speed
        config(['session.driver' => 'file']);
        config(['session.lifetime' => 120]);

        // Queue optimizations - using sync for development speed (no async overhead)
        config(['queue.default' => 'sync']);

        // Filesystem optimizations
        config(['filesystems.default' => 'local']);
        config(['filesystems.cloud' => 's3']);
    }
}
