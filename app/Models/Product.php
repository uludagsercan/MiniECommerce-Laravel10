<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        "name","description",
        "price","stock","picture","category_id"
    ];

    protected $casts=[
        "price"=>"float",
        "stock"=>"integer",
        "category_name"=>"integer",
        "category_id"=>"integer"
    ];
}
