<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    //
public function Salary(){
    $salary = DB::table('salaries')->select('salary_month')->groupBy('salary_month')->get();
    return response()->json($salary);
}


public function payroll(){
    $salary = DB::table('employees')
    ->join('user_deductions','user_deductions.employee_id','employees.id')
    ->join('user_allowances','user_allowances.employee_id','employees.id')
    ->select('user_allowances.allowance_amount','user_allowances.allowance_percent', 
    'user_deductions.deduction_amount', 'user_deductions.deduction_percent','employees.*')->get();
    
    
    return response()->json($salary);
}

    public function Paid(Request $request, $id){
        $validateData = $request->validate([
            'salary_month'=>'required',
            
            
           ]);
           $month= $request->salary_month;
           $check = DB::table('salaries')->where('employee_id',$id)->where('salary_month',$month)->first();
           if ($check) {
           return response()->json('Salary Already Paid');
           }else{
            $data= array();
            $data['employee_id'] = $id;
            $data['allowance_amount'] = $request->allowance_amount;
            $data['amount'] = $request->salary;
            $data['salary_date']=date('d/m/Y');
            $data['salary_month']=$month;
            $data['salary_year']=date('Y');
 
            DB::table('salaries')->insert($data);
           }
        
    }

    public function ViewSalary($id){
     $month = $id;
     $salary = DB::table('salaries')
     ->join('employees','salaries.employee_id','employees.id')
     ->join('allowances','salaries.allowance_id','allowances.id')
     ->select('employees.name', 'allowances.name', 'salaries.*')
     ->where('salaries.salary_month', $month)
     ->get();

     
     return response()->json($salary);
    }

    public function EditSalary($id){
      
        $editsalary = DB::table('salaries')
        ->join('employees','salaries.employee_id','employees.id')
        ->select('employees.name','employees.email','salaries.*')
        ->where('salaries.id', $id)
        ->first();
        return response()->json($editsalary);
    }

    public function UpdateSalary(Request $request,$id){

        $data = array();
        $data['employee_id']= $request->employee_id;
        $data['amount'] = $request->amount;
        $data['salary_month']= $request->salary_month;

        DB::table('salaries')->where('id', $id)->update($data);
    }
}
