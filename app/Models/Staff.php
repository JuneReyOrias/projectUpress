<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $guard ="staff";
    protected $table = "staff";
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
