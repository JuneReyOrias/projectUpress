<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStockOuts extends Model
{
    use HasFactory;

    protected $table="product_stock_outs";



    public function sizestockout()
    {
        return $this->belongsTo(Sizes::class, 'sizes_id');
    }

     // Define the inverse of the one-to-many relationship with Product
   public function productstockout()
   {
       return $this->belongsTo(Product::class, 'product_id');
   }
   public function userstockout()
   {
       return $this->belongsTo(User::class, 'users_id');
   }
}
