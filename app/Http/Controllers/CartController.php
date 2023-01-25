<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id){

         $product = DB::table('products')->where('id',$id)->first();

          $check = DB::table('pos')->where('product_id',$id)->first();

        if ($check) {

          DB::table('pos')->where('product_id',$id)->increment('product_quantity');
          $product = DB::table('pos')->where('product_id',$id)->first();
          $subtotal = $product->product_quantity * $product->product_price;
          DB::table('pos')->where('product_id',$id)->update(['sub_total'=>$subtotal]);
        }else{
            $data=array();
            $data['product_id']= $id;
            $data['product_name'] = $product->product_name;
            $data['product_image'] = $product->image;
            $data['product_quantity'] = 1;
            $data['product_price']=$product->selling_price;
            $data['sub_total']=$product->selling_price;
    
            DB::table('pos')->insert($data);
        }

       
        
    }

    public function CartProduct(){
        $cartproduct= DB::table('pos')->get();
        return response()->json($cartproduct);
    }

    public function RemoveCart($id){
        DB::table('pos')->where('id', $id)->delete();  
    }

    public function IncrementCart($id){
      $quantity = DB::table('pos')->where('id',$id)->increment('product_quantity');
      $product = DB::table('pos')->where('id',$id)->first();

      $subtotal = $product->product_quantity * $product->product_price;

      DB::table('pos')->where('id',$id)->update(['sub_total'=>$subtotal]);

      return response('done');
    }
    public function DecrementCart($id){
      $quantity = DB::table('pos')->where('id',$id)->decrement('product_quantity');
      $product = DB::table('pos')->where('id',$id)->first();

      $subtotal = $product->product_quantity * $product->product_price;

      DB::table('pos')->where('id',$id)->update(['sub_total'=>$subtotal]);

      return response('done');
    }

    public function Vats(){
      $vats = DB::table('extra')->first();
      return response()->json($vats);
    }
}
