<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable=[
        'product_id' ,   
        'user_id',       
        'is_paid' ,      
        'payment_method',
        'name',       
        'address' ,      
        'phone',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
