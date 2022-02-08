<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    //
    protected $table='governorates';
    public $timestamps=false;
    protected $guarded = [];

    public function getImageAttribute($value)
    {
        return asset('images/gov/' . $value);
    } // end of get image attribute
}
