<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Company;
use App\Model\TypeOfRequest;
use App\Model\AttendanceHistory;
use App\Model\ExperiencBased;
use App\Model\Employee;
use Config;

class LeaveCategory extends Model {

    protected $table = 'leave_categories';
    protected $fillable = ['company_id','leave_cat_name','type','leave_unit','description','applicable_for','role','work_location','gender','marital_status','period','for_employee_type','leave_count','created_at','updated_at'];
   
    public function addnewleaveCategory($request,$cmp_id) {
        // echo "<pre>as"; print_r($cmp_id); print_r($request->toArray()); exit();
        $id = DB::table('leave_categories')->insertGetId(
            [
            "company_id" => $cmp_id,
            "leave_cat_name" => $request->input('leave_cat_name'),
            "type" => $request->input('type'),
            "leave_type"=>$request->input('leave_type'),
            "leave_unit" => $request->input('leave_unit'),
            "description" => $request->input('description'),
            "applicable_for" => $request->input('applicable_for'),
            "work_location" => $request->input('work_location'),
            "role" => $request->input('role'),
            "gender" => $request->input('gender'),
            "marital_status" => $request->input('marital_status'),
            "period" => $request->input('period'),
            "for_employee_type" => $request->input('for_employee_type'),
            "leave_count" => $request->input('leave_count'),
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')]
        );
        
        if($id){
            if($request->input('for_employee_type') == "experience_base"){
               for($i=0;$i<count($request->input('expriances'));$i++){
                 $id = DB::table('exprience_basd_leave_count')->insertGetId(
                    [
                        "leave_categories_id"=>$id,
                        "employee_type"=>$request->input('expriances')[$i],
                        "name"=>$request->input('entitlement_name')[$i],
                        "year"=>$request->input('year')[$i],
                        "month"=>$request->input('month')[$i],
                        "created_at" => date('Y-m-d H:i:s'),
                        "updated_at" => date('Y-m-d H:i:s')
                    ]); 
                 
               } 
               return true;
            }else{
                return true;
            }
        }else{
            return false;
        }
        
    }
    
    public function leaveDetails($id){
        $query = LeaveCategory::from('leave_categories')
                ->where('leave_categories.id',$id)
                ->select('leave_categories.*')->get();
        return $query;
    }   

    public function getleaveCategoryList($request, $companyId) {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            'leave_cat_name',
            'type',
            'leave_type',
            'leave_unit',
            'description',
            'applicable_for',
            'gender',
            'marital_status',
            'action'
        );
        $query = LeaveCategory::from('leave_categories')
                ->where('company_id',$companyId);

        // echo "<pre>"; print_r($requestData); exit();

        if (!empty($requestData['search']['value'])) {
            $searchVal = $requestData['search']['value'];
            $query->where(function($query) use ($columns, $searchVal, $requestData) {
                $flag = 0;
                foreach ($columns as $key => $value) 
                {
                    if ($requestData['columns'][$key]['searchable'] == 'true') 
                    {
                        // echo $searchVal; exit();
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
           ->select('leave_categories.*')->get();
        $data = array();

        foreach ($resultArr as $row) {
            if($row["leave_type"] == 'leave_request'){
                $row["leave_type"] = "Leave Request";
            }else{
                $row["leave_type"] = "Time Change Request";
            }
//           $actionHtml = $request->input('gender');
            $actionHtml = '<a href="' . route('edit-category-leave', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm leaveDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["leave_cat_name"];
            $nestedData[] = $row["type"];
            $nestedData[] = $row["leave_type"];
            $nestedData[] = $row["leave_unit"];
            $nestedData[] = $row["description"];
            $nestedData[] = $row["applicable_for"];
            $nestedData[] = $row["gender"];
            $nestedData[] = $row["marital_status"];
             $nestedData[] = $actionHtml;
            $data[] = $nestedData;
        }
       // echo "<pre>";print_r($data);exit;

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        return $json_data;
    }
    
    public function editnewleaveCategory($request){
        $id = DB::table('leave_categories')
                ->where('id',$request['editId'])
                ->update(
                    [
                    "leave_cat_name" => $request->input('leave_cat_name'),
                    "type" => $request->input('type'),
                    "leave_unit" => $request->input('leave_unit'),
                    "description" => $request->input('description'),
                    "applicable_for" => $request->input('applicable_for'),
                    "work_location" => $request->input('work_location'),
                    "role" => $request->input('role'),
                    "gender" => $request->input('gender'),
                    "marital_status" => $request->input('marital_status'),
                    "period" => $request->input('period'),
                    "for_employee_type" => $request->input('for_employee_type'),
                    "leave_count" => $request->input('leave_count'),
                    "updated_at" => date('Y-m-d H:i:s')]
                );
                if($id){
                    $deletResult = DB::table('exprience_basd_leave_count')->where('leave_categories_id',$request['editId'])->delete();
                    if($request->input('for_employee_type') == "experience_base"){
                    for($i=0;$i<count($request->input('expriances'));$i++){
                        $id = DB::table('exprience_basd_leave_count')->insertGetId(
                           [
                               "leave_categories_id"=>$id,
                               "employee_type"=>$request->input('expriances')[$i],
                               "name"=>$request->input('entitlement_name')[$i],
                               "year"=>$request->input('year')[$i],
                               "month"=>$request->input('month')[$i],
                               "created_at" => date('Y-m-d H:i:s'),
                               "updated_at" => date('Y-m-d H:i:s')
                           ]); 
                        
                    }
                    return true;
                    }else{
                        return true;
                    } 
                }else{
                    return false;
                }
    }
    
    public function getTypeOfRequest($id){
        $query = Employee::where('user_id',$id)
                ->select('*')->get();
        
        $company_id = $query[0]['company_id'];
        $gender = $query[0]['gender'];
        $martial_status = $query[0]['martial_status'];
         
        $type_of_request = LeaveCategory::select('leave_cat_name','id')
                        ->where('company_id',$company_id)
                        ->where('leave_type','leave_request')
                        ->where('applicable_for','Employee')
                        ->where('for_employee_type','all_emp')
                        ->where('gender','All')
                        ->where('marital_status','All')
                        ->get()->toarray();
        
        $type_of_request_new = LeaveCategory::select('leave_cat_name','id')
                        ->where('company_id',$company_id)
                        ->where('leave_type','leave_request')
                        ->where('applicable_for','Employee')
                        ->where('for_employee_type','all_emp')
                        ->where('gender',$gender)
                        ->where('marital_status',$martial_status)
                        ->get()->toarray();
        
        if(count($type_of_request_new) > 0){
            for($i = 0 ; $i < count($type_of_request_new) ; $i++){
                array_push($type_of_request,$type_of_request_new[$i]);
            }
        }
        
        return $type_of_request;
    }
    
    public function getleaveCategoryListTable($id){
     
         $type_of_request = LeaveCategory::select('leave_cat_name')
                            ->where('id',$id)
                            ->get()
                            ->toarray();
         return $type_of_request[0]['leave_cat_name'];
    }   
    
    public function getTypeOfRequestTimeChangeRequest($id){
         $query = Employee::where('user_id',$id)
                        ->select('*')->get();
        
        $company_id = $query[0]['company_id'];
        $gender = $query[0]['gender'];
        $martial_status = $query[0]['martial_status'];
      
        $type_of_request = LeaveCategory::select('leave_cat_name','id')
                        ->where('company_id',$company_id)
                        ->where('leave_type','time_change_request')
                        ->where('applicable_for','Employee')
                        ->where('for_employee_type','all_emp')
                        ->where('gender','All')
                        ->where('marital_status','All')
                        ->get()->toarray();
        $type_of_request_new = LeaveCategory::select('leave_cat_name','id')
                        ->where('company_id',$company_id)
                        ->where('leave_type','time_change_request')
                        ->where('applicable_for','Employee')
                        ->where('for_employee_type','all_emp')
                        ->where('gender',$gender)
                        ->where('marital_status',$martial_status)
                        ->get()->toarray();
        
        if(count($type_of_request_new) > 0){
            for($i = 0 ; $i < count($type_of_request_new) ; $i++){
                array_push($type_of_request,$type_of_request_new[$i]);
            }
        }
       
        return $type_of_request;
    }
}
?>