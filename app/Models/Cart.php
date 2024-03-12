<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table ="cart";

    protected $fillable=[
        'lastname',
        'firstname',
        'email',
        'college',
        'department',
        'contact_no',
        'image',
        'item_name',
        'type',
        'services',
        'type_services',
        'color',
        'sizeof',
        'unit',
        'quantity',
        'unit_price',
        'total_amount',
        'product_id',
        'service_category_id',
    ];
}
