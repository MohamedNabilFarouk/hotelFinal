<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Country;
use App\Booking;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Provider;
use Illuminate\Support\Facades\DB;
use Auth;
use Validator;
use App\Traits\imagesTrait;
use Str;

class UsersController extends Controller
{
    use imagesTrait;

    //

    private $apiToken;
    public function __construct()
     {
     $this->apiToken = uniqid(base64_encode(Str::random(40)));
     }

    



    public function create(){
        $countries = Country::all();
        $roles= Role::all();
        return response()->json(['success'=>'true','data'=>['countries'=>$countries,'roles'=>$roles]]);
    }

    protected function store(Request $request) //register
    {
        
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
        if ($validator->fails()) {

            return response()->json(['success'=>'false', 'data'=>$validator->messages()]);
        }
        $data = $request->all();
        // dd($data['password']);
        // $data['country'] = $request->country;
    
        $data['password'] = Hash::make($data['password']);

        if($request->has('tax_card')){
            // dd($request->tax_card);
            $tax_card = $this -> saveImages($request -> tax_card, 'images/vendorData');
            $data['tax_card'] = $tax_card;
        }

        if($request->has('commercial_record')){
            $commercial_record = $this -> saveImages($request -> commercial_record, 'images/vendorData');
            $data['commercial_record'] = $commercial_record;
        } 
        $data['bank_name']= $request->bank_name;
        $data['bank_account']= $request->bank_account;
        // dd($data);
        $user =  User::create($data);
        if($request->has('role')){
        $user->attachRole($request->role); // role from request
        }else{
            $user->attachRole('4'); // customer default
        }

        // if($request->role == 3 ){
        //     session()->flash('success', trans('validation.User Added Successfully, Please Fill Delivery Information'));
        //     return redirect()->route('deliveryBoy.create');
        // } else {
            
            return response()->json(['success'=>'true','data'=>$user]);
        // }

    }


    


    public function edit($id){
        // $user = User::findOrFail($id);
        $user = User::where('id',$id)->with('roles')->get();
        $roles= Role::all();
        $countries = Country::all();
        return response()->json(['success'=>'true','data'=>['user'=>$user,'countries'=>$countries,'roles'=>$roles]]);

    }

    public function update(Request $request,$id){    //update profile
        $validator = Validator::make($request->all(), [
            'name' => ['string', 'max:255'],
            'email' => [ 'string', 'email', 'max:255', 'unique:users,email,'.$id],
          'phone' => ['string', 'max:255', 'unique:users,phone,'.$id],
            

        ]);
        if ($validator->fails()) {

            return response()->json(['success'=>'false', 'data'=>$validator->messages()]);
        }
        
        $data = $request->all();
        // dd($data);
        $user = User::find($id);


        if($request->has('tax_card')){
            // dd($request->tax_card);
            $tax_card = $this -> saveImages($request -> tax_card, 'images/vendorData');
            $data['tax_card'] = $tax_card;
        }

        if($request->has('commercial_record')){
            $commercial_record = $this -> saveImages($request -> commercial_record, 'images/vendorData');
            $data['commercial_record'] = $commercial_record;
        } 
        $data['bank_name']= $request->bank_name;
        $data['bank_account']= $request->bank_account;


        $user->update($data);
        return response()->json(['success'=>'true','data'=>['user'=>$user]]);


    }

            public function login(Request $request){ 
                //User check
                if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
                $user = Auth::user(); 
                //Setting login response 
                $success['token'] = $this->apiToken;
                $success['id'] =  $user->id;
                $success['name'] =  $user->name;
                $success['role'] =  $user->roles[0]->name;
                return response()->json([
                    'status' => 'success',
                    'data' => $success
                ]); 
                } else { 
                return response()->json([
                    'status' => 'error',
                    'data' => 'Unauthorized Access'
                ]); 
                } 
            }

    
            public function historyBooking($id){

                $booking_history= Booking::where('customer_id',$id)->with('hotel')->get();
                return response()->json(['status'=>'success','data'=>$booking_history]);

            }


    
}






