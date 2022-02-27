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
use App\Http\Resources\BookingResource;
use App\SavedSearch;

class UsersController extends Controller
{
    use imagesTrait;

    //

    private $apiToken;
    public function __construct()
     {
     $this->apiToken = uniqid(base64_encode(Str::random(40)));
     }





    public function create(Request $request){
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);
        $country = $request->header('country') ? $request->header('country') : 'EG';
        config()->set('app.country', $country);
        $countries = Country::all();
        $roles= Role::all();
        return response()->json(['success'=>'true','data'=>['countries'=>$countries,'roles'=>$roles]]);
    }

    protected function store(Request $request) //register
    {
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);
        $country = $request->header('country') ? $request->header('country') : 'EG';
        config()->set('app.country', $country);

        //  dd($request->all());
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

        if($request->hasFile('tax_card')){
            // dd($request->tax_card);
            $tax_card = $this -> saveImages($request -> tax_card, 'images/vendorData');
            $data['tax_card'] = $tax_card;
        }

        if($request->hasFile('commercial_record')){
            $commercial_record = $this -> saveImages($request -> commercial_record, 'images/vendorData');
            $data['commercial_record'] = $commercial_record;
        }

        $data['bank_name']= $request->bank_name;
        $data['bank_account']= $request->bank_account;
        $data['company_name']= $request->company_name;
        $data['bank_account_name']= $request->bank_account_name;
        $data['iban']= $request->iban;
        $data['swift']= $request->swift;

        if ($request->has('role') && $request->role == 3){

            $validator = Validator::make($request->all(), [
//                'tax_card' => ['required'],
//                'commercial_record' => ['required'],
                'bank_name' => ['required'],
                'bank_account' => ['required'],
                'company_name' => ['required'],
                'bank_account_name' => ['required'],
                'iban' => ['required'],
                'swift' => ['required'],
                'vendor_terms_and_conditions' => 'required'
            ]);

            if ($validator->fails()) {

                return response()->json(['success'=>'false', 'data'=>$validator->messages()]);
            }


            $data['status'] = 0;
        }

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



            $credentials = request(['email', 'password']);
            // dd($credentials);

            if ($token = Auth::attempt($credentials)) {

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





    public function edit($id, Request $request){
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);
        $country = $request->header('country') ? $request->header('country') : 'EG';
        config()->set('app.country', $country);

         $user = User::with('books', 'roles')->where('id', '=', $id)->first();

        $roles= Role::all();
        $countries = Country::all();
        return response()->json(['success'=>'true','data'=>['user'=>$user,'countries'=>$countries,'roles'=>$roles]]);
    }

    public function update(Request $request,$id){    //update profile
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);
        $country = $request->header('country') ? $request->header('country') : 'EG';
        config()->set('app.country', $country);
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
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);
        $country = $request->header('country') ? $request->header('country') : 'EG';
        config()->set('app.country', $country);
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {

            return response()->json(['success'=>'false', 'data'=>$validator->messages()]);
        }


        //User check
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
        $user = Auth::user();

        //Setting login response
        $success['token'] = $this->apiToken;
        $success['id'] =  $user->id;
        $success['name'] =  $user->name;
        $success['role'] =  $user->roles[0]->name;
        $success['email'] = $user->email;
        $success['phone'] = $user->phone;
        $success['country'] = $user->country;
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



    public function profile($id,Request $request){
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);
        $country = $request->header('country') ? $request->header('country') : 'EG';
        config()->set('app.country', $country);
          $booking_history= Booking::where('customer_id',$id)->get();
          $saved_search = SavedSearch::where('user_id',$id)->with('city')->orderBy('id','desc')->limit(10)->get();
                return response()->json(['status'=>'success','data'=>["booking_history"=>BookingResource::collection($booking_history),"saved_search"=>$saved_search]]);

    }


}






