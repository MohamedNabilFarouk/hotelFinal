<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    //
    protected $table='governorates';
    public $timestamps=false;
    protected $guarded = [];
    protected $appends = [
        'name'
    ];

    public function getImageAttribute($value)
    {
        return asset('images/gov/' . $value);
    } // end of get image attribute

    public function getNameAttribute()
    {
        $lang = app()->getLocale();
        return $this[ 'name_'.$lang];

    } // end of title api app lang

}
