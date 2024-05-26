<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /**
         * This macros return the success API response
         */

        Response::macro('sendResponse', function (string $message, array $data, int $statusCode): JsonResponse {
            $response = [
                'success' => true,
                "statusCode" => $statusCode,
                'data' => $data,
                'message' => $message,

            ];
            return response()->json($response, $statusCode);
        });

        Response::macro('sendError', function (string $error, array $errorMessages = [], int $statusCode): JsonResponse {
            $response = [
                "success" => false,
                "statusCode" => $statusCode,
                "message" => $error,
                'errors' => $errorMessages
            ];

            return response()->json($response, $statusCode);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::enablePasswordGrant();
    }
}
