<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sizes extends Model
{
    use HasFactory;

    protected $table="sizes";
     protected $fillable=[
        'size_name'
     ];
     public function productStockColors()
     {
         return $this->belongsTo(ProductStockColors::class, 'sizes_id');
     }

     public function productStockouts()
{
    return $this->hasMany(ProductStockOuts::class, 'sizes_id');
}
}
