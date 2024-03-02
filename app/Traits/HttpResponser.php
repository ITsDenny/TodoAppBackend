<?php

namespace App\Traits\HttpResponser;

trait HttpResponser
{

    public function sendJsonResponse($success = true, $code = 200, $data)
    {
        return response()->json(
            [
                'success' => $success,
                'status' => $code,
                'data' => $data
            ],
            200
        );
    }

    public function sendErrorResponse($success = false, $code = 500, $message)
    {
        return response()->json(
            [
                'success' => $success,
                'code' => $code,
                'message' => $message
            ]
        );
    }
}
