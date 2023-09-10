<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class Info extends Controller
{
    public function index(Request $request)
    {
        $response = Http::withHeaders([
            'X-Authorization' => env('EVOTOR_KEY')
        ])->get('https://api.evotor.ru/api/v1/inventories/stores/search');
        $shops = $response->json();
        
        foreach ($shops as $shop) {
            \App\Models\Shops::firstOrCreate(
                ['uuid' =>  $shop['uuid']],
                ['name' => $shop['name']]
            );
        }
    }
    
    public function getCheck(Request $request)
    {
        $requestAll = $request->all();
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/info.log'),
        ])->info([
            'request' => $requestAll['data'],
            'items'  => $requestAll['data']['items']
        ]);
        foreach ($requestAll['data']['items'] as $item) {
            $format = new \DateTime($requestAll['data']['dateTime']);
            \App\Models\MainList::create([
                'name' => $item['name'],
                "shop" => $requestAll['data']['storeId'],
                "quantity" => $item['quantity'],
                "summ" => $item['sumPrice'],
                'datesell' => $format->format("Y-m-d H:i:s"),
                'productid' => $item['id']
            ]);
        }
    }
}
