<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    //
    protected $fillable=[
        'code',
        'parent_id',
        'child_id',
        
    ];
    public function parentuser(){
        return $this->belongsTo(User::class,'parent_id','id');
    }
    public function childuser(){
        return $this->belongsTo(User::class,'child_id','id');
    }
}
