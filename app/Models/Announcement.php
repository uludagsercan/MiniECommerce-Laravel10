<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable=[
        "id","product_id","announcement_title","announcement_description","product"
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
