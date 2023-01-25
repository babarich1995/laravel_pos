<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $supplier = Supplier::all();

        return response()->json($supplier);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'=>'required |unique:suppliers',
            'email'=>'required |unique:suppliers',
            'phone'=>'required|unique:suppliers',
            
           ]);
   
    
   
           if ($request->photo) {
               $imagename = time().'.' . explode('/', explode(':', substr($request->photo, 0,
                strpos($request->photo, ';')))[1])[1];
               \Image::make($request->photo)->resize(240,200)->save(public_path('backend/supplier/').$imagename);
               $request->merge(['photo' => $imagename]);
   
                $supplier = new Supplier;
                
                $supplier->name= $request->name;
                $supplier->email= $request->email;
                $supplier->phone= $request->phone;
                $supplier->address= $request->address;
                $supplier->shopname= $request->shopname;
                $supplier->photo= $imagename;
                $supplier->save();
              
                
   
           }
           else{
               $supplier = new Supplier;
   
               $supplier->name= $request->name;
               $supplier->email= $request->email;
               $supplier->phone= $request->phone;
               $supplier->address= $request->address;
               $supplier->shopname= $request->shopname;
              
             
               $supplier->save();
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
        $supplier= DB::table('suppliers')->where('id', $id)->first();

        return response()->json($supplier);
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
        $data['shopname']= $request->shopname;
        $data['phone']= $request->phone;
        $image  = $request->newPhoto;
        

        if ($image) {
            $imagename = time().'.' . explode('/', explode(':', substr($image, 0,
            strpos($image, ';')))[1])[1];
            $img= \Image::make($image)->resize(240,200)->save(public_path('backend/supplier/').$imagename);
            $request->merge(['photo' => $imagename]);
    
           if ($img) {
            $data['photo'] = $imagename;
            $img_data = DB::table('suppliers')->where('id', $id)->first();
            $image_path = 'backend/supplier/'. $img_data->photo;
            $done = unlink($image_path);
            $user= DB::table('suppliers')->where('id',$id)->update($data);

           }
        }
        else{
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            $user= DB::table('suppliers')->where('id',$id)->update($data);
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
        $supplier = DB::table('suppliers')->where('id', $id)->first();
        $photo = 'backend/supplier/'.$supplier->photo;

        if($photo){
         unlink($photo);
         DB::table('suppliers')->where('id', $id)->delete();
        }else{
         DB::table('suppliers')->where('id', $id)->delete();
        }
    }
}
