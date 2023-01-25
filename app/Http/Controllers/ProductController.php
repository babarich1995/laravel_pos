<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = DB::table('products')
                   ->join('categories','products.category_id','categories.id')
                   ->join('suppliers','products.supplier_id','suppliers.id')
                   ->select('categories.category_name','suppliers.name','products.*')
                   ->orderBy('products.id','DESC')
                   ->get();
        return response()->json($product);
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_name'=>'required |max:255',
            'product_code'=>'required |unique:products',
            'category_id'=>'required',
            'supplier_id'=>'required',
            'buying_price'=>'required',
            'selling_price'=>'required',
            'buying_date'=>'required',
            'product_quantity'=>'required',
            
           ]);



           if ($request->image) {
            $imagename = time().'.' . explode('/', explode(':', substr($request->image, 0,
             strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->resize(240,200)->save(public_path('backend/product/').$imagename);
            $request->merge(['image' => $imagename]);

             $product = new Product;
             
             $product->product_name= $request->product_name;
             $product->product_code= $request->product_code;
             $product->category_id= $request->category_id;
             $product->supplier_id= $request->supplier_id;
             $product->buying_price= $request->buying_price;
             $product->selling_price= $request->selling_price;
             $product->product_quantity= $request->product_quantity;
             $product->root= $request->root;
             $product->buying_date= $request->buying_date;
             $product->image= $imagename;
             $product->save();
           
             

        }
        else{
            $product = new Product;
             
            $product->product_name= $request->product_name;
            $product->product_code= $request->product_code;
            $product->category_id= $request->category_id;
            $product->supplier_id= $request->supplier_id;
            $product->buying_price= $request->buying_price;
            $product->selling_price= $request->selling_price;
            $product->product_quantity= $request->product_quantity;
            $product->root= $request->root;
            $product->buying_date= $request->buying_date;
          
          
            $product->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product= DB::table('products')->where('id', $id)->first();

        return response()->json($product);
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data= array();
        $data['product_name']= $request->product_name;
        $data['product_code']= $request->product_code;
        $data['category_id']= $request->category_id;
        $data['buying_price']= $request->buying_price;
        $data['selling_price']= $request->selling_price;
        $data['buying_date']= $request->buying_date;
        $data['product_quantity']= $request->product_quantity;
        $data['supplier_id']= $request->supplier_id;
        $data['root']= $request->root;
        $image  = $request->newPhoto;

        if ($image) {
            $imagename = time().'.' . explode('/', explode(':', substr($image, 0,
            strpos($image, ';')))[1])[1];
            $img= \Image::make($image)->resize(240,200)->save(public_path('backend/product/').$imagename);
            $request->merge(['image' => $imagename]);

            if ($img) {
                $data['image'] = $imagename;
                $img_data = DB::table('products')->where('id', $id)->first();
                $image_path = 'backend/product/'. $img_data->image;
                $done = unlink($image_path);
                $user= DB::table('products')->where('id',$id)->update($data);
    
               }
    
         
        }
        else{
            $oldphoto = $request->image;
            $data['image'] = $oldphoto;
            $user= DB::table('products')->where('id',$id)->update($data);
           }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $image = 'backend/product/'.$product->image;

        if($image){
         unlink($image);
         DB::table('products')->where('id', $id)->delete();
        }else{
         DB::table('products')->where('id', $id)->delete();
        }
    }

    public function UpdateStock(Request $request,$id){

        $data=array();
        $data['product_quantity'] =$request->product_quantity;

        DB::table('products')->where('id',$id)->update($data);
    }
}
