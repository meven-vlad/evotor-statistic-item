<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shops extends Model
{
    use HasFactory;

    protected $table = 'shops';
    
    protected $fillable = [
        'uuid',
        'name',
    ];
}