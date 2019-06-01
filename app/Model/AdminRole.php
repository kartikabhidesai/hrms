<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\AdminUserHasPermission;
use App\Model\Sendmail;
use App\Model\Users;
use App\Model\Emails;
use PDF;
use Config;

class AdminRole extends Model {

    protected $table = 'admin_role';
    
    public function createAdminRole($request,$user_id = NULL){
        $UserFind = Users::select('email')->where('email', $request->input('email'))->get();
        $result = AdminRole::select('email')->where('email', $request->input('email'))->get();
        if (count($result) == 0 &&  count($UserFind) == 0) {
            $newAdminRole=new AdminRole();
            $newpass = Hash::make($request->input('password'));
            $newAdminRole->user_name=$request->input('user_name');
            $newAdminRole->email=$request->input('email');
            $newAdminRole->password=$newpass;
            $newAdminRole->user_id = $user_id;
            $newAdminRole->status=$request->input('status');
            $newAdminRole->created_at = date('Y-m-d H:i:s');
            $newAdminRole->updated_at = date('Y-m-d H:i:s');
            if($newAdminRole->save()){
                    $lastId = $newAdminRole->id;
                    
                    $newUser=new Users();
                    $newUser->name = $request->input('user_name');
                    $newUser->email = $request->input('email');
                    $newUser->password = $newpass ;
                    $newUser->type = "ADMIN";
                    $newUser->created_at = date('Y-m-d H:i:s');
                    $newUser->updated_at = date('Y-m-d H:i:s');
                    $result = $newUser->save();
                    if($result){
                        $userId = $newUser->id;                    
                        $objAdminRole=AdminRole::find($lastId);
                        $objAdminRole->user_id=$userId;
                        $objAdminRole->save();
                        if($result){
                            if (!empty($request->input('checkboxes'))) {
                            $permisson = $request->input('checkboxes');
                                for ($i = 0; $i < count($permisson); $i++) {
                                    $systemUser = new AdminUserHasPermission();
                                    $systemUser->permission_id = $permisson[$i];
                                    $systemUser->admin_role_id = $lastId;
                                    $systemUser->user_id = $userId;
                                    $systemUser->updated_at = date('Y-m-d H:i:s');
                                    $systemUser->created_at = date('Y-m-d H:i:s');
                                    $result = $systemUser->save();
                                }
                            }
                            return true;
                        }else{
                            return false; 
                        }
                    }else{
                       return false; 
                    }
            }else{
                return false; 
            }
        }else{
            return '2';
        }
    }    
    
    
    public function createCompanyRole($request,$companyId = NULL){
        $UserFind = Users::select('email')->where('email', $request->input('email'))->get();
        $result = AdminRole::select('email')->where('email', $request->input('email'))->get();
        
        if (count($result) == 0 &&  count($UserFind) == 0) {
            
            $newAdminRole=new AdminRole();
            
            $newpass = Hash::make($request->input('password'));
            
            $newAdminRole->user_name=$request->input('user_name');
            $newAdminRole->email=$request->input('email');
            $newAdminRole->password=$newpass;
            $newAdminRole->company_id = $companyId;
            $newAdminRole->status=$request->input('status');
            $newAdminRole->created_at = date('Y-m-d H:i:s');
            $newAdminRole->updated_at = date('Y-m-d H:i:s');
            if($newAdminRole->save()){
                   
                    $lastId = $newAdminRole->id;
                    
                    $newUser=new Users();
                    $newUser->name = $request->input('user_name');
                    $newUser->email = $request->input('email');
                    $newUser->password = $newpass ;
                    $newUser->type = "COMPANY";
                    $newUser->created_at = date('Y-m-d H:i:s');
                    $newUser->updated_at = date('Y-m-d H:i:s');
                    $result = $newUser->save();
                    if($result){
                        $userId = $newUser->id;                    
                        $objAdminRole=AdminRole::find($lastId);
                        $objAdminRole->user_id=$userId;
                        $objAdminRole->save();
                        if($result){
                            if (!empty($request->input('role'))) {
                            $permisson = $request->input('role');
                                for ($i = 0; $i < count($permisson); $i++) {
                                    $systemUser = new AdminUserHasPermission();
                                    $systemUser->permission_id = $permisson[$i];
                                    $systemUser->admin_role_id = $lastId;
                                    $systemUser->user_id = $userId;
                                    $systemUser->updated_at = date('Y-m-d H:i:s');
                                    $systemUser->created_at = date('Y-m-d H:i:s');
                                    $result = $systemUser->save();
                                }
                            }
                            return "added";
                        }else{
                            return "fails"; 
                        }
                    }else{
                       return false; 
                    }
            }else{
                
            }
        }else{
            return "userExits";
        }
        
    }

    public function editAdminRole($request){
        $UserFind = Users::select('email')->where('id', '!=' , $request->input('role_id'))->where('email', $request->input('email'))->get();
        $result = AdminRole::select('email')->where('id', '!=' , $request->input('role_id'))->where('email', $request->input('email'))->get();
        
        if (count($result) == 0 || count($UserFind) == 0 ) {
            $newAdminRole=  AdminRole::find($request->input('role_id'));
            $newAdminRole->user_name=$request->input('user_name');
            $newAdminRole->email=$request->input('email');
            $newAdminRole->status=$request->input('status');
            $newAdminRole->updated_at = date('Y-m-d H:i:s');
            if($newAdminRole->save()){
                
                $newUser=Users::find($request->input('user_id'));
                $newUser->name = $request->input('user_name');
                $newUser->email = $request->input('email');
                $newUser->updated_at = date('Y-m-d H:i:s');
                $result = $newUser->save();
                
                $lastId = $newAdminRole->id;
                $delete = AdminUserHasPermission::where('admin_role_id',  $request->input('role_id'))->delete();
                if (!empty($request->input('checkboxes'))) {
                    $permisson = $request->input('checkboxes');
                    for ($i = 0; $i < count($permisson); $i++) {
                        $systemUser = new AdminUserHasPermission();
                        $systemUser->permission_id = $permisson[$i];
                        $systemUser->user_id = $request->input('user_id');
                        $systemUser->admin_role_id = $lastId;
                        $systemUser->updated_at = date('Y-m-d H:i:s');
                        $systemUser->created_at = date('Y-m-d H:i:s');
                        $result = $systemUser->save();
                    }
                }
                return true;
            }
        }else{
            return '2';
        }
    }
    
    public function editCompanyRole($request){
        
        $UserFind = Users::select('email')->where('id', '!=' , $request->input('role_id'))->where('email', $request->input('email'))->get();
        $result = AdminRole::select('email')->where('id', '!=' , $request->input('role_id'))->where('email', $request->input('email'))->get();
        
        if (count($result) == 0 || count($UserFind) == 0 ) {
            
            $newAdminRole=  AdminRole::find($request->input('role_id'));
            $newAdminRole->user_name=$request->input('user_name');
            $newAdminRole->email=$request->input('email');
            $newAdminRole->status=$request->input('status');
            $newAdminRole->updated_at = date('Y-m-d H:i:s');
            if($newAdminRole->save()){
                
                $newUser=Users::find($request->input('user_id'));
                $newUser->name = $request->input('user_name');
                $newUser->email = $request->input('email');
                $newUser->updated_at = date('Y-m-d H:i:s');
                $result = $newUser->save();
                
                $lastId = $newAdminRole->id;
                $delete = AdminUserHasPermission::where('admin_role_id',  $request->input('role_id'))->delete();
                if (!empty($request->input('checkboxes'))) {
                    $permisson = $request->input('checkboxes');
                    for ($i = 0; $i < count($permisson); $i++) {
                        $systemUser = new AdminUserHasPermission();
                        $systemUser->permission_id = $permisson[$i];
                        $systemUser->user_id = $request->input('user_id');
                        $systemUser->admin_role_id = $lastId;
                        $systemUser->updated_at = date('Y-m-d H:i:s');
                        $systemUser->created_at = date('Y-m-d H:i:s');
                        $result = $systemUser->save();
                    }
                }
                return true;
            }
        }else{
            return '2';
        }
    }
    
    public function getData($request) {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'ra.id',
            1 => 'ra.user_name',
            2 => 'ra.email',
            3 => 'ra.status',
            4 => 'permission_master.name',
        );

        $query = AdminRole::from('admin_role as ra')->get();
        
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
                ->select('ra.id', 'ra.user_name', 'ra.email', 'ra.status', 'ra.created_at')->get();
        $data = array();
        foreach ($resultArr as $row) {
           $actionHtml = '';
           $actionHtml .= '<a href="' . route('edit-role', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm demoDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["id"];
            $nestedData[] = $row["user_name"];
            $nestedData[] = $row["email"];
            $nestedData[] = $row["status"];
            $nestedData[] = date('d-m-Y',strtotime($row["created_at"]));
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
   
    
    public function getAdminRole(){
        $objAdminRoledata=AdminRole::select('*')->get();
       return ($objAdminRoledata);
    }  
    public function getAdminRoleByCompany($company_id){
        $objAdminRoledata=AdminRole::select('*')->where('company_id', '=', $company_id)->get();
        return ($objAdminRoledata);
    }
    
    
   
    public function getMasterPermisson() {
        $result = DB::table('permission_master')->where('permission_master.is_active', '=', '1')->get();
        return $result;
    }  

    public function getAdminMasterPermisson() {
        $result = DB::table('permission_master')->where('permission_master.is_active', '=', '1')->where('permission_master.type', '=', 'ADMIN')->get();
        return $result;
    }

    public function getCompanyMasterPermisson() {
        $result = DB::table('permission_master')
                ->where('permission_master.is_active', '=', '1')
                ->where('permission_master.type', '=', 'COMPANY')->get();
        return $result;
    }

    public function getAdminRoleData($request,$comanyId) {

        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'ra.user_name',
            1 => 'ra.email',
            2 => 'ra.status',
            3 => 'permission_master.name',
        );

        $query = AdminRole::from('admin_role as ra')
                ->leftjoin('admin_user_has_permission', 'admin_user_has_permission.admin_role_id', '=', 'ra.id')
                ->leftjoin('permission_master', 'permission_master.id', '=', 'admin_user_has_permission.permission_id');
                
        if($comanyId > 0){
             $query->where('ra.company_id',$comanyId);
        }else{
             $query->whereNull('ra.company_id');
        }
        $query->groupBy('ra.id');    
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
                ->select('ra.id','ra.user_id', 'ra.user_name', 'ra.email', 'ra.status','ra.created_at',DB::raw('GROUP_CONCAT(permission_master.name  SEPARATOR ", ") AS permission_name'))->get();
        $data = array();
        foreach ($resultArr as $row) {
           $actionHtml = '';
            if(!empty($comanyId)){
                $actionHtml .= '<a href="' . route('company-edit-role', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            }else{
                $actionHtml .= '<a href="' . route('edit-role', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            }
            $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" data-user_id="'.$row["user_id"].'"  class="link-black text-sm roleDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["user_name"];
            $nestedData[] = $row["email"];
            $nestedData[] = $row["status"];
            $nestedData[] = $row["permission_name"];
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
    
    public function createEmployeeRole($request){
        $objUserDetails= Users::select('*')
                        ->where('id',$request['employeeId'])
                        ->get();
//        print_r($request['companyId']);
//        die();
        if($objUserDetails[0]['name']){
            $newAdminRole=new AdminRole();
            $newAdminRole->user_name=$objUserDetails[0]['name'];
            $newAdminRole->email=$objUserDetails[0]['email'];
            $newAdminRole->password=$objUserDetails[0]['password'];
            $newAdminRole->company_id = $request['companyId'];
            $newAdminRole->user_id = $request['companyId'];
            $newAdminRole->status='ACTIVE';
            $newAdminRole->created_at = date('Y-m-d H:i:s');
            $newAdminRole->updated_at = date('Y-m-d H:i:s');
            if($newAdminRole->save()){
                $lastId = $newAdminRole->id;
                if (!empty($request->input('role'))) {
                    $permisson = $request->input('role');
                        for ($i = 0; $i < count($permisson); $i++) {
                            $systemUser = new AdminUserHasPermission();
                            $systemUser->permission_id = $permisson[$i];
                            $systemUser->admin_role_id = $lastId;
                            $systemUser->user_id = $request['companyId'];
                            $systemUser->updated_at = date('Y-m-d H:i:s');
                            $systemUser->created_at = date('Y-m-d H:i:s');
                            $result = $systemUser->save();
                        }
                }
                return "added";
            }else{
                  return "fails"; 
            }
        }else{
              return "fails"; 
        }
    }
}
