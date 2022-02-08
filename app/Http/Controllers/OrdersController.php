<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Order;
use App\Code;
use Auth;
use Str;
// use App\OrderItem;


class OrdersController extends Controller
{

    public function index()
    {

        $orders = Order::orderBy('id','DESC')->paginate(10);

        return view('admin.order.index', compact('orders'));
    }

    public function store($request=[]){
        // $data = $request -> validate([
        //     'name' => 'required|string|max:100',
        //     'phone' => 'string',
        //     'address' => 'string|required',
        // ]);
        // dd($request);
        $order = Order::create([
                'product_id'        =>$request['product_id'],
                'user_id'               =>Auth::user()->id,
                'is_paid'               =>0,
                'payment_method'        =>'cash',
                'name'                  =>$request['name'],
                'address'                  =>$request['address'],
                'phone'                  =>$request['phone'],
            ]);
            
            if(isset($order)){
               $codes= $this->codeGenerator();
                // return view('admin.generatedCodes',compact('codes'));
                return ['order'=>$order->id,'codes'=>$codes];
            }
    }

    public function codeGenerator(){
        $auth_user = Auth::user();
       
        for($i=0; $i<=2; $i++){
            $string = Str::random(8);
            $code[] = $auth_user->name.'#'.$auth_user->id.'%'.$string;

            Code::create(array(
                'parent_id'=>$auth_user->id,
                'code'=>$auth_user->name.'#'.$auth_user->id.'%'.$string,
            ));
        }
       return $code;
        // dd($code);

         
    }
}