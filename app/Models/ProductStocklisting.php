<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStocklisting extends Model
{
    use HasFactory;
    protected $table ="product_stocklisting";

    protected $fillable=[
        'product_id',
        'qty'

    ];

    // relationship of product to product stocklisting
    public function product(){
        return $this->belongsTo(Product::class, 'product_id')->withDefault();
    }
    public function orderListing(){
        return $this->hasMany(OrderListing::class,'order_listing_id')->withDefault();
    }
    
}
