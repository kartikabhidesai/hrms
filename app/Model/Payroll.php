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

    public function addnewpayroll($request) {
        // echo '<pre>';
        // print_r($request->input());
        // exit;
        $objPayroll = new Payroll();
 		$objPayroll->salary_grade = $request->input('salary_grade');
        $objPayroll->basic_salary = $request->input('basic_salary');
        $objPayroll->over_time = $request->input('over_time');
        $objPayroll->department = $request->input('department');
        $objPayroll->due_date = date('Y-m-d',strtotime($request->input('due_date')));
        $objPayroll->housing = $request->input('housing');
        $objPayroll->medical = $request->input('medical');
        $objPayroll->transportation = $request->input('transportation');
        $objPayroll->travel = $request->input('travel');
    
        $objPayroll->created_at = date('Y-m-d H:i:s');
        $objPayroll->updated_at = date('Y-m-d H:i:s');
        $objPayroll->save();

        return TRUE;
    }

}
