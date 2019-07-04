<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use Config;

class PayrollSetting extends Model {

    protected $table = 'payroll_setting';

    public function addpayrollSetting($request){
       
        $id = Auth()->guard('company')->user()['id'];
        $companyId = Company::select('id')->where('user_id', $id)->first();
        $objPayrollSetting = new PayrollSetting();
        $objPayrollSetting->company_id = $companyId['id'];
        $objPayrollSetting->grade = $request->input('grade');
        $objPayrollSetting->basic_salary = $request->input('basic_salary');
        $objPayrollSetting->payment_date = $request->input('payment_date');
        $objPayrollSetting->created_at = date('Y-m-d H:i:s');
        $objPayrollSetting->updated_at = date('Y-m-d H:i:s');
        
        return ($objPayrollSetting->save());
        
    }
    
    public function getdatatable(){
        $id = Auth()->guard('company')->user()['id'];
        $companyId = Company::select('id')->where('user_id', $id)->first();
        
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'payroll_setting.grade',
            1 => 'payroll_setting.basic_salary',            
            2 => 'payroll_setting.payment_date',
        );
         $query = PayrollSetting::where('payroll_setting.company_id',$companyId['id']);
                 
           
          if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $searchVal = $requestData['search']['value'];
            $query->where(function($query) use ($columns, $searchVal, $requestData) {
                   $flag = 0;
                   foreach ($columns as $key => $value) {
                  $searchVal = $requestData['search']['value'];
                  if ($requestData['columns'][$key]['searchable'] == 'true') {
                      if ($flag == 0) {
                          $query->where($value, 'like', '%' . $searchVal . '%');
                          $flag = $flag + 1;
                      } else {
                          $query->orWhere($value, 'like', '%' . $searchVal . '%');
                      }
                  }
                   }
               });
        }
        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());
        
        $resultArr = $query->skip($requestData['start'])
                    ->take($requestData['length'])
                    ->select('payroll_setting.grade','payroll_setting.id','payroll_setting.basic_salary','payroll_setting.payment_date')->get();
        $data = array();
        
        foreach ($resultArr as $row) {
            $actionHtml = '';
            $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="' . $row['id'] . '" class="link-black text-sm payrollSettingDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["grade"];
            $nestedData[] = $row["basic_salary"];
            $nestedData[] = $row["payment_date"];
            $nestedData[] = $actionHtml;
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        return $json_data;
    }
    
    public function payrollsettingdelete($request){
       $data= $request->input('data');
       $deleteUser = PayrollSetting::where('id', $data['id'])->delete();
       return $deleteUser;
    }
}
