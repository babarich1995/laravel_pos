<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //

    public function TodayOrder(){

        $data = date('d/m/Y');
      
        $order = DB::table('orders')
                ->join('customers', 'orders.customer_id', 'customers.id')
                ->where('order_date',$data)
                ->select('customers.name','orders.*')
                ->orderBy('orders.id', 'DESC')->get();

                return response()->json($order);
    }

    public function OrderDetails($id){
        $order = DB::table('orders')
                ->join('customers', 'orders.customer_id', 'customers.id')
                ->where('orders.id',$id)
                ->select('customers.name','customers.phone', 'customers.address', 'orders.*')
                ->first();

                return response()->json($order);

    }
    public function OrderDetailsAll($id){
        $details = DB::table('order_detail')
                ->join('products', 'order_detail.product_id', 'products.id')
                ->where('order_detail.order_id',$id)
                ->select('products.product_name','products.product_code', 'products.image', 'order_detail.*')
                ->get();

                return response()->json($details);

    }
}
