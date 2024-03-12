<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;
    protected $table = "service_category";

    protected $fillable=[

        'category',
        'description',
    ];

    // relationship of serviceParameter to service category
    public function serviceParameter(){
        return $this->belongsTo(ServiceParameter::class, 'service_parameter_id')->withDefault();
    }
    public function serviceParameters()
    {
        return $this->hasMany(ServiceParameter::class);
    }

}
