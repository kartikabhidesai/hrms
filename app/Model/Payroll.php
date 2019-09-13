<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use Config;

class Payroll extends Model {

    protected $table = 'pay_roll';

    public function addnewpayroll($request, $id)
    {
        $result = Payroll::where('employee_id', '=', $id)
                ->where('month', '=', $request->input('months'))
                ->where('year', '=', $request->input('year'))
                ->count();

        $departmentId = Employee::select('department.id')
                ->join('department', 'employee.department', '=', 'department.id')
                ->where('employee.id', $id)
                ->first();

        if ($result == 0) {
            $objPayroll = new Payroll();
            $objPayroll->employee_id = $id;
            $objPayroll->salary_grade = $request->input('salary_grade');
            $objPayroll->basic_salary = $request->input('basic_salary');
            $objPayroll->over_time = $request->input('over_time');
            // $objPayroll->department = $departmentId->id;
            $objPayroll->due_date = date('Y-m-d', strtotime($request->input('due_date')));
            $objPayroll->housing = $request->input('housing');
            $objPayroll->medical = $request->input('medical');
            $objPayroll->transportation = $request->input('transportation');
            $objPayroll->travel = $request->input('travel');
            $objPayroll->award = $request->input('award');
            $objPayroll->month = $request->input('months');
            $objPayroll->year = $request->input('year');
            $objPayroll->remarks = $request->input('remarks');
            $objPayroll->extra_allowance = json_encode($request->extraallowance);
            $objPayroll->extra_deduction = json_encode($request->extradeduction);
            $objPayroll->created_at = date('Y-m-d H:i:s');
            $objPayroll->updated_at = date('Y-m-d H:i:s');
            $objPayroll->save();
            return 'Added';
        } else {
            return 'Exists';
        }
    }

    public function editPayroll($request, $id)
    {

        $result = Payroll::where('employee_id', '=', $request->input('empId'))
                            ->where('id', '!=', $request->input('editId'))
                            ->where('month', '=', $request->input('months'))
                            ->where('year', '=', $request->input('year'))
                            ->count();

        $departmentId = Employee::select('department.id')
                                ->join('department', 'employee.department', '=', 'department.id')
                                ->where('employee.id', $id)
                                ->first();
                                
        if ($result == 0) {
            $objPayroll = Payroll::find($request->input('editId'));
            $objPayroll->salary_grade = $request->input('salary_grade');
            $objPayroll->basic_salary = $request->input('basic_salary');
            $objPayroll->over_time = $request->input('over_time');
            // $objPayroll->department = $departmentId->id;
            $objPayroll->due_date = date('Y-m-d', strtotime($request->input('due_date')));
            $objPayroll->housing = $request->input('housing');
            $objPayroll->medical = $request->input('medical');
            $objPayroll->transportation = $request->input('transportation');
            $objPayroll->travel = $request->input('travel');
            $objPayroll->award = $request->input('award');
            $objPayroll->month = $request->input('months');
            $objPayroll->year = $request->input('year');
            $objPayroll->remarks = $request->input('remarks');
            if($request->extraallowance) {
                $objPayroll->extra_allowance = json_encode($request->extraallowance);
            }
            if($request->extradeduction) {
                $objPayroll->extra_deduction = json_encode($request->extradeduction);
            }
            $objPayroll->created_at = date('Y-m-d H:i:s');
            $objPayroll->updated_at = date('Y-m-d H:i:s');
            $objPayroll->save();
            return TRUE;
        } else {
            return 'Exists';
        }
    }

    public function getPayroll($id)
    {
        return Payroll::select('pay_roll.*')->where('employee_id', '=', $id)->get()->toArray();
    }

    public function getPayrollV2($id)
    {
        return Payroll::select('pay_roll.*')->where('id', '=', $id)->get()->toArray();
    }

    public function getPayslipPdfDetail($postData, $id)
    {
        $result = Payroll::select('pay_roll.*', 'employee.id as emp_id', 'employee.name as empName', 'comapnies.company_name')
                            ->leftjoin('employee', 'employee.id', '=', 'pay_roll.employee_id')
                            ->leftjoin('department', 'employee.department', '=', 'department.id')
                            ->leftjoin('comapnies', 'comapnies.id', '=', 'employee.company_id')
                            ->where('pay_roll.month', $postData['months'])
                            ->where('pay_roll.year', $postData['year'])
                            ->where('pay_roll.employee_id', $id)
                            ->get()
                            ->toArray();
        
        return $result;
    }

    public function getPayslipmodalDetail($Data)
    {
        print_r($Data);
        die();
        $result = Payroll::select('pay_roll.*', 'employee.id as emp_id', 'employee.name as empName', 'comapnies.company_name')
                            ->leftjoin('employee', 'employee.id', '=', 'pay_roll.employee_id')
                            ->leftjoin('department', 'employee.department', '=', 'department.id')
                            ->leftjoin('comapnies', 'comapnies.id', '=', 'employee.company_id')
                            ->where('pay_roll.month', $Data['month'])
                            ->where('pay_roll.year', $Data['year'])
                            ->where('pay_roll.employee_id', $Data['employeeid'])
                            ->get()
                            ->toArray();
        return json_encode($result);
    }

    public function getTransactionDetails($postData)
    {
        // print_r($postData);exit;
        $sql = Payroll::select('pay_roll.*', 'employee.id as emp_id', 'employee.name as empName', 'comapnies.company_name')
        ->leftjoin('employee', 'employee.id', '=', 'pay_roll.employee_id')
        ->leftjoin('department', 'employee.department', '=', 'department.id')
        ->leftjoin('comapnies', 'comapnies.id', '=', 'employee.company_id');
        $startDate = '';
        $endDate = '';
        $currentDate = date('Y-m-d');
        if($postData['transaction'] == 'specific_date'){
            $startDate = date('Y-m-d', strtotime($postData['from_date']));
            $endDate = date('Y-m-d', strtotime($postData['to_date']));
        }else if($postData['transaction'] == '3_months'){
            $startDate = date('Y-m-d', strtotime("-3 months", strtotime($currentDate)));
            $endDate = date('Y-m-d');
        }else if($postData['transaction'] == '6_months'){
            $startDate = date('Y-m-d', strtotime("-6 months", strtotime($currentDate)));
            $endDate = date('Y-m-d');
        }else if($postData['transaction'] == 'last_year'){
            $startDate = date('Y-m-d', strtotime("-12 months", strtotime($currentDate)));
            $endDate = date('Y-m-d');
        }
        // echo $startDate;exit;
        if (!empty($startDate) && !empty($endDate)) {
            $sql->Where(function($sql) use($startDate, $endDate) {
                $sql->orWhere(function($sql) use($startDate, $endDate) {
                    $sql->whereBetween('pay_roll.created_at', [$startDate, $endDate]);
                });
            });
        }
        $result =  $sql->get()->toArray();
       // echo '<pre/>';
       // print_r($result);exit;
        return $result;
    }
}
