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
use function MongoDB\BSON\toJSON;

class BookingControllerOld extends Controller
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
           'type' => 'string|required', // hotel || tour
           'from' => 'date|required',
           'to' => 'date|required',
           'adult' => 'string|required',
           'child' => 'numeric|required',
           'total' => 'numeric|required',
           'deposit' => 'numeric',
           'rooms' => 'nullable|array',
           'spaces' => 'nullable|array',
        //    'room_id'=>'required',
        //    'number'=>'numeric|required',
       ]);

       if ($validator->fails()) {
            return response()->json(['success'=>'false', 'data'=>$validator->messages()]);
       }


       if($request->partial_payment == 1){ // partial_payment 1 ==  deposit [else 0] paid total
            $request->paid = $request->deposit;
       }else{
            $request->paid = $request->total;
       }


       $data = $request->all();


    if($request->type == 'hotel'){


    $result = $this->checkAvailability($request);
    return response()->json(['success'=>'false',$request]);
    if($result['success'] == 'false'){
       return response()->json(['success'=>'false','message'=>'Not Aavailable']);
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

    $validator = Validator::make($request->all(), [
        'from' => 'required|string|max:100',
        'number' => 'required|required',
        'to' => 'required|string',
        'room_id' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['success'=>'false', 'data'=>$validator->messages()]);
    }

    $data = $request -> validate([
        'from' => 'required|string|max:100',
        'number' => 'required|required',
        'to' => 'required|string',
        'room_id' => 'required|string',
    ]);

    // $room_availabilty = HotelBooking::where([['room_id',$request->room_id]])->whereBetween('from', [$request->from, $request->to])->get();
    $no_rooms_booked = HotelBooking::where([['room_id',$request->room_id]])
        ->whereBetween('from', [$request->from, $request->to])
        ->orWhereBetween('to', [$request->from, $request->to])->sum('number');

// dd($no_rooms_booked);

    $hotel_room = Room::find($request->room_id);
    $no_rooms_available = ($hotel_room->number) - $no_rooms_booked;
        // dd($no_rooms_available);
    if($request->number > $no_rooms_available){
//         return response()->json(['success'=>'false','number'=>$no_rooms_available]);
        return  ['number'=>$no_rooms_available, 'success'=>'false'];

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
//     return response()->json(['success'=>'true', 'number'=> $no_rooms_available]);
        return  ['number'=>$no_rooms_available, 'success'=>'true'];
}
}


}
