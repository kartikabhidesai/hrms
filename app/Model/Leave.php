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
use Config;

class Leave extends Model {

    protected $table = 'leaves';

    public function addnewleave($request) {

        $objTypeOfRequest = new TypeOfRequest();
        if($request->input('typeRequest') == 'addNew' && $request->input('request_name') != ''){
            $typeRequest = $objTypeOfRequest->addTypesOfRequest($request ,$request->input('empid'), $request->input('company_id'));
        }else{
            $typeRequest = $request->input('typeRequest');
        }

        $objLeave = new Leave();
        $objLeave->emp_id = $request->input('empid');
        
        $objLeave->cmp_id = $request->input('company_id');
        $objLeave->type_of_req_id = $typeRequest;
        $objLeave->start_date = date('Y-m-d',strtotime($request->input('start_date')));
        $objLeave->end_date = date('Y-m-d',strtotime($request->input('end_date')));
        $objLeave->reason = $request->input('reason');
        $objLeave->created_at = date('Y-m-d H:i:s');
        $objLeave->updated_at = date('Y-m-d H:i:s');
        $objLeave->save();

        /*Save new record in Attendance History table*/
        $objAttendanceHistory = new AttendanceHistory();
        $objAttendanceHistory->company_id = $request->input('company_id');
        $objAttendanceHistory->employee_id = $request->input('empid');
        
        $objAttendanceHistory->leave_id = $objLeave->id;
        $objAttendanceHistory->time_change_request_id = null;
        $objAttendanceHistory->save();

        return TRUE;
    }
    public function editleave($request) {

         $objTypeOfRequest = new TypeOfRequest();
        if($request->input('typeRequest') == 'addNew' && $request->input('request_name') != ''){
            $typeRequest = $objTypeOfRequest->addTypesOfRequest($request ,$request->input('empid'), $request->input('company_id'));
        }else{
            $typeRequest = $request->input('typeRequest');
        }
        $objLeave = Leave::find($request->input('editId'));
        $objLeave->start_date = date('Y-m-d',strtotime($request->input('start_date')));
        $objLeave->end_date = date('Y-m-d',strtotime($request->input('end_date')));
        $objLeave->reason = $request->input('reason');
        $objLeave->type_of_req_id = $typeRequest;
        $objLeave->updated_at = date('Y-m-d H:i:s');
        $objLeave->save();

        return TRUE;
    }
    

    public function getLeaveDatatable($userid) {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'lv.id',
            1 => 'lv.start_date',
            2 => 'lv.end_date',
            3 => 'lv.reason',
        );
        $query = Leave::from('leaves as lv')
                ->join('employee as emp','lv.emp_id','=','emp.id')
                ->join('department as depart', 'emp.department', '=', 'depart.id')
                ->where('lv.emp_id',$userid);
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
           ->select('depart.department_name','lv.id', 'lv.start_date','lv.end_date','lv.type_of_req_id', 'lv.reason')->get();
        $data = array();

        $objTypeOfRequest = new TypeOfRequest();
        $type_of_request = $objTypeOfRequest->getTypeOfRequestV2($userid);
        // $type_of_request=Config::get('constants.type_of_request');


        foreach ($resultArr as $row) {
//           $actionHtml = $request->input('gender');
           $actionHtml = '<a href="' . route('edit-leave', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm leaveDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["department_name"];
            $nestedData[] = date('d-m-Y',strtotime($row["start_date"]));
            $nestedData[] = date('d-m-Y',strtotime($row["end_date"]));
            // $nestedData[] = $type_of_request[$row["type_of_req_id"]];
            $nestedData[] = $row["reason"] ? $row["reason"] : 'N.A.';
            
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
}
