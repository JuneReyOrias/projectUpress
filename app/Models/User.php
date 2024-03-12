<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table ="users";
    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'college',
        'department',
        'email',
        'contact',
        'password',
       'contact_no',
        'role',
        'cust_code',
    ];
// define the relationship of admin to users
public function admin(){
    return $this->hasOne(admin::class,'users_id')->withDefault();
}
// define the relationship of customer to users
public function customer(){
    return $this->hasOne(customer::class,'users_id')->withDefault();
}

// define the relationship of staff to users
public function staff(){
    return $this->hasOne(staff::class, 'users_id')->withDefault();
}

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
