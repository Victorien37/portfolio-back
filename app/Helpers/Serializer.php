<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class Serializer
{
    /**
     * success response method
     */
    public static function success(mixed $result, string $message, int $code = 200) : JsonResponse
    {
        $response = [
            'data'      => $result,
            'message'   => $message,
        ];

        return response()->json($response, $code);
    }

    /**
     * return error response.
     */
    public static function error(string $error, mixed $errorMessages = [], int $code = 404) : JsonResponse
    {
        $response = [
            'message' => $error,
        ];

        if ($errorMessages) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
