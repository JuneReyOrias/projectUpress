<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table ="product";

    protected $fillable=[
        'product_id',
        'image',
        'product_name',
        'description',
       'unit_price',
       'stocks',
       'status',
       'prod_code',
 

    ];

    // relationship of productstocklisting to product
    public function productStocklisting(){
        return $this->hasOne(ProductStocklisting::class)->withDefault();

}

// Define a one-to-many relationship with ProductStockColors
public function productStockColors()
{
    return $this->hasMany(ProductStockColors::class, 'product_id');
}


  // Define relationship to the StockIns model
  public function stockIn()
  {
      return $this->hasMany(StockIns::class, 'product_id');
  }
}

class Size extends Model
{
 // Define relationship to the StockIns model
 public function stockIns()
 {
     return $this->hasMany(StockIns::class, 'sizes_id');
 }
 
 public function sizes()
 {
     return $this->belongsToMany(Sizes::class);
 }
 
}