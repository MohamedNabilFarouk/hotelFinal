<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SavedSearch extends Model
{
    //
    protected $guarded = [];

    public function city(){
        return $this->belongsTo(Governorate::class,'city','id');
    }
}
