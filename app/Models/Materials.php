<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    use HasFactory;

    protected $table ="materials";

    protected $fillable=[

        'material_name',
    ];

    // relationship of materialstocklisting to material
    public function materialStockinglisting(){

        return $this->hasOne(MaterialStocklisting::class, 'materials_stocklisting_id');
    }
}
