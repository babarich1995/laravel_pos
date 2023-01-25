<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        
        return response()->json($employee);
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
         'email'=>'required |unique:employees',
         'phone_number'=>'required|unique:employees',
         
        ]);

 

        if ($request->photo) {
            $imagename = time().'.' . explode('/', explode(':', substr($request->photo, 0,
             strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->resize(240,200)->save(public_path('backend/employee/').$imagename);
            $request->merge(['photo' => $imagename]);

             $employee = new Employee;
             
             $employee->name= $request->name;
             $employee->email= $request->email;
             $employee->phone_number= $request->phone_number;
             $employee->address= $request->address;
             $employee->salary= $request->salary;
             $employee->joining_date= $request->joining_date;
             $employee->rollId= $request->rollId;
             $employee->photo= $imagename;
             $employee->save();
           
             

        }
        else{
            $employee = new Employee;

            $employee->name= $request->name;
            $employee->email= $request->email;
            $employee->phone_number= $request->phone_number;
            $employee->address= $request->address;
            $employee->salary= $request->salary;
            $employee->joining_date= $request->joining_date;
            $employee->rollId= $request->rollId;
          
            $employee->save();
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
        //

        $employee= DB::table('employees')->where('id', $id)->first();

        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data['salary']= $request->salary;
        $data['phone_number']= $request->phone_number;
        $data['joining_date']= $request->joining_date;
        $data['rollId']= $request->rollId;
        $image  = $request->newPhoto;
        

        if ($image) {
            $imagename = time().'.' . explode('/', explode(':', substr($image, 0,
            strpos($image, ';')))[1])[1];
            $img= \Image::make($image)->resize(240,200)->save(public_path('backend/employee/').$imagename);
            $request->merge(['photo' => $imagename]);
    
           if ($img) {
            $data['photo'] = $imagename;
            $img_data = DB::table('employees')->where('id', $id)->first();
            $image_path = 'backend/employee/'. $img_data->photo;
            $done = unlink($image_path);
            $user= DB::table('employees')->where('id',$id)->update($data);

           }
        }
        else{
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            $user= DB::table('employees')->where('id',$id)->update($data);
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
        $employee = DB::table('employees')->where('id', $id)->first();
        $photo = 'backend/employee/'.$employee->photo;

        if($photo){
         unlink($photo);
         DB::table('employees')->where('id', $id)->delete();
        }else{
         DB::table('employees')->where('id', $id)->delete();
        }

    }
}
