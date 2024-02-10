<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function setResponse($data = [], $message = "")
    {
        return response()->json([
            "data" => $data,
            "message" => $message,
        ]);
    }

    public function setResponseMessage($message = "")
    {
        return response()->json([
            "message" => $message,
        ]);
    }
}
