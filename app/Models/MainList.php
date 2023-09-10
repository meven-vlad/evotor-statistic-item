<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainList extends Model
{
    use HasFactory;

    protected $table = 'main_list';
    
    protected $fillable = [
        'shop',
        'name',
        'quantity',
        'datesell',
        'productid',
        'summ',
    ];
    
    public function shopname()
    {
        return $this->hasOne(Shops::class, 'uuid', 'shop');
    }

}