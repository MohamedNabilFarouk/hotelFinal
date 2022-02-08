<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\User;
use App\VendorTransaction;
use App\Booking;
use Carbon\Carbon;
use App\HotelBooking;
use App\Room;
use Illuminate\Http\Request;
use Auth;
class DashboardController extends Controller
{
    //

    public function index(){
        $vendor = Auth::user()->id;
        $VendorTransactions = VendorTransaction::where('vendor_id',$vendor)->get();

        if(isset($VendorTransactions) && (Auth::user()->roles[0]->name == 'vendor')){
            // dd($VendorTransactions);
            $last_data_for_withdrow =$VendorTransactions->last();
            $book=Booking::where([['updated_at','>',$last_data_for_withdrow->withdrawal_date],['is_paid','1']])->get();
        }else{



            $book=Booking::where([['is_paid','1']])->get();
        }
        $total_balance=$book->sum('paid');
        $net_balance=$total_balance - ($total_balance * .1);
        $total_booking=count($book);


        // admin
        $admin_bookedCount_month = Booking::where([['is_paid','1'],['updated_at','>=', Carbon::now()->subMonth()]])->count();
        $admin_bookedTotal_month = Booking::where([['is_paid','1'],['updated_at','>=', Carbon::now()->subMonth()]])->pluck('total')->sum();
        $admin_site_balance = $admin_bookedTotal_month * .1;
        $vendors = User::whereRoleIs('vendor')->count();
        $rooms = User::whereRoleIs('vendor')->count();


        $rooms_number = Room::where([['status','1']])->sum('number');
        //   $available =  HotelRoomDate::where('end_date','=',date('Y-m-d'))->sum('number');
          $booked_rooms= HotelBooking::whereDate('from', '<=', date("Y-m-d"))
                                            ->whereDate('to', '>=', date("Y-m-d"))->sum('number');

          $admin_availableRooms = $rooms_number-$booked_rooms;

//  dd($admin_availableRooms);

        //  dd($net_balance);
        // dd($vendor);
        return view('admin.dashboard',compact('VendorTransactions','total_balance','net_balance','total_booking',
                                                'admin_bookedCount_month','admin_bookedTotal_month','admin_site_balance','vendors','admin_availableRooms'
    ));
    }

}
