<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use App\HotelBooking;
use App\Room;
use App\Hotel;
use App\User;
use App\VendorTransaction;
use Carbon\Carbon;
use DB;
use DateTime;
use App\Http\Resources\HotelResource;
use Illuminate\Support\Facades\Session;
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
    $country = $request->header('country') ? $request->header('country') : 'EG';
    config()->set('app.country', $country);

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:100',
        'phone' => 'string',
        'email' => 'string|required|email',
        'type' => 'string|required',
        'from' => 'date|required',
        'to' => 'date|required',
        'adult' => 'numeric|required',
        'child' => 'numeric|required',
        'total' => 'numeric|required',
        'deposit' => 'numeric',
        'rooms' => 'nullable|array',
        'spaces' => 'nullable|array',
    ]);

    if ($validator->fails()) {
        return response()->json(['success'=>'false', 'data'=>$validator->messages()]);
    }


    if($request->partial_payment == 1){
        $request->paid = $request->deposit;
    }else{
        $request->paid = $request->total;
    }

    if($request->type == 'hotel'){

        $request->rooms = array_merge($request->rooms, $request->spaces);

        DB::beginTransaction();
        $book = $request->only('name', 'phone', 'email', 'type', 'vendor_id', 'customer_id', 'object_id', 'from', 'to', 'adult', 'child', 'total', 'deposit', 'note', 'is_paid', 'partial_payment', 'paid');

        $booking = Booking::create($book);

        foreach($request->rooms as $r){
            //   dd($r['number']);
            $request['room_id'] =  $r['room_id'];
            $request['number'] = $r['number'];

            $result = $this->checkAvailability($request);
            if($result['success'] == 'false'){
                return response()->json(['success'=>'false','message'=>'Not Aavailable']);
            }


            $hotel_room = Room::find($r['room_id']);

            if(isset($booking)){

                // dd($r);
                HotelBooking::create([
                    'room_id'        =>$r['room_id'],
                    'booking_id'     =>$booking->id,
                    'from'           => $request['from'],
                    'to'              => $request['to'],
                    'remain_no'       => ($hotel_room->number) - $r['number'],
                    'number'          => $r['number'],
                ]);
            }
            DB::commit();
        }







}else{

    // $data = $request->all();

    // $booking= Booking::create($data);

//    $data = $request->all();
    $book = $request->only('name', 'phone', 'email', 'type', 'vendor_id', 'customer_id', 'object_id', 'from', 'to', 'adult', 'child', 'total', 'deposit', 'note', 'is_paid', 'partial_payment', 'paid');
//    return $book;
    $booking= Booking::create($book);


}

     //   payment here


             $country = "EG";
             $reference    =  $booking->id;
             Session::put('booking_id', $booking->id);

             $amount= [
                 "total"=> $booking->paid * 100, //$request->total
                 "currency"=> 'EGP',
             ];
             $product= [
                 "name"=> 'New Booking',
                 "description"=> 'xxxxxxxxxxxxxxxxx',
             ];
             $userInfo= [
                 "userEmail"=>$booking->email,
                 "userId"=>'',
                 "userMobile"=>$booking->phone,
                 "userName"=>$booking->name
             ];
             $returnUrl  = 'https://hoteelsegypt.com/';
             // $callbackUrl  = 'http://opayapi-001-site1.itempurl.com/api/payloads/OpayCallback';

             $cancelUrl  = 'https://hoteelsegypt.com/';
             // $userClientIP = '1.1.1.1';
             $expireAt = 30;
             $httpClient = new \GuzzleHttp\Client();
             // https://sandboxapi.opaycheckout.com/api/v1/international/cashier/create  //test mode
             // https://api.opaycheckout.com/api/v1/international/cashier/create  //live mode
             $response = $httpClient->request('POST', 'https://sandboxapi.opaycheckout.com/api/v1/international/cashier/create', [
                         'headers' => [
                             'Content-Type' => 'application/json',
                             'Accept'       => 'application/json',
                             'Authorization' => 'Bearer OPAYPUB16419035640800.28463034883201754', //test
                             //'Authorization' => 'Bearer OPAYPUB16419847297280.928306246565266', //live
                             'MerchantId' => '281822011132508' //test
                             //"MerchantId"=> "281822011276020", //live

                         ],
                         'body' => json_encode( [
                                         'country' => $country,
                                         'reference' => $reference,
                                         'amount' => $amount,
                                         // 'payMethod'=> 'BankCard',
                                         'product' => $product,
                                         'userInfo' => $userInfo,
                                         'returnUrl' => 'https://newhotels.hoteelsegypt.com/profile',
                                         'callbackUrl'=> 'https://newhotels.hoteelsegypt.com/api/OpayCallback',
                                         'cancelUrl' => 'https://newhotels.hoteelsegypt.com',
                                         // 'userClientIP' => $userClientIP,
                                         'expireAt' => $expireAt,
                                     ] , true)
             ]);
             // dd($response);
             $response = json_decode($response->getBody()->getContents(), true);
//               return $response;
             if($response['data']){
                 $paymentStatus = $response['data']; // get response values
                 $url= $paymentStatus['cashierUrl'];
//                    $html = '<iframe src="'.$paymentStatus['cashierUrl'].'"></iframe>';
//                 return redirect();
                    return response()->json(['success'=>'true','frame'=>$paymentStatus['cashierUrl']]);
//                    return $html;

             }else{
                 return response()->json(['success'=>'true','message'=>$response['message']]);
//                 return $response['message'];
             }



     // end payment




       return response()->json(['success'=>'true','message'=>'added successfully']);

}




// mobile booking api


public function mobileBooking(Request $request){
    $country = $request->header('country') ? $request->header('country') : 'EG';
    config()->set('app.country', $country);

    $validator = Validator::make($request->all(), [
           'name' => 'required|string|max:100',
           'phone' => 'string',
           'email' => 'string|required|email',
           'type' => 'string|required',
           'from' => 'date|required',
           'to' => 'date|required',
           'adult' => 'numeric|required',
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

if($request->type == 'hotel'){
    DB::beginTransaction();
    $book = $request->only('name', 'phone', 'email', 'type', 'vendor_id', 'customer_id', 'object_id', 'from', 'to', 'adult', 'child', 'total', 'deposit', 'note', 'is_paid', 'partial_payment', 'paid');

    $booking = Booking::create($book);

    foreach($request->rooms as $r){
        //   dd($r['number']);
        $request['room_id'] =  $r['room_id'];
        $request['number'] = $r['number'];

        $result = $this->checkAvailability($request);
//        return $result;
        if($result['success'] == 'false'){
            return response()->json(['success'=>'false','message'=>'Not Aavailable']);
         }


        $hotel_room = Room::find($r['room_id']);

        if(isset($booking)){

            // dd($r);
            HotelBooking::create([
                'room_id'        =>$r['room_id'],
                'booking_id'     =>$booking->id,
                'from'           => $request['from'],
                'to'              => $request['to'],
                'remain_no'       => ($hotel_room->number) - $r['number'],
                'number'          => $r['number'],

            ]);

        }
        DB::commit();
    }






}else{

$data = $request->all();
    $booking= Booking::create($data);

//    $data = $request->all();
    $book = $request->only('name', 'phone', 'email', 'type', 'vendor_id', 'customer_id', 'object_id', 'from', 'to', 'adult', 'child', 'total', 'deposit', 'note', 'is_paid', 'partial_payment', 'paid');
//    return $book;
    $booking= Booking::create($book);


}






    return response()->json(['success'=>'true','book'=>$booking->id]);

}




// end mobile booking api










// not used NOW
public function checkRoomInDate($room,$date){

                $no_rooms_booked=  HotelBooking::where([['room_id',$room],['from', $date]])->sum('number');
                $hotel_room = Room::find($room);
                $no_rooms_available = ($hotel_room->number)-$no_rooms_booked;
                return $no_rooms_available;
}


public function checkAvailability(Request $request){
    $lang = $request->header('lang') ? $request->header('lang') : 'en';
    app()->setLocale($lang);
    $country = $request->header('country') ? $request->header('country') : 'EG';
    config()->set('app.country', $country);

    // dd($request);

    $validator = Validator::make($request->all(), [
        'from' => 'required|date|after:yesterday',
        'to' => 'required|date|after:'.$request->from,
        'number' => 'required|required',
        'room_id' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return ['success'=>'false', 'data'=>$validator->messages()];
    }

    // $room_availabilty = HotelBooking::where([['room_id',$request->room_id]])->whereBetween('from', [$request->from, $request->to])->get();
    $no_rooms_booked = HotelBooking::where([['room_id',$request['room_id']]])
        ->whereBetween('from', [$request['from'], $request['to']])->sum('number');


// dd($no_rooms_booked);

    $hotel_room = Room::find($request['room_id']);

    $no_rooms_available = ($hotel_room->number)-$no_rooms_booked;
        // dd($no_rooms_available);
    if($request['number'] > $no_rooms_available){

        //  return response()->json(['success'=>'true','message'=>'Not Aavailable']);
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

    // return response()->json(['success'=>'true','message'=>'Aavailable '. $no_rooms_available]);
    return  ['number'=>$no_rooms_available, 'success'=>'true'];
}
}





public function Opaycallback(Request $request)
 {
     // dd($request);
 //    if($request->json){
 //        dd('done');
 //    }
//      $request['payload']['reference'];
//     return$booking= Booking::where('id','=',$request['payload']['reference'])->first();
     if($request['payload']['status'] == 'SUCCESS'){

         // updata is_paid and return to success page or Home Page
         $booking= Booking::where('id','=',$request['payload']['reference'])->first();
        //  $booking->status = 'completed';
         $booking->is_paid = 1;
         $booking->save();


//      // extra cal

//         //  $booking->sendNewBookingEmails();


//         //      // calculate balance
//              $vendor_id = $booking->vendor_id;
//              $trans = VendorTransaction::where('vendor_id',$vendor_id)->orderBy('updated_at', 'desc')->first();
//              if(isset($trans)){
//                      $withdrow_date= $trans->updated_at;
//         //              $booked_packages_total = RoomPackageBooking::where([['vendor_id',$vendor_id],['is_paid','1'],['updated_at','>',$withdrow_date]])->pluck('total')->sum();
//                      $booked_hotel_total = Booking::where([['vendor_id',$vendor_id],['is_paid','1'],['updated_at','>',$withdrow_date]])->pluck('total')->sum();

//              }else{
//         //          // dd('here');
//                  $withdrow_date = Carbon::now();
//         //          $booked_packages_total = RoomPackageBooking::where([['vendor_id',$vendor_id],['is_paid','1']])->pluck('total')->sum();
//                  $booked_hotel_total = Booking::where([['vendor_id',$vendor_id],['is_paid','1']])->pluck('total')->sum();
//              }

//              $balance_before =   $booked_hotel_total;
//              $balance_after = $balance_before - ($balance_before * .1);
//                          $vendor= User::where('id',$vendor_id)->first();
//                          if(isset($vendor)){
//                              $vendor->balance = $balance_after;
//                              $vendor->save();
//                          }
//              // end calculate balance

//  // end extra cal


      return 'success';
 }else{
     return 'Error';
 }


        }

    public function recommendations(Request $request){
        // $adult_guest >= $children_guest ?  ceil(( $adult_guest / $room_adults)):  ceil(($adult_guest/$room_adults) + ($children_guest - $room_children)/($room_children+$room_adults)),
        // $hotel = Hotel::find($request->hotel_id);


        $hotel = Hotel::where('id',$request->hotel_id)->with('rooms')->first();
        $recomm = array();
        //  return($hotel->rooms);
        foreach($hotel->rooms as $room){
            if($request->adult >= $request->child ){
                // echo ' con 1 <br>';
                if($room->type == 'space'){
                    $recomm[] =  ['room'=>$room ,'number'=>ceil( ($request->adult + $request->child) / $room->max_guest) ];
                }else{
                    $recomm[] =  ['room'=>$room ,'number'=>ceil( $request->adult / $room->adult) ];
                }

            }else{
                // echo 'con 2 <br>';
                // $recomm =  (($request->adult/$room->adult)+ ($request->child - $room->child)/($room->child+$room->adult));
                $recomm[] =  ['room'=>$room ,'number'=> ceil((($request->adult/$room->adult)+ ($request->child - $room->child)/($room->child+$room->adult))) ];
            }
        }

        return  $recomm;
    }

}
