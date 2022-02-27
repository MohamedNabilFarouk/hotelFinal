<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
// echo 'here';
// die();
        foreach($this->rooms as $room){
            if($request->adult >= $request->child ){
            if($room->type == 'space'){
                $number = ceil( ($request->adult + $request->child) / $room->max_guest) ;
            }else{
                $number = ceil( $request->adult / $room->adult) ;
            }
        }else{
            // echo 'con 2 <br>';
            // $recomm =  (($request->adult/$room->adult)+ ($request->child - $room->child)/($room->child+$room->adult));
            $number= ceil((($request->adult/$room->adult)+ ($request->child - $room->child)/($room->child+$room->adult))) ;
        }
    }
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
            "details"=>$this->hotelBooking,



        ];
    }
}
