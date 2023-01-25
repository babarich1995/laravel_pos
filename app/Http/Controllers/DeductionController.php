<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deduction= Deduction::all();
        return response()->json($deduction);
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
            'deduction_name'=>'required |unique:deductions',
            'is_percentage'=>'required',
            
           ]);

         
               $deduction = new Deduction;
   
               $deduction->deduction_name= $request->deduction_name;
               $deduction->category= $request->category;
               $deduction->is_percentage= $request->is_percentage;
               $deduction->deduction_percent= $request->deduction_percent;
               $deduction->deduction_amount= $request->deduction_amount;
               $deduction->description= $request->description;
             
               $deduction->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deduction= DB::table('deductions')->where('id', $id)->first();

        return response()->json($deduction);
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
        $data['deduction_name']= $request->deduction_name;
        $data['category']= $request->category;
        $data['is_percentage']= $request->is_percentage;
        $data['deduction_percent']= $request->deduction_percent;
        $data['deduction_amount']= $request->deduction_amount;
        $data['description']= $request->description;
    
        $deduction= DB::table('deductions')->where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('deductions')->where('id', $id)->delete();
    }
    public function DeleteMember($id)
    {
        DB::table('user_deductions')->where('id', $id)->delete();
    }

    public function ViewDeduction($id){
       
        $userdeduction = DB::table('user_deductions')
                       ->join('employees', 'user_deductions.employee_id','employees.id')
                       ->join('deductions','user_deductions.deduction_id', 'deductions.id')
                       ->select('employees.name','employees.salary','deductions.deduction_amount',
                       'deductions.deduction_percent','deductions.deduction_name',
                       'deductions.is_percentage','user_deductions.*')
                       ->where('deductions.id',$id)
                       ->get();
                       return response()->json($userdeduction);
    }

    public function AddMember(Request $request, $id){

        $employee= $request->employee_id;
        $check = DB::table('user_deductions')->where('employee_id',$employee)->where('deduction_id',$id)->first();

        

        if($check){
            return response()->json('User has already been added');
        }else{
            $data=array();

            $data['employee_id']=$request->employee_id;
            $data['deduction_amount']=$request->deduction_amount;
            $data['deduction_percent']=$request->deduction_percent;
            $data['deduction_id']=$id;
            DB::table('user_deductions')->insert($data);
        }
        
    }
}
