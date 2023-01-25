<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllowanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allowance= Allowance::all();
        return response()->json($allowance);
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
            'allowance_name'=>'required |unique:allowances',
            'is_percentage'=>'required',
            
           ]);

         
               $allowance = new Allowance;
   
               $allowance->allowance_name= $request->allowance_name;
               $allowance->category= $request->category;
               $allowance->is_percentage= $request->is_percentage;
               $allowance->allowance_percent= $request->allowance_percent;
               $allowance->allowance_amount= $request->allowance_amount;
               $allowance->description= $request->description;
             
               $allowance->save();
           
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $allowance= DB::table('allowances')->where('id', $id)->first();

        return response()->json($allowance); 
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
        $data['allowance_name']= $request->name;
        $data['category']= $request->category;
        $data['is_percentage']= $request->is_percentage;
        $data['allowance_percent']= $request->percent;
        $data['allowance_amount']= $request->amount;
        $data['description']= $request->description;
    
        $allowance= DB::table('allowances')->where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('allowances')->where('id', $id)->delete();
    }
    public function DeleteMember($id)
    {
        DB::table('user_allowances')->where('id', $id)->delete();
    }


    
    public function ViewAllowance($id){
       
        $userallowance = DB::table('user_allowances')
                       ->join('employees', 'user_allowances.employee_id','employees.id')
                       ->join('allowances','user_allowances.allowance_id', 'allowances.id')
                       ->select('employees.name','employees.salary','user_allowances.*')
                       ->where('user_allowances.allowance_id',$id)
                       ->get();
                       return response()->json($userallowance);
    }

    public function UserAllowance(){
       
      
        $userallowance = DB::table('user_allowances')->get();
    
        return response()->json($userallowance);

                       
    }

    public function AddMember(Request $request, $id){


        $employee= $request->employee_id;
        $check = DB::table('user_allowances')->where('employee_id',$employee)->where('allowance_id',$id)->first();

        if ($check) {
            return response()->json('This member already exists');
            }else{
                $data=array();

                $data['employee_id']=$request->employee_id;
                $data['allowance_amount']=$request->allowance_amount;
                $data['allowance_percent']=$request->allowance_percent;
                $data['allowance_id']=$id;
               
                DB::table('user_allowances')->insert($data);

            }


      
    }
}
