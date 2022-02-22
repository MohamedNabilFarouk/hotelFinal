<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $guarded = [];

    public function service(){
        if($this->type == 'hotel'){
        return $this->belongsTo(Hotel::class,'object_id','id');
        }elseif($this->type == 'tour'){
            return $this->belongsTo(Tour::class,'object_id','id');

        }
    }
        public function hotel(){
            return $this->belongsTo(Hotel::class,'object_id','id');
        }
        public function tour(){
            return $this->belongsTo(Tour::class,'object_id','id');

        }
    public function customer(){
        return $this->belongsTo(User::class,'customer_id','id');
    }

    public function vendor(){
        return $this->belongsTo(User::class,'vendor_id','id');
    }
}
