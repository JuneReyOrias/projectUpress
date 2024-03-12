<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;
    protected $table ="service_order";

    protected $fillable=[
        'materials_stocklisting_id',
        'materails_id',
        'qty',
        'service_parameter_id',
        'service_category_id',
        'total_price',
        'file',
    ];
// relationship of materialsStocklisting to service order
    public function materialStocklisting(){
        return $this->belongsTo(MaterialStocklisting::class,)->withDefault();
    }

// relationship of service parameter to service order
public function serviceParameter(){
    return $this->belongsTo(ServiceParameter::class,)->withDefault();

}

public function orderListing(){
    return $this->hasMany(OrderListing::class,'order_listing_id')->withDefault();
}
}
