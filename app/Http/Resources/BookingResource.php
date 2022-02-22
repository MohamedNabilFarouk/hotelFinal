<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        // $this->order_item;
    if($this->type == 'hotel'){
        $object_id = $this->hotel;
    }else{
        $object_id = $this->tour;

    }
        // $this->user;
        // return parent::toArray($request);
        return [




            "id"=> $this->id,
            "name"=>  $this->name,
            "email"=> $this->email,
            "phone"=> $this->phone,
            "type"=> $this->type,
            "vendor_id"=> $this->vendor_id,
            "customer_id"=> $this->customer_id,
            "object_id"=>$object_id,

            "from"=> $this->from,
            "to"=> $this->to,
            "adult"=> $this->adult,
            "child"=> $this->child,
            "total"=> $this->total,
            "partial_payment"=> $this->partial_payment,
            "deposit"=> $this->deposit,
            "paid"=> $this->paid,
            "note"=> $this->note,
            "is_paid"=> $this->is_paid,



        ];

        // return parent::toArray($request);
    }
}
