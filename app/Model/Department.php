<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Users;
use App\Model\Department;
use PDF;
use Config;
use File;

class Department extends Model
{
    protected $table = 'department';

    public function saveDepartment($request){
        
        $id = DB::table('department')->insertGetId(
                                                    ['department_name' => $request->input('department_name'),
                                                    'created_at' => date('Y-m-d H:i:s'),
                                                    'updated_at' => date('Y-m-d H:i:s')
                                                    ]
                                                );
        $designation=$request->input('designation');
        for($i=0;$i<count($request->input('designation'));$i++){
            $objDesignation = new Designation();
            if($designation[$i] != ""){
                $objDesignation->department_id = $id;
                $objDesignation->designation_name = $designation[$i];
                $objDesignation->created_at = date('Y-m-d H:i:s');
                $objDesignation->updated_at = date('Y-m-d H:i:s');
                $objDesignation->save();
            }
        }
        return true;
    }
    
    public function getDepartment()
    {
         $arrDepartment = Department::
            // where('company_id', $company_id)
                pluck('department_name', 'id')
                ->toArray();
        return $arrDepartment;
    }

    public function getdatatable()
    {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'department.id',
            1 => 'department.department_name',
            2 => 'designation.designation_name',
        );

        // $query = Department::join('designation', 'designation.department_id', '=', 'department.id');  /*using join*/
        $query = Department::with(['designation']); /*using eloquent relationship*/
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
            foreach ($row->designation as $key => $value) {
                $nestedData[1][] = $value["designation_name"];
            }
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
        // dd($request->input('designation'));
        $id = $request->input('edit_id');
        /*find & update department*/
        $findDepartment = Department::where('id', $id)->update(['department_name' => $request->department_name, 'updated_at' => date('Y-m-d H:i:s')]);

        /*find & update designations*/
        $findDesignation = Designation::where('department_id', $id)->get();

        foreach($findDesignation as $designation) {
            $deleteDesignation = $designation->delete();
        }

        $designation = $request->input('designation');
        for($i=0;$i<count($request->input('designation'));$i++){
            $objDesignation = new Designation();
            if($designation[$i] != ""){
                $objDesignation->department_id = $id;
                $objDesignation->designation_name = $designation[$i];
                $objDesignation->created_at = date('Y-m-d H:i:s');
                $objDesignation->updated_at = date('Y-m-d H:i:s');
                $objDesignation->save();
            }
        }
        return TRUE;
    }
}
