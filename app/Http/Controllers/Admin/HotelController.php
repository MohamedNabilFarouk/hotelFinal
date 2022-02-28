<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Hotel;
use App\HotelGallery;
use App\User;
use App\Country;
use App\Governorate;
use Auth;
use App\Traits\imagesTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Str;
class HotelController extends Controller
{
    use imagesTrait;


    // public function __construct() {
    //     $this->middleware('role:moderator', ['except' => [
    //         'destroy'
    //     ]]);
    //     $this->middleware('role:admin');
    // }

    public function index(){
        if(Auth::user()->hasRole(['vendor'])){
            $hotels = Hotel::where([['vendor_id',Auth::user()->id]])->paginate(10); // if vendor
        }else{
        $hotels = Hotel::paginate(10);
        }
        return view('admin.hotel.index', compact('hotels'));
    }

    public function create()
    {
        $vendors= User::whereRoleIs('vendor') -> get();
        $countries = Country::all();
        $gov=Governorate::all();

        return view('admin.hotel.create', compact('vendors','countries','gov'));
    }

    public function store(Request $request)
    {
        // dd($request->veg);
        $data = $request -> validate([
            'title' => 'string|max:100',
            'content' => 'string',
            'star_rate' => 'required',
        ]);


// dd($data['vendor_id']);
            $except=['_token','add','image','arr','gallery'];
            foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value ){
                $except[]="title_".$key;
                $except[]="content_".$key;
                $except[]="address_".$key;
            }
            $data= $request->except($except);
            if(Auth::user()->hasRole(['admin','moderator'])){
                // dd(Auth::user()->id);
                $data['vendor_id'] = $request->vendor_id; //if admin
                }else if(Auth::user()->hasRole(['vendor'])){
                    // dd(Auth::user()->id);
                    $data['vendor_id'] = Auth::user()->id; // if vendor
                }
    // dd($except);
                foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value ){
                    $title = 'title_' . $key;
                    $content = 'content_' . $key;
                    $address = 'address_' . $key;
                    $data['title'][$key]=$request->$title;
                    $data['content'][$key]=$request->$content;
                    $data['address'][$key]=$request->$address;

                }
        if ($request -> has('image')) {
            $image = $this -> saveImages($request -> image, 'images/hotels');
            $data['image'] = $image;
        }
        // dd($data['vendor_id']);
      $hotel=  Hotel::create($data);
        if ($request -> has('gallery')) {

            foreach($request->gallery as $i){

                $image = $this -> saveImages($i, 'images/hotels');
                $gallery = new HotelGallery();
                $gallery->hotel_id = $hotel->id;
                $gallery->image = $image;
                $gallery->save();
            }

        }

        session() -> flash('success', trans('added successfully'));
        return redirect() -> route('hotel.index');
    }



    public function edit($id)
    {
        $vendors= User::whereRoleIs('vendor') -> get();
        $countries = Country::all();
        $gov=Governorate::all();

        $hotel = Hotel ::find($id);

        return view('admin.hotel.edit', compact('hotel','vendors','countries','gov'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $data = $request -> validate([
            'title' => 'string|max:100',
            'content' => 'string',
        ]);


        $hotel = Hotel ::find($id);



        $except=['_token','add','image','arr','gallery'];
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
            if($hotel -> image != 'default.png'){
                Storage ::disk('public_uploads') -> delete('images/hotels/' . $hotel -> image);
            }
            $image = $this -> saveImages($request -> image, 'images/hotels');
            $data['image'] = $image;
        }
if($request->home == null){
    $data['home']= 0;
}
        $hotel -> update($data);
        if ($request -> has('gallery')) {

            foreach($request->gallery as $i){

                $image = $this -> saveImages($i, 'images/hotels');
                $gallery = new HotelGallery();
                $gallery->hotel_id = $id;
                $gallery->image = $image;
                $gallery->save();
            }

        }
        DB::commit();

        session() -> flash('success', trans('Updated Successfully'));
        return redirect() -> route('hotel.index');
    }

    public function destroy($id)
    {
        if(!auth()->user()->hasRole(['admin','vendor']))
    {
        session() -> flash('Error', trans('Access Denied'));
        return redirect() -> route('hotel.index');
    }
        $hotel = Hotel ::find($id);

        DB::beginTransaction();

        if($hotel -> image != 'default.png'){
            Storage ::disk('public_uploads') -> delete('images/hotels/' . $hotel -> image);
        }
        $hotel-> delete();

        DB::commit();

        session() -> flash('success', trans('deleted successfully'));
        return redirect() -> route('hotel.index');
    }



}
