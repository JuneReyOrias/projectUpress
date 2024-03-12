<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    // database linking
    protected $table= "purchase_order";
    
    protected $fillable=[
        'order_date',
        'users_id',
        'customer_id',
        'staff_id',
        'status',
        'required_date',
        'exp_div_date',
    ];
// relationship of users to purchase
    public function users(){
        return $this->belongsTo(User::class, 'users_id')->withDefault();
    }

    // relationship of customer to purchase
    public function customer(){
        return $this->belonsTo(Customer::class, 'customer_id')->withDefault();
    
    }
    // relationship of staff to purchase
    public function staff(){
        return $this->belonsTo(Staff::class, "staff_id")->withDefault();
    }
    
    // relationship of orderlisting to purchase
    public function orderListing(){
        return $this->hasManyThrough(OrderListing::class, 'order_listing_id')->withDefault();
    }
     

}
