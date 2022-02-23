<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelBooking extends Model
{
    //
    protected $guarded = [];
    public function room(){
        return $this->belongsTo(Room::class,'room_id','id');
    }
}
