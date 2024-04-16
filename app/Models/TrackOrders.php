<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackOrders extends Model
{
    use HasFactory;
    protected $table= "track_orders";

 

    protected $fillable=[

        'category',
        'description',
        'order_status',
    ];
    // Define the relationship with OrderListing
    public function orderListing()
    {
        return $this->belongsTo(OrderListing::class, 'order_listing_id');
    }
    public function user()
{
    return $this->belongsTo(User::class, 'users_id');
}

public function usersName()
   {
       return $this->belongsTo(User::class, 'users_id');
   }
   public function orderlist()
   {
       return $this->belongsTo(OrderListing::class, 'order_listing_id');
   }
}
