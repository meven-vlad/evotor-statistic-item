<?php

namespace App\Lib;

use App\Models\Categories;
use App\Models\Products;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;

class MoySklad
{
    public function __construct()
    {
        $ms = new \Evgeek\Moysklad\MoySklad([env('MOYSKLAD_API')]);
        $this->ms = $ms;
    }

    public function getProducts()
    {
        $categories = Categories::all()->keyBy('name');
        $products = $this->ms->query()->entity()->product()->limit(100)->expand('productFolder')->getGenerator();
        foreach ($products as $product) {
            //dd($product);
            $pathes = explode("/", $product->pathName);
            if (!isset($categories[$pathes[0]]) || $categories[$pathes[0]]->id < 1) {
                Categories::create([
                    'name' => $pathes[0],
                    'category' => 0
                ]);
                $categories = Categories::all()->keyBy('name');
            }
            Products::firstOrCreate(
                [
                    'xml' => $product->id
                ],
                [
                    'category' => $categories[$pathes[0]]->id,
                    'name' => $product->name
                ]
            );
        }
    }
}
