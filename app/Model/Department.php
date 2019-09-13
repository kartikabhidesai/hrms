<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Employee;
use App\Model\Users;
use App\Model\Department;
use PDF;
use Config;
use File;

class Department extends Model
{
    protected $table = 'department';

    public function saveDepartment($request)
    {    
       
    	if(Auth::guard('company')->check()) {
    		$userData = Auth::guard('company')->user();
    		$getAuthCompanyId = Company::where('email', $userData->email)->first();
    	}       

        $id = DB::table('department')->insertGetId(
                    ['department_name' => $request->input('department_name'),
                    'company_id' => $getAuthCompanyId->id,
                    'manager_name' => $request->input('manager_name'),
                    'co_manager_name' => $request->input('comanager_name'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                    ]
                );
        $designation = $request->input('designation');
        $supervisor = $request->input('supervisor_name');
        for($i=0;$i<count($request->input('designation'));$i++) {
            $objDesignation = new Designation();
            if($designation[$i] != "") {
                $objDesignation->department_id = $id;
                $objDesignation->designation_name = $designation[$i];
                $objDesignation->supervisor_name = $supervisor[$i];
                $objDesignation->created_at = date('Y-m-d H:i:s');
                $objDesignation->updated_at = date('Y-m-d H:i:s');
                $objDesignation->save();
            }
        }
        return TRUE;
    }
    
    public function getDepartment()
    {
        $userData = Auth::guard('company')->user();
        $getAuthCompanyId = Company::where('email', $userData->email)->first();

        $arrDepartment = Department::
                            // where('company_id', $company_id)
                            where('company_id', $getAuthCompanyId->id)
                            ->pluck('department_name', 'id')
                            ->toArray();
                
        return $arrDepartment;
    }
    
    public function getAllDepartment($companyId){
        $department = Department::select("department_name","id")
                    ->where('company_id', $companyId)
                    ->get();
        return $department;
        
    }

    public function getDepartmentCompany($company_Id)
    {
        $arrDepartment = Department::
                            // where('company_id', $company_id)
                            where('company_id', $company_Id)
                            ->pluck('department_name', 'id')
                            ->toArray();
               
        return $arrDepartment;
    }
    
    public function getEmployeeDepartment()
    {
        $userData = Auth::guard('employee')->user();
        $getAuthCompanyId = Employee::where('email', $userData->email)->first();
        $arrDepartment = Department::
                            // where('company_id', $company_id)
                            where('company_id', $getAuthCompanyId['company_id'])
                            ->pluck('department_name', 'id')
                            ->toArray();
                
        return $arrDepartment;
    }

    public function getdatatable($companyId){
        
        $requestData = $_REQUEST;
        $userData = Auth::guard('company')->user();
//        $companyId = Company::where('email', $userData->email)->first();
        $columns = array(
            // datatable column index  => database column name
            0 => 'department.department_name',
            1 => 'department.manager_name',
            2 => 'department.co_manager_name',
            3 => 'designation.designation_name',
            4 => 'department.id',
            5 => 'department.company_id'
        );

        $query = Department::leftjoin('designation', 'designation.department_id', '=', 'department.id')
                             ->where('department.company_id',$companyId);
        if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $searchVal = $requestData['search']['value'];
            $query->where(function($query) use ($columns, $searchVal, $requestData) {
                $flag = 0;
                foreach ($columns as $key => $value) {
                    $searchVal = $requestData['search']['value'];
                    if ($requestData['columns'][$key]['searchable'] == 'true') {
                        if ($flag == 0) {
                            $query->where($value, 'like','%'.$searchVal.'%');
                            $flag = $flag + 1;
                        } else {
                            $query->orWhere($value, 'like', '%'.$searchVal.'%');
                        }
                    }
                }
            });
        }
        
        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
         $query->groupBy('department.id');
        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());
        $resultArr = $query->skip($requestData['start'])
                            ->take($requestData['length'])           
                            ->select('department.manager_name', 'department.co_manager_name', 'department.id', 'department.company_id','department.department_name',DB::raw('GROUP_CONCAT(designation.designation_name) AS designation_name'),DB::raw('GROUP_CONCAT(designation.supervisor_name) AS supervisor_name'))
                            ->get();

        $data = array();
       
        foreach ($resultArr as $row) {
            $actionHtml ='';
            $actionHtml .= '<a href="' . route('department-edit', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm deleteDepartment" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["department_name"];
            $nestedData[] = $row["manager_name"];
            $nestedData[] = $row["co_manager_name"];
            $nestedData[] =  $row["designation_name"];
            $nestedData[] =  $row["supervisor_name"];
//            $nestedData[] = '1';
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
    public function getdatatableV2(){
        $requestData = $_REQUEST;
        $userData = Auth::guard('company')->user();
        $companyId = Company::where('email', $userData->email)->first();
        $columns = array(
            // datatable column index  => database column name
            0 => 'department.id',
            1 => 'department.department_name',
            2 => 'designation.designation_name',
        );

        // $query = Department::join('designation', 'designation.department_id', '=', 'department.id');  /*using join*/
        $query = Department::with(['designation'])->where('company_id', $companyId->id); /*using eloquent relationship*/
        // ->groupBy('designation.department_id');
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
                            // ->select('department.id', 'department.department_name','designation_name')
                            ->get();

        $data = array();
        foreach ($resultArr as $row) {
            $actionHtml ='';
            $actionHtml .= '<a href="' . route('department-edit', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm deleteDepartment" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["department_name"];
            $desigArr = [];
            foreach ($row->designation as $key => $value) {
                $desigArr[] = $value["designation_name"];
            }
            $nestedData[] = implode(', ', $desigArr);
            $nestedData[] = '1';
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

    /*Relationship for designation*/
    public function designation()
    {
        return $this->hasMany('App\Model\Designation');
    }

    public function editDepartment($request)
    {
        
        $name = '';
        $id = $request->input('edit_id');

        if($request->input('designation') == null) {
        	return false;
        }
        /*find & update department*/
        $findDepartment = Department::where('id', $id)
                        ->update([
                                'department_name' => $request->department_name,
                                'manager_name' => $request->input('manager_name'),
                                'co_manager_name' => $request->input('comanager_name'),
                                'updated_at' => date('Y-m-d H:i:s')]);

        /*find & update designations*/
        $findDesignation = Designation::where('department_id', $id)->get();

        foreach($findDesignation as $designation) {
            $deleteDesignation = $designation->delete();
        }

        $designation = $request->input('designation');
        $supervisor = $request->input('supervisor_name');
        for($i=0;$i<count($request->input('designation'));$i++){
            $objDesignation = new Designation();
            if($designation[$i] != ""){
                $objDesignation->department_id = $id;
                $objDesignation->designation_name = $designation[$i];
                $objDesignation->supervisor_name = $supervisor[$i];
                $objDesignation->created_at = date('Y-m-d H:i:s');
                $objDesignation->updated_at = date('Y-m-d H:i:s');
                $objDesignation->save();
            }
        }
        return TRUE;
    }

    public function getDepartmentByCompany($company_id)
    {
        $arrDepartment = Department::where('company_id', $company_id)
                            ->pluck('department_name', 'id')
                            ->toArray();
        // print_r($arrDepartment);exit;
        return $arrDepartment;
    }
    
    public function changeManager($request){
        
        $managerName = Department::where("id", $request)
                        ->select('manager_name')
                        ->get();
                return $managerName;
    }
}
