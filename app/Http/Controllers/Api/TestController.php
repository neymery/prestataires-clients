<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'API est prête et fonctionnelle',
            'timestamp' => now(),
            'version' => '1.0.0',
        ]);
    }
}
