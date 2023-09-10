<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
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
        $time = microtime(true);
        $data = \App\Models\MainList::with('shopname');
        if (!empty($request->input('cats'))) {
            $cats = $request->input('cats');
            $products = \App\Models\Products::whereIn('category', $cats)->select('name')->get();
            $names = [];
            foreach ($products as $pr) {
                $names[] = $pr->name;
            }
            $data->whereIn('name', $names);
        }
        $data = $data->get();

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

        $filter = [];
        $filter['categories'] = Categories::all()->keyBy('id');
        if (!empty($request->input('cats'))) {
            foreach ($request->input('cats') as $cat) {
                $filter['categories'][$cat]['active'] = 1;
            }
        }

        return view('table', [
            'shops' => $shops,
            'shopslist' => $shopList,
            'filter' => $filter
        ]);
    }

}
