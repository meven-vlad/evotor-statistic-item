<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Token extends Controller
{
    public function index(Request $request)
    {
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/error_analytics_birthday.log'),
        ])->info([
            'request' => $request->all(),
            'method'  => $request->method()
        ]);
    }
}
