<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

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
        Response::macro('api', function ($success = true, $message = 'Success', $data = null, $code = 200) {
            return response()->json([
                'success' => $success,
                'message' => $message,
                'data' => $data,
            ], $code);
        });
    }
}
