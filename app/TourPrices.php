<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourPrices extends Model
{
    //
    protected $fillable=[
        'tour_id',
        'ip',
        'price',
        'ch_price',
    ];


    public function tour(){
        return $this->belongsTo(Tour::class , 'tour_id', 'id');
    }
}
