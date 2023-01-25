<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer= Customer::all();
        return response()->json($customer);
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //
         $validateData = $request->validate([
            'name'=>'required |unique:employees',
            'phone'=>'required|unique:customers',
            
           ]);
   
    
   
           if ($request->photo) {
               $imagename = time().'.' . explode('/', explode(':', substr($request->photo, 0,
                strpos($request->photo, ';')))[1])[1];
               \Image::make($request->photo)->resize(240,200)->save(public_path('backend/customer/').$imagename);
               $request->merge(['photo' => $imagename]);
   
                $customer = new Customer;
                
                $customer->name= $request->name;
                $customer->email= $request->email;
                $customer->phone= $request->phone;
                $customer->address= $request->address;
                $customer->photo= $imagename;
                $customer->save();
              
                
   
           }
           else{
               $customer = new Customer;
   
               $customer->name= $request->name;
               $customer->email= $request->email;
               $customer->phone= $request->phone;
               $customer->address= $request->address;
             
               $customer->save();
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
        $customer= DB::table('customers')->where('id', $id)->first();

        return response()->json($customer); 
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
        $data['name']= $request->name;
        $data['email']= $request->email;
        $data['address']= $request->address;
        $data['phone']= $request->phone;
        $image  = $request->newPhoto;
        

        if ($image) {
            $imagename = time().'.' . explode('/', explode(':', substr($image, 0,
            strpos($image, ';')))[1])[1];
            $img= \Image::make($image)->resize(240,200)->save(public_path('backend/customer/').$imagename);
            $request->merge(['photo' => $imagename]);
    
           if ($img) {
            $data['photo'] = $imagename;
            $img_data = DB::table('customers')->where('id', $id)->first();
            $image_path = 'backend/customer/'. $img_data->photo;
            $done = unlink($image_path);
            $user= DB::table('customers')->where('id',$id)->update($data);

           }
        }
        else{
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            $user= DB::table('customers')->where('id',$id)->update($data);
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
        $customer = DB::table('customers')->where('id', $id)->first();
        $photo = 'backend/customer/'.$customer->photo;

        if($photo){
         unlink($photo);
         DB::table('customers')->where('id', $id)->delete();
        }else{
         DB::table('customers')->where('id', $id)->delete();
        } 
    }
}
