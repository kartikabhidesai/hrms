<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ManageTimeChangeRequest;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Users;
use App\Model\Employee;
class ManageTimeChangeRequest extends Model
{
    protected $table = 'time_change_requests';
    
    public function addnewTimeManage($request,$userDetails){
//        print_r($request->input());exit;
        $objSavedata=new ManageTimeChangeRequest();
        $objSavedata->name = $request->input('name');
        $objSavedata->employee_id = $request->input('empid');
        $objSavedata->company_id = $request->input('company_id');
        $objSavedata->department_id = $request->input('department');
        $objSavedata->from_date = date("Y-m-d", strtotime($request->input('from_date')));
        $objSavedata->to_date = date("Y-m-d", strtotime($request->input('to_date')));
        $objSavedata->date_of_submit = date("Y-m-d", strtotime($request->input('date_of_submit')));
        $objSavedata->request_type = $request->input('typeRequest');
        $objSavedata->total_hours = $request->input('total_hrs');
        $objSavedata->request_description = $request->input('reuest_note');
        $objSavedata->created_at = date('Y-m-d H:i:s');
        $objSavedata->updated_at = date('Y-m-d H:i:s');
        return $objSavedata->save();
    }
    
    public function getManageTimeChangeList($id){
   
        $result=ManageTimeChangeRequest ::select('*')
                     ->where('employee_id',$id)->get();
        return $result;
    }
}
