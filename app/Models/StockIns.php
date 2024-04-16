<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class StockIns extends Model
{
    use HasFactory;
    protected $table="stock_ins";

    // Define the fillable attributes (if you want mass assignment protection)
    protected $fillable = [
        'product_id',
        'sizes_id',
        'quantity',
        // Add any other fields that you want to allow mass assignment
    ];

    // Define relationship to the `Product` model    // Relationship with Size model (assuming one-to-one or many StockIns to one Size)
 

    // Relationship with Product model (assuming many StockIns to one Product)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }



    // Define relationship to the `Size` model
    public function size()
    {
        return $this->belongsTo(Sizes::class, 'sizes_id');
    }
}
