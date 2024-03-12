<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceParameter extends Model
{
    use HasFactory;
    protected $table = "service_parameter";

    protected $fillable = [
        'service_category_id',
        'type',
        'size',
        'unit_price',

    ];

    public static function findById($id)
    {
        return static::find($id);
    }
    //  relationship of service
    // public function serviceCategory(){
    //     return $this->belongsTo(ServiceCategory::class, 'service_category_id')->withDefault();
    // }
    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }
}
