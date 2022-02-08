<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpaceGallery extends Model
{
    //
    public function getImageAttribute($value)
    {
        return asset('images/spaces/' . $value);
    } // end of get image attribute
}
