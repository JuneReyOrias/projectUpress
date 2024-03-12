<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $guard ="admin";
    protected $table = "admin";
    protected $fillable = [
        'users_id',
        'name',
        'email',
        'password',
    ];
    // define relationship with users
    public function users(){
        return $this->belongTo(User::class, 'id','users_id')->withDefault();
    }

}
