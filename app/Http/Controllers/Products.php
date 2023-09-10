<?php

namespace App\Http\Controllers;

use App\Lib\MoySklad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Products extends Controller
{
    public function index(Request $request)
    {
        $data = new MoySklad();
        dd($data->getProducts());
    }
}
