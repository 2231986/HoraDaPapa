<?php

namespace backend\modules\api;

class ApiResponse
{
    public static function success($data = null, $message = 'Success')
    {
        return [
            'status' => 'success',
            'data' => $data,
            'message' => $message,
            'errors' => null,
        ];
    }

    public static function error($errors, $message = 'Error')
    {
        return [
            'status' => 'error',
            'data' => null,
            'message' => $message,
            'errors' => $errors,
        ];
    }
}
