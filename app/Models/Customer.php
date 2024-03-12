<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guard ="customer";

    protected $table ="customer";

    protected $fillable=[
        'users_id',
        'college',
        'department',
        'funds',
    ];

    // define the relationship with users
    public function user(){
        return $this->belongTo(User::class, 'id','users_id')->withDefault();
    }
}
