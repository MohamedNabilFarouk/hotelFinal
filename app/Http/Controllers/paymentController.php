<?php

namespace App\Http\Controllers;

use App\Booking;
use App\HotelBooking;
use Illuminate\Http\Request;
use Guzzle\Http\Client;
use GuzzleHttp\Psr7;
use Session;
use Carbon\Carbon;
use DB;
use MTGofa\FawryPay\FawryPay;
use App\Http\Controllers\OrdersController;
use App\Room;
use Illuminate\Support\Facades\Validator;

class paymentController extends Controller
{

    public function oPay(Request $request){
        // dd($request);
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


         //  $data = $request->all();

     //    $data =  ['name' => $request->name,
     //             'phone' => $request->phone,
     //             'email' => $request->email,
     //             'type' => $request->type,
     //             'adult' => $request->adult,
     //             'child' => $request->child,
     //             'total' =>   $request->total,
     //             'deposit' => $request->deposit,
     //             'from'=> $request->from,
     //             'to'=>$request->to,
 // ];

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

 }


 $country = "EG";
 $reference    =  $booking->id;
  Session::put('booking_id', $booking->id);

 $amount= [
     "total"=> $request->total * 100, //$request->total
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
     "userName"=>$booking->first_name . $booking->last_name
 ];
 $returnUrl  = 'https://hoteelsegypt.com/';
 // $callbackUrl  = 'http://opayapi-001-site1.itempurl.com/api/payloads/OpayCallback';

 $cancelUrl  = 'https://hoteelsegypt.com/';
 // $userClientIP = '1.1.1.1';
 $expireAt = 30;
 $httpClient = new \GuzzleHttp\Client();
 // https://sandboxapi.opaycheckout.com/api/v1/international/cashier/create  //test mode
 // https://api.opaycheckout.com/api/v1/international/cashier/create  //live mode
 $response = $httpClient->request('POST', 'https://api.opaycheckout.com/api/v1/international/cashier/create', [
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
                             'returnUrl' => 'https://hoteelsegypt.com/',
                             'callbackUrl'=> 'https://hoteelsegypt.com/OpayCallback',
                             'cancelUrl' => $cancelUrl,
                             // 'userClientIP' => $userClientIP,
                             'expireAt' => $expireAt,
                         ] , true)
 ]);
 // dd($response);
 $response = json_decode($response->getBody()->getContents(), true);
 //  return $response;
 if($response['data']){
     $paymentStatus = $response['data']; // get response values
     $url=$paymentStatus['cashierUrl'];

      return redirect($paymentStatus['cashierUrl']);


 }else{
     return $response['message'];
 }

 }

 public function Opaycallback(Request $request)
 {
     // dd($request);
 //    if($request->json){
 //        dd('done');
 //    }
     if($request['payload']['status'] == 'SUCCESS'){

     // updata is_paid and return to success page or Home Page
     $booking= Booking::where('id',$request['payload']['reference'])->first();
    //  $booking->status = 'completed';
     $booking->is_paid = 1;
     $booking->save();


     // extra cal

        //  $booking->sendNewBookingEmails();


        //      // calculate balance
        //      $vendor_id = $booking->vendor_id;
        //      $trans = VendorTransaction::where('vendor_id',$vendor_id)->orderBy('updated_at', 'desc')->first();
        //      if(isset($trans)){
        //              $withdrow_date= $trans->updated_at;
        //              $booked_packages_total = RoomPackageBooking::where([['vendor_id',$vendor_id],['is_paid','1'],['updated_at','>',$withdrow_date]])->pluck('total')->sum();
        //              $booked_hotel_total = Booking::where([['vendor_id',$vendor_id],['is_paid','1'],['updated_at','>',$withdrow_date]])->pluck('total')->sum();

        //      }else{
        //          // dd('here');
        //          $withdrow_date = Carbon::now();
        //          $booked_packages_total = RoomPackageBooking::where([['vendor_id',$vendor_id],['is_paid','1']])->pluck('total')->sum();
        //          $booked_hotel_total = Booking::where([['vendor_id',$vendor_id],['is_paid','1']])->pluck('total')->sum();
        //      }

        //      $balance_before =  $booked_packages_total + $booked_hotel_total;
        //      $balance_after = $balance_before - ($balance_before * .1);
        //                  $vendor= VendorRequest::where('user_id',$vendor_id)->first();
        //                  if(isset($vendor)){
        //                      $vendor->balance = $balance_after;
        //                      $vendor->save();
        //                  }
             // end calculate balance

 // end extra cal


      return 'success';
 }else{
     return 'Error';
 }



        }


        public function checkAvailability(Request $request){

            // dd($request);

            $validator = Validator::make($request->all(), [
                'from' => 'required|date|after:yesterday',
                'number' => 'required|required',
                'to' => 'required|date|after:today',
                'room_id' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return ['success'=>'false', 'data'=>$validator->messages()];
            }

            // $room_availabilty = HotelBooking::where([['room_id',$request->room_id]])->whereBetween('from', [$request->from, $request->to])->get();
            $no_rooms_booked = HotelBooking::where([['room_id',$request['room_id']]])->whereBetween('from', [$request['from'], $request['to']])
                                                                              ->orWhereBetween('to', [$request['from'], $request['from']])->sum('number');


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

        }



