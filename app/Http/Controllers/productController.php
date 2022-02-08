<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Code;
use Auth;
use App\Traits\imagesTrait;
use BeyondCode\Vouchers\Models\Voucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Str;
class productController extends Controller
{
    use imagesTrait;

    public function index()
    {
        $products = Product ::paginate(10);
        return view('admin.product.index', compact('products'));
    }


    // public function createCopon()
    // {
    //     // $product = Product ::find($id);
    //     // return view('admin.copon.create', compact('product'));
    //     return view('admin.copon.create');
    // }

//     public function storeCopon(Request $request)
//     {
//         $data = $request -> validate([
//             'discount' => 'required|string|max:100',
//             'days' => 'required|string|max:10',
//         ]);
//         // $product = Product ::find($request -> product_id);
//         $product = Product ::all();
//         // foreach($products as $product){
//     $copons = $product[0] -> createVouchers(1, ['discount' => $data['discount']], today() -> addDays($data['days']));
// // 
// // }

//         session() -> flash('success', trans('added successfully'));
//         return redirect() -> route('copons.index');

//     }

    // public function allCopons()
    // {
    //     $copons = Voucher ::orderBy('id', 'DESC') -> get();
    //     // dd($copons[3]->product->name_en);
    //     return view('admin.copon.index', compact('copons'));
    // }

    // public function destroyCopon($id)
    // {
    //     $copon = Voucher ::where('id', $id) -> delete();
    //     return redirect() -> route('copons.index');
    // }


    // public function createvo()
    // {
    //     $videoCourse = Product ::find(3);
    //     $voucher = $videoCourse -> createVouchers(1, ['discount' => 50], today() -> addDays(7));

    //     dd($voucher);
    // }

    public function create()
    {
        
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        // dd($request->veg);
        $data = $request -> validate([
            'name' => 'required|string|max:100',
           
            'des' => 'string',
            'image' => 'required',
            'price' => 'required',
            
        ]);
        $data = $request->all();
        if ($request -> has('image')) {
            $image = $this -> saveImages($request -> image, 'images/products');
            $data['image'] = $image;
        }
                                        

        Product ::create($data);
        session() -> flash('success', trans('added successfully'));
        return redirect() -> route('product.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Product ::find($id);
       
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $data = $request -> validate([
            'name' => 'required|string|max:100',
           
            'des' => 'string',
           
            'price' => 'required',

        ]);

        $product = Product ::find($id);
$data= $request->all();
        DB::beginTransaction();

        if ($request -> has('image')) {
            if($product -> image != 'default.png'){
                Storage ::disk('public_uploads') -> delete('products/' . $product -> image);
            }
            $image = $this -> saveImages($request -> image, 'images/products');
            $data['image'] = $image;
        }

        $product -> update($data);

        DB::commit();

        session() -> flash('success', trans('Updated Successfully'));
        return redirect() -> route('product.index');
    }

    public function destroy($id)
    {
        $product = Product ::find($id);

        DB::beginTransaction();

        if($product -> image != 'default.png'){
            Storage ::disk('public_uploads') -> delete('products/' . $product -> image);
        }
        $product-> delete();

        DB::commit();

        session() -> flash('success', trans('deleted successfully'));
        return redirect() -> route('product.index');
    }

    public function search(Request $request){
        $products = Product::where('name','like',  '%'.$request->name.'%')->get();
         $products->is_filter = 1;

        //  dd($products);
        return view('admin.product.index', compact('products'));
    }

public function allproducts(){
    $products = Product ::paginate(8);
    return view('admin.allproducts',compact('products'));
}


    // public function codeGenerator(){
    //     $auth_user = Auth::user();
       
    //     for($i=0; $i<=2; $i++){
    //         $string = Str::random(8);
    //         $code[] = $auth_user->name.'#'.$auth_user->id.'%'.$string;

    //         Code::create(array(
    //             'parent_id'=>$auth_user->id,
    //             'code'=>$auth_user->name.'#'.$auth_user->id.'%'.$string,
    //         ));
    //     }
    //    return 'success';
    //     // dd($code);

         
    // }

}
