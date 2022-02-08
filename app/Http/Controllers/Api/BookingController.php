<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use App\HotelBooking;
use App\Room;
use DB;
use DateTime;
use Validator;

class BookingController extends Controller
{

// public function booking(Request $request){
//      $data = $request -> validate([
//             'name' => 'required|string|max:100',
//             'phone' => 'string',
//             'email' => 'string|required|email',
//             'type' => 'string|required',
//             'from' => 'date|required',
//             'to' => 'date|required',
//             'adult' => 'string|required',
//             'child' => 'numeric|required',
//             'total' => 'numeric|required',
//             'deposit' => 'numeric',
//             'room_id'=>'required',
//             'number'=>'numeric|required',
//         ]);

      
//         $begin = new DateTime( $request->from);
//         $end   = new DateTime( $request->to );





// // for($i = $begin; $i < $end; $i->modify('+1 day'))
// //     {
// //         echo $i->format('Y-m-d');
// //     }
// // dd('here');

//         $data = $request->all();
//         DB::beginTransaction();

//         $booking= Booking::create($data);
//         $hotel_room = Room::find($request->room_id); 
//         if(isset($booking)){
//             for($i = $begin; $i < $end; $i->modify('+1 day'))
//             {   
//             HotelBooking::create([
//                 'room_id'        =>$request['room_id'],
//                 'booking_id'               =>$booking->id,
//                 'from'               => $i->format('Y-m-d'),
//                 'to'                 => $i->format('Y-m-d'),
//                  'remain_no'                  => ($hotel_room->number) - $request['number'],
//                 'number'                  => $request['number'],
//             ]);
//         }
//         } 
//         DB::commit();
        
//         return response()->json(['success'=>'true','message'=>'added successfully']);

// }




public function booking(Request $request){
   
    $validator = Validator::make($request->all(), [
           'name' => 'required|string|max:100',
           'phone' => 'string',
           'email' => 'string|required|email',
           'type' => 'string|required',
           'from' => 'date|required',
           'to' => 'date|required',
           'adult' => 'string|required',
           'child' => 'numeric|required',
           'total' => 'numeric|required',
           'deposit' => 'numeric',
        //    'room_id'=>'required',
        //    'number'=>'numeric|required',
       ]);
       if ($validator->fails()) {

        return response()->json(['success'=>'false', 'data'=>$validator->messages()]);
    }
    
     
       if($request->partial_payment == 1){
        $request->paid = $request->deposit; 
    }else{
      $request->paid = $request->total; 
    }
    // dd($request);


       $data = $request->all();
     

if($request->type == 'hotel'){


    $result= $this->checkAvailability($request);
    if($result == false){
       return response()->json(['success'=>'true','message'=>'Not Aavailable']);
    }

    DB::beginTransaction();
    $booking= Booking::create($data);

    $hotel_room = Room::find($request->room_id); 
    if(isset($booking)){
        HotelBooking::create([
            'room_id'        =>$request['room_id'],
            'booking_id'               =>$booking->id,
            'from'               => $request['from'],
            'to'                 => $request['to'],
             'remain_no'                  => ($hotel_room->number) - $request['number'],
            'number'                  => $request['number'],
          
        ]);
   
    } 
    DB::commit();
}else{

    $booking= Booking::create($data);

}
      
    //   payment here
     
       
       return response()->json(['success'=>'true','message'=>'added successfully']);

}




// not used NOW 
public function checkRoomInDate($room,$date){
                $no_rooms_booked=  HotelBooking::where([['room_id',$room],['from', $date]])->sum('number');
                $hotel_room = Room::find($room); 
                $no_rooms_available = ($hotel_room->number)-$no_rooms_booked;
                return $no_rooms_available;
}


public function checkAvailability(Request $request){
   
    $data = $request -> validate([
        'from' => 'required|string|max:100',
        'number' => 'required',
        'to' => 'string',
        'room_id' => 'string',
    ]);

    // $room_availabilty = HotelBooking::where([['room_id',$request->room_id]])->whereBetween('from', [$request->from, $request->to])->get();
    $no_rooms_booked = HotelBooking::where([['room_id',$request->room_id]])->whereBetween('from', [$request->from, $request->to])
                                                                        ->orWhereBetween('to', [$request->from, $request->to])->sum('number');
    
// dd($no_rooms_booked);
                                                                        
    $hotel_room = Room::find($request->room_id); 
    $no_rooms_available = ($hotel_room->number)-$no_rooms_booked; 
        // dd($no_rooms_available);
    if($request->number > $no_rooms_available){
        // return response()->json(['success'=>'true','message'=>'Not Aavailable']);
        return false;
   
        // foreach($room_availabilty as $f){
    //   $ava_no =  $this->checkRoomInDate($request->room_id, $f->from);
    //   if($ava_no < $request->number){
    //     return response()->json(['success'=>'true','message'=>'Not Aavailable in  '. \Carbon\Carbon::parse($f->from)->format('d-m-Y')]);
    //       break; 
    // //   }else{
    // //     echo $f->from .'--->'.$ava_no .'<br>';
    //   }
       
    // }
     
    
}else{
    // return response()->json(['success'=>'true','message'=>'Aavailable '. $no_rooms_available]);
    return $no_rooms_available;
}
} 


}