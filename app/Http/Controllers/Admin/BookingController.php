<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\User;
use App\Booking;
use App\HotelBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class BookingController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    //
    public function index(){

        if(Auth::user()->roles[0]->name == 'vendor'){
            $bookings = Booking::where('vendor_id',Auth::user()->id)->with('hotelBooking')->paginate(10);

        }elseif(Auth::user()->roles[0]->name == 'admin'){
            $bookings = Booking::with('hotelBooking')->paginate(10);
            //  dd($bookings);
        }
// dd($bookings->where('type','tour')->all());
        return view('admin.booking.index',compact('bookings'));
    }
public function details($booking_id){
    $details = HotelBooking::where('booking_id',$booking_id)->with('room')->get();
    // dd($details);
    return view('admin.booking.details',compact('details'));
}
}
