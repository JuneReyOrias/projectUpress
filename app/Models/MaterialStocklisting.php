<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialStocklisting extends Model
{
    use HasFactory;
    
    protected $table= "materials_stocklisting";

    protected $fillable =[

        'materials_id',
        'qty',
    ];

    // relationship of materials to materialstocklisting
    public function materials(){
        return $this->belongsTo(Materials::class, 'materials_id')->withDefault();
    }

}
