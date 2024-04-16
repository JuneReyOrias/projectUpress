<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStockColors extends Model
{
    use HasFactory;
    protected $table="prodcut_stock_colors";



    // Define the relationship with Product
    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }

    // Define the relationship with Color
    public function colors()
    {
        return $this->belongsTo(Color::class);
    }

    // Define the relationship with Size
    public function sizes()
    {
        return $this->belongsTo(Sizes::class, 'sizes_id');
    }
  // Define the one-to-many relationship with Size
//   public function size()
//   {
//       return $this->hasMany(Sizes::class, 'prodcut_stock_colors_id');
//   }
   // Define the inverse of the one-to-many relationship with Product
   public function product()
   {
       return $this->belongsTo(Product::class, 'product_id');
   }
}
