<?php

namespace App\Repositories\API;

use Illuminate\Http\JsonResponse;

class BaseRepository
{
    public function apiJsonResponse($status, $success, $message, $data, $count = 0): object
    {
        if ($success == true) {
            if ($count > 0) {
                return new JsonResponse([
                    'status' => $status,
                    'success' => $success,
                    'data' => $data,
                    'message' => $message,
                    'count' => $count,
                ], $status);
            } else {
                return new JsonResponse([
                    'status' => $status,
                    'success' => $success,
                    'data' => $data,
                    'message' => $message,
                ], $status);
            }
        } else {
            return new JsonResponse([
                'status' => $status,
                'success' => $success,
                'message' => $message,
            ], $status);
        }
    }
}
