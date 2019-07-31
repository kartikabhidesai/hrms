<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Users;
use App\Model\TypeOfRequest;
use PDF;
use Config;

class TypeOfRequest extends Model {

    protected $table = 'type_of_request';

    public function addTypesOfRequest($request, $employeeId='', $companyId='') {
        $objTypesOfRequest = new TypeOfRequest();
        $objTypesOfRequest->request_name = $request->input('request_name');
        $objTypesOfRequest->employee_id= $employeeId;
        $objTypesOfRequest->company_id = $companyId;
        $objTypesOfRequest->created_at = date('Y-m-d H:i:s');
        $objTypesOfRequest->updated_at = date('Y-m-d H:i:s');
        $objTypesOfRequest->save();
        return $objTypesOfRequest->id;
    }

    public function getTypeOfRequest($company_id) {
        // echo $company_id;exit;
        // if(isset($company_id) && !empty($company_id)){
            $arrEmployee = TypeOfRequest::whereNull('company_id')->orWhere('company_id', $company_id)->pluck('request_name', 'id')->toArray();
        // // }else{
        //     $arrEmployee = TypeOfRequest::pluck('request_name', 'id')->toArray();
        // }
            $arrEmployee["addNew"]="Add New Type";
        return $arrEmployee;
    }  
    
      
    public function getTypeOfRequestV2($employee_id) {
        
        $arrEmployee = TypeOfRequest::whereNull('employee_id')->orWhere('employee_id', $employee_id)->pluck('request_name', 'id')->toArray();
        $arrEmployee["addNew"]="Add New Type";
        return $arrEmployee;
    }   

}
