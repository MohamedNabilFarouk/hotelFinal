<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    //
    protected $guarded=[];
    public function getIconAttribute($value)
    {
        return asset('images/attributes/' . $value);
    } // end of get image attribute
}
