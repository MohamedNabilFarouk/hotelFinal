<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Code;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Provider;
use Illuminate\Support\Facades\DB;
use Auth;

class UsersController extends Controller
{
    //
    public function index(){
        $roles= Role::all();
        $users = User::all();
        // dd($users);
        return view('admin.user.index',compact('users','roles'));
    }

    public function userCode(){
        $codes= Code::where('parent_id',Auth::user()->id)->get();

        return view('admin.yourCodes',compact('codes'));
    }

    public function create(){
        $roles= Role::all();

        // dd($users);
        return view('admin.user.create',compact('roles'));
    }

    protected function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
        // dd($data['password']);
        $data['password'] = Hash::make($data['password']);
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
        return view ('admin.user.edit',compact('user','roles'));
    }

    public function update(Request $request,$id){
        
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
          'phone' => ['required', 'string', 'max:255', 'unique:users,phone,'.$id],
            

        ]);
        $user = User::find($id);
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
}
