<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class Main extends Controller
{

    public static function cmp($a, $b)
    {
        if ($a['quantity'] == $b['quantity']) {
            return 0;
        }
        return ($a['quantity'] < $b['quantity']) ? 1 : -1;
    }

    public function index(Request $request)
    {
        $data = \App\Models\MainList::with('shopname')->get();

        $shops = [];
        $shopList = [];
        foreach ($data as $d) {
            if (isset($shops[$d->shopname->name][$d->name])) {
                $shops[$d->shopname->name][$d->name]['quantity'] = $shops[$d->shopname->name][$d->name]['quantity'] + $d->quantity;
            } else {
                $shops[$d->shopname->name][$d->name]['quantity'] = $d->quantity;    
                $shops[$d->shopname->name][$d->name]['name'] = $d->name;
            }    
            $shopList[$d->shopname->name] = $d->shopname->id;
        }

        foreach ($shops as &$shop) {
            usort($shop, 'self::cmp');
        }
        
        return view('table', [
            'shops' => $shops,
            'shopslist' => $shopList
        ]);
    }
    
}