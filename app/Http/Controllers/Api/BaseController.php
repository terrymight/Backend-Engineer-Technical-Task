<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected function success($data = [], $message = 'Success', $code = 200)
    {
        return ApiResponse::success($data, $message, $code);
    }

    protected function error($message = 'Error', $code = 400, $data = [])
    {
        return ApiResponse::error($message, $code, $data);
    }
}
