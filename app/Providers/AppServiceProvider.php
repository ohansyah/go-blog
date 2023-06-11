<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $this->logQuery();
    }

    private function logQuery(): void
    {
        if (env('DB_LOG_QUERIES') !== true) {
            return;
        }
        
        DB::listen(function ($query) {
            $sql = $query->sql;
            $bindings = $query->bindings;
            $time = $query->time;

            Log::info($sql . ';' . json_encode($bindings) . ';Time: ' . $time . 'ms');
        });
    }
}