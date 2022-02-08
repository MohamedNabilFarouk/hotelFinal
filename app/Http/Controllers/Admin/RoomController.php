<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Hotel;
use App\Room;
use App\RoomPrices;
use App\RoomGallery;
use App\User;
use App\Country;
use App\SpaceType;
use Auth;
use App\Traits\imagesTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Str;

class RoomController extends Controller
{
    use imagesTrait;

    public function index(){
        $rooms = Room::paginate(10);
        // dd($rooms);
        return view('admin.room.index', compact('rooms'));
    }

    public function create()
    {
        if(Auth::user()->hasRole(['admin','moderator'])){
        $hotels = Hotel::where('status','1')->get(); //if admin
        }else if(Auth::user()->hasRole(['vendor'])){
            $hotels = Hotel::where([['vendor_id',Auth::user()->id],['status','1']])->get(); // if vendor
        }
       $countries=Country::all();
       $types  = SpaceType::all();

        return view('admin.room.create', compact('hotels','countries','types'));
    }

    public function store(Request $request)
    {

        $data = $request -> validate([
            'title' => 'required|string|max:100',
            'content' => 'string',
             'image' => 'required',
            'hotel_id'=>'required',
        ]);
        $except=['_token','add','image','arr'];
        foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value ){
            $except[]="title_".$key;
            $except[]="content_".$key;
            $except[]="address_".$key;
        }
        $data= $request->except($except);

            foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value ){
                $title = 'title_' . $key;
                $content = 'content_' . $key;
                $address = 'address_' . $key;
                $data['title'][$key]=$request->$title;
                $data['content'][$key]=$request->$content;
                $data['address'][$key]=$request->$address;

            }


        $hotel= Hotel::where('id',$request->hotel_id)->select('vendor_id')->first();
        $data['vendor_id']= $hotel->vendor_id;
        // dd($data['vendor_id']);
        DB::beginTransaction();

        $room = Room::create($data);

        if ($request -> has('image')) {

            foreach($request->image as $i){

                $image = $this -> saveImages($i, 'images/hotels/rooms');
                $gallery = new RoomGallery();
                $gallery->room_id = $room->id;
                $gallery->image = $image;
                $gallery->save();
            }


        }

        if(isset($request->arr)){
            foreach($request->arr as $p){
                $prices = new RoomPrices();
                $prices->room_id = $room->id;
                $prices->ip = $p['country'];
                $prices->price = $p['price'];
                $prices->save();
            }
        }


        DB::commit();

        session() -> flash('success', trans('added successfully'));
        return redirect() -> route('room.index');
    }



    public function edit($id)
    {
        if(Auth::user()->hasRole(['admin','moderator'])){
            $hotels = Hotel::where('status','1')->get(); //if admin
            }else if(Auth::user()->hasRole(['vendor'])){
                $hotels = Hotel::where([['vendor_id',Auth::user()->id],['status','1']])->get(); // if vendor
            }
        $room = Room ::find($id);
        $countries=Country::all();
       $types  = SpaceType::all();


        return view('admin.room.edit', compact('room','hotels','countries','types'));
    }

    public function update(Request $request, $id)
    {
        $data = $request -> validate([
            'title' => 'string|max:100',
            'content' => 'string',
            'hotel_id'=>'required',
        ]);

        $room = Room ::find($id);
        $except=['_token','add','image','arr'];
        foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value ){
            $except[]="title_".$key;
            $except[]="content_".$key;
            $except[]="address_".$key;
        }
        $data= $request->except($except);

            foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value ){
                $title = 'title_' . $key;
                $content = 'content_' . $key;
                $address = 'address_' . $key;
                $data['title'][$key]=$request->$title;
                $data['content'][$key]=$request->$content;
                $data['address'][$key]=$request->$address;

            }

        DB::beginTransaction();

        if ($request -> has('image')) {
            RoomGallery::where('room_id',$id)->delete();
            foreach($request->image as $i){

                $image = $this -> saveImages($i, 'images/hotels/rooms');
                $gallery = new RoomGallery();
                $gallery->room_id = $room->id;
                $gallery->image = $image;
                $gallery->save();
            }
        }
// dd($request->arr);
            if(isset($request->arr)){
                RoomPrices::where('room_id',$id)->delete();
                foreach($request->arr as $p){
                    $prices = new RoomPrices();
                    $prices->room_id = $room->id;
                    $prices->ip = $p['country'];
                    $prices->price = $p['price'];
                    $prices->save();
                }
            }




        $room -> update($data);

        DB::commit();

        session() -> flash('success', trans('Updated Successfully'));
        return redirect() -> route('room.index');
    }

    public function destroy($id)
    {
        if(!auth()->user()->hasRole(['admin','vendor']))
        {
            session() -> flash('Error', trans('Access Denied'));
            return redirect() -> route('room.index');
        }
        $room =    Room ::find($id);


        DB::beginTransaction();

        if($room -> image != 'default.png'){
            Storage ::disk('public_uploads') -> delete('images/hotels/rooms' . $room -> image);
        }
        $room-> delete();
        RoomGallery::where('room_id',$id)->delete();

        DB::commit();

        session() -> flash('success', trans('deleted successfully'));
        return redirect() -> route('room.index');
    }
    public function editPrice(Request $request,$id){

        $room = Room::find($id);
        if($room){
            $room->price= $request->price;
            $room->save();
            session() -> flash('success', trans('Updated Successfully'));
            return redirect() -> route('room.index');
        }
    }



}
