<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\VendorTransaction;
use App\Country;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Provider;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Traits\imagesTrait;


class UsersController extends Controller
{
    use imagesTrait;

    //
    public function index(){
        $roles= Role::all();
        $users = User::orderBy('id','DESC')->paginate(10);

        // dd($users);
        return view('admin.user.index',compact('users','roles'));
    }

    public function userCode(){
        $codes= Code::where('parent_id',Auth::user()->id)->get();

        return view('admin.yourCodes',compact('codes'));
    }

    public function create(){
        $countries = Country::all();

        $roles= Role::all();

        // dd($users);
        return view('admin.user.create',compact('roles','countries'));
    }

    protected function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
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
        $data['company_name']= $request->company_name;
        $data['bank_account_name']= $request->bank_account_name;
        $data['iban']= $request->iban;
        $data['swift']= $request->swift;
        // dd($data);
        $user =  User::create($data);
        $user->attachRole($request->role); // customer default


        // if($request->role == 3 ){
        //     session()->flash('success', trans('validation.User Added Successfully, Please Fill Delivery Information'));
        //     return redirect()->route('deliveryBoy.create');
        // } else {
            session()->flash('success', trans('validation.added successfully'));
            return redirect()->route('user.index');
        // }

    }


    public function addRole(){
        $role = 4;
        $id = 4;
        $user = User::find($id);
        // $user->attachRole($role);
        $user->roles()->attach([$role]);
        dd($user);
    }


    public function edit($id){
        $user = User::findOrFail($id);
        $roles= Role::all();
        $countries = Country::all();

        return view ('admin.user.edit',compact('user','roles','countries'));
    }

    public function update(Request $request,$id){

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
          'phone' => ['required', 'string', 'max:255', 'unique:users,phone,'.$id],


        ]);
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
        $data['company_name']= $request->company_name;
        $data['bank_name']= $request->bank_name;
        $data['bank_account']= $request->bank_account;
        $data['bank_account_name']= $request->bank_account_name;
        $data['iban']= $request->iban;
        $data['swift']= $request->swift;

        $user->update($data);
        session()->flash('success', trans('validation.added successfully'));
            return redirect()->route('user.index');

    }



    public function editUserRole( Request $request){
        // $role = 5;
        //  $id = 4;
        // dd($user->roles[0]->name);
        $user = User::find($request->id);
        $user->detachRole($user->roles[0]->id); // parameter can be a Role object, array, id or the role string name
         $user->attachRole($request->role);
        // $user->roles()->attach(['customer']);
        session()->flash('success', trans('Updated successfully'));
        return redirect()->route('user.index');
    }

    public function destroy( $id){

        if(!auth()->user()->hasRole(['admin']))
        {
            session() -> flash('Error', trans('Access Denied'));
            return redirect() -> route('user.index');
        }

        $user = User::find($id);
        // $user_provider = Provider::where('user_id',$id)->get();
        DB::beginTransaction();
        $user->detachRole($user->roles[0]->name); // parameter can be a Role object, array, id or the role string name
         $user->delete();
        //  foreach($user_provider as $u){
        //     $u->delete();
        //  }

         DB::commit();
        // $user->roles()->attach(['customer']);

        session()->flash('success', trans('deleted successfully'));
        return redirect()->route('user.index');
    }


    public function zerobalance($vendor_id){
            $vendor=User::findOrFail($vendor_id);
            DB::beginTransaction();
            try {
            VendorTransaction::create([
            'vendor_id'=>$vendor_id,
            'withdrawal_amount'=>$vendor->balance,
            ]);
            $vendor->update(['balance'=> 0]);
            DB::commit();
            session()->flash('success', trans('Transfered Successfully'));
            return redirect()->route('user.index');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('success', trans('Error  in Transfere'));
            return redirect()->route('user.index');
        }
    }

    public function getUserByRole($role)
    {
        $roles = Role::all();
        $users = User::whereHas(
            'roles', function($q) use ($role){
                $q->where('name', $role);
            }
        )->orderBy('id','DESC')->paginate(10);
        return view('admin.user.index',compact('users','roles'));

    }


}
