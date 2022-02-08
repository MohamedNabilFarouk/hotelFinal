<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomGallery extends Model
{
    //

    public function getImageAttribute($value)
    {
        return asset('images/hotels/rooms/' . $value);
    } // end of get image attribute
}

