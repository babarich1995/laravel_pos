<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function FetchProduct($id){
          //get product according to their category id
        $product = DB::table('products')->where('category_id', $id)->get();
        return response()->json($product);
    }

    public function OrderDone(Request $request){
       $validateData = $request->validate([
        'customer_id' => 'required',
        'payment_method' =>'required'
       ]);

       $data = array();
       $data['customer_id']= $request->customer_id;
       $data['getQuantity']= $request->getQuantity;
       $data['getSubTotal']= $request->getSubTotal;
       $data['vat']= $request->vat;
       $data['total']= $request->total;
       $data['pay']= $request->pay;
       $data['due']= $request->due;
       $data['payment_method']= $request->payment_method;
       $data['order_date']= date('d/m/Y');
       $data['order_month']= date('F');
       $data['order_year']= date('Y');

       $order_id = DB::table('orders')->insertGetId($data);

       $contents = DB::table('pos')->get();

       $oddata = array();

       foreach($contents as $content){
        $oddata['order_id']= $order_id;
        $oddata['product_id']= $content->product_id;
        $oddata['product_quantity']= $content->product_quantity;
        $oddata['product_price']= $content->product_price;
        $oddata['sub_total']= $content->sub_total;

        DB::table('order_detail')->insert($oddata);

        //reduce product quantity on submit

        DB::table('products')
            ->where('id',$content->product_id)
            ->update(['product_quantity'=> DB::raw('product_quantity -' . $content->product_quantity)]);
       }

       DB::table('pos')->delete();

       return response('Done');
    }


    public function SearchOrderDate(Request $request){

        $orderdate = $request->date;
        $newDate = new DateTime($orderdate);
        $formatDate = $newDate->format('d/m/Y');

        $order = DB::table('orders')
               ->join('customers', 'orders.customer_id', 'customers.id')
               ->select('customers.name', 'orders.*')
               ->where('orders.order_date', $formatDate)
               ->get();

               return response()->json($order);
    }

    public function TodaySale(){

        $date = date('d/m/Y');
        $sale = DB::table('orders')->where('order_date',$date)->sum('total');

        return response()->json($sale);

    }
    public function TodayIncome(){

        $date = date('d/m/Y');
        $income = DB::table('orders')->where('order_date',$date)->sum('pay');

        return response()->json($income);

    }
    public function TodayDue(){

        $date = date('d/m/Y');
        $due = DB::table('orders')->where('order_date',$date)->sum('due');

        return response()->json($due);

    }
    public function TodayExpense(){
        $date = date('d/m/Y');
        $todayexpense = DB::table('expenses')->where('expense_date',$date)->sum('amount');

        return response()->json($todayexpense);
    }

    public function StockOut(){
        $product = DB::table('products')->where('product_quantity' ,'<', '1')->get();
        return response()->json($product);
    }

    
}
