<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Config;

class TraningEmployeeDepartment extends Model {

    protected $table = 'training_emp_dept';
    public function addTraningDetails($request,$traningId) {

        $deptId = $request->input('departmentid');
        $employeeid = $request->input('employeeid');
        foreach ($deptId as $key => $value) {
            if(isset($employeeid[$key]) && isset($deptId[$key])){
                $objTraning = new TraningEmployeeDepartment();
                $objTraning->training_id = $traningId;
                $objTraning->employee_id = $employeeid[$key];
                $objTraning->department_id = $deptId[$key];
                $objTraning->created_at = date('Y-m-d H:i:s');
                $objTraning->updated_at = date('Y-m-d H:i:s');
                $objTraning->save();
                $objTraning = '';    
            }
        }
        return TRUE;

    }

}
