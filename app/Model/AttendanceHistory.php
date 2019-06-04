<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\AttendanceHistory;
use App\Model\TypeOfRequest;
use Auth;
use Config;

class AttendanceHistory extends Model
{
    protected $table = 'attendance_history';

    protected $fillable = ['company_id', 'employee_id', 'leave_id', 'time_change_request_id'];

    public function getDataTableForHistoy($request)
    {
        $data=$request->input('data');
         if($data['from_date'] != NULL){
            $fromDate=date('Y-m-d', strtotime($data['from_date']));
         }else{
            $fromDate=""; 
         }
         if($data['to_date'] != NULL){
            $to_date=date('Y-m-d', strtotime($data['to_date']));
         }else{
            $to_date=""; 
         }
        
        $department_id=$data['department_id'];
       
        $requestData = $_REQUEST;
        $userData = Auth::guard('company')->user();
        $companyId = Company::where('email', $userData->email)->first();

        $columns = array(
            // datatable column index  => database column name
            0 => 'employee.name',
            1 => 'start_date',
            2 => 'end_date',
            3 => 'type_of_req_id',
            4 => 'department_name',
        );
       
//        $where = 'attendance_history.company_id = '.$companyId->id.'';
        
//        if($fromDate != ''){
//            $where .= 'AND (`leaves`.`start_date` >= '.$fromDate.' OR `time_change_requests`.`from_date` >= '.$fromDate.')';
//        }
//        if($to_date != ''){
//            $where .= 'AND (`leaves`.`end_date` <= '.$to_date.' OR `time_change_requests`.`to_date` <= '.$to_date.' )';
//        }
        $query = AttendanceHistory::select('attendance_history.id', 'employee.name', 'leaves.start_date', 'leaves.end_date', 'leaves.type_of_req_id', 'department.department_name', 'time_change_requests.request_type', 'time_change_requests.from_date', 'time_change_requests.to_date')
                                                ->join('employee', 'attendance_history.employee_id', '=', 'employee.id')
                                                ->join('department', 'employee.department', '=', 'department.id')
                                                ->leftjoin('time_change_requests', 'attendance_history.time_change_request_id', '=', 'time_change_requests.id')
                                                ->leftjoin('leaves', 'attendance_history.leave_id', '=', 'leaves.id')
                                                ->where('attendance_history.company_id', $companyId->id);
                                                
                                                if($department_id != "all"){
                                                    $query->where('employee.department',"=",$department_id);
                                                }
                                                
                                                if($fromDate != NULL){
                                                    $query->where('leaves.start_date','>=',$fromDate);
                                                    $query->orWhere('time_change_requests.from_date','>=',$fromDate);
                                                }

                                                if($to_date != NULL){
                                                    $query->where('leaves.end_date','<=',$to_date);
                                                    $query->orWhere('time_change_requests.to_date','<=',$to_date);
                                                }

                                               
        if (!empty($requestData['search']['value'])) {
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

        // $type_of_request=Config::get('constants.type_of_request');

        $objTypeOfRequest = new TypeOfRequest();
        $type_of_request = $objTypeOfRequest->getTypeOfRequest($companyId->id);
//print_r($type_of_request);exit;
        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());
        $resultArr = $query->skip($requestData['start'])
                            ->take($requestData['length'])
                            ->get();
        //print_r($resultArr);exit;
        $data = array();
        foreach ($resultArr as $row) {
            $actionHtml ='';
            $actionHtml .= '<a href="#historyDetailsModel" class="historyDetailsModel" data-toggle="modal" data-id="'.$row['id'].'"  title="Review" data-toggle="tooltip" data-original-title="Review" >Review</a>';
            $nestedData = array();
            $nestedData[] = $row["start_date"] ? $row["start_date"] : $row["from_date"];
            $nestedData[] = $row["end_date"] ? $row["end_date"] : $row["to_date"];
            $nestedData[] = $row["name"];
            $nestedData[] = $row["department_name"];
            $nestedData[] = (($row["type_of_req_id"] != '') ? $type_of_request[$row["type_of_req_id"]] : (($row["request_type"] != '')?$type_of_request[$row["request_type"]]:''));
            $desigArr = [];
            $nestedData[] = $actionHtml;
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        return $json_data;
    }
    
     public function getDataEmployeeTableForHistoy($request)
    {
        $data=$request->input('data');
         if($data['from_date'] != NULL){
            $fromDate=date('Y-m-d', strtotime($data['from_date']));
         }else{
            $fromDate=""; 
         }
         if($data['to_date'] != NULL){
            $to_date=date('Y-m-d', strtotime($data['to_date']));
         }else{
            $to_date=""; 
         }
        
        $department_id=$data['department_id'];
       
        $requestData = $_REQUEST;
        $userData = Auth::guard('employee')->user();
        $companyId = Employee::where('email', $userData['email'])->first();
//        print_r($companyId['company_id']);
//        die();
        $columns = array(
            // datatable column index  => database column name
            0 => 'employee.name',
            1 => 'start_date',
            2 => 'end_date',
            3 => 'type_of_req_id',
            4 => 'department_name',
        );
       
//        $where = 'attendance_history.company_id = '.$companyId->id.'';
        
//        if($fromDate != ''){
//            $where .= 'AND (`leaves`.`start_date` >= '.$fromDate.' OR `time_change_requests`.`from_date` >= '.$fromDate.')';
//        }
//        if($to_date != ''){
//            $where .= 'AND (`leaves`.`end_date` <= '.$to_date.' OR `time_change_requests`.`to_date` <= '.$to_date.' )';
//        }
        $query = AttendanceHistory::select('attendance_history.id', 'employee.name', 'leaves.start_date', 'leaves.end_date', 'leaves.type_of_req_id', 'department.department_name', 'time_change_requests.request_type', 'time_change_requests.from_date', 'time_change_requests.to_date')
                                                ->join('employee', 'attendance_history.employee_id', '=', 'employee.id')
                                                ->join('department', 'employee.department', '=', 'department.id')
                                                ->leftjoin('time_change_requests', 'attendance_history.time_change_request_id', '=', 'time_change_requests.id')
                                                ->leftjoin('leaves', 'attendance_history.leave_id', '=', 'leaves.id')
                                                ->where('attendance_history.company_id', $companyId['company_id']);
                                                
                                                if($department_id != "all"){
                                                    $query->where('employee.department',"=",$department_id);
                                                }
                                                
                                                if($fromDate != NULL){
                                                    $query->where('leaves.start_date','>=',$fromDate);
                                                    $query->orWhere('time_change_requests.from_date','>=',$fromDate);
                                                }

                                                if($to_date != NULL){
                                                    $query->where('leaves.end_date','<=',$to_date);
                                                    $query->orWhere('time_change_requests.to_date','<=',$to_date);
                                                }

                                               
        if (!empty($requestData['search']['value'])) {
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

        // $type_of_request=Config::get('constants.type_of_request');

        $objTypeOfRequest = new TypeOfRequest();
        $type_of_request = $objTypeOfRequest->getTypeOfRequest($companyId->id);
//print_r($type_of_request);exit;
        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());
        $resultArr = $query->skip($requestData['start'])
                            ->take($requestData['length'])
                            ->get();
        //print_r($resultArr);exit;
        $data = array();
        foreach ($resultArr as $row) {
            $actionHtml ='';
            $actionHtml .= '<a href="#historyDetailsModel" class="historyDetailsModel" data-toggle="modal" data-id="'.$row['id'].'"  title="Review" data-toggle="tooltip" data-original-title="Review" >Review</a>';
            $nestedData = array();
            $nestedData[] = $row["start_date"] ? $row["start_date"] : $row["from_date"];
            $nestedData[] = $row["end_date"] ? $row["end_date"] : $row["to_date"];
            $nestedData[] = $row["name"];
            $nestedData[] = $row["department_name"];
            $nestedData[] = (($row["type_of_req_id"] != '') ? $type_of_request[$row["type_of_req_id"]] : (($row["request_type"] != '')?$type_of_request[$row["request_type"]]:''));
            $desigArr = [];
            $nestedData[] = $actionHtml;
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        return $json_data;
    }
}
