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

    public function getDataTableForHistoy()
    {

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

        $query = AttendanceHistory::select('attendance_history.id', 'employee.name', 'leaves.start_date', 'leaves.end_date', 'leaves.type_of_req_id', 'department.department_name', 'time_change_requests.request_type', 'time_change_requests.from_date', 'time_change_requests.to_date')
                                                ->join('employee', 'attendance_history.employee_id', '=', 'employee.id')
                                                ->join('department', 'attendance_history.department_id', '=', 'department.id')
                                                ->leftjoin('time_change_requests', 'attendance_history.time_change_request_id', '=', 'time_change_requests.id')
                                                ->leftjoin('leaves', 'attendance_history.leave_id', '=', 'leaves.id')
                                                ->where('attendance_history.company_id', $companyId->id);
        
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

        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());
        $resultArr = $query->skip($requestData['start'])
                            ->take($requestData['length'])
                            ->get();
		
        $data = array();
        foreach ($resultArr as $row) {
            $actionHtml ='';
            $actionHtml .= '<a href="#historyDetailsModel" class="historyDetailsModel" data-toggle="modal" data-id="'.$row['id'].'"  title="Review" data-toggle="tooltip" data-original-title="Review" >Review</a>';
            $nestedData = array();
            $nestedData[] = $row["start_date"] ? $row["start_date"] : $row["from_date"];
            $nestedData[] = $row["end_date"] ? $row["end_date"] : $row["to_date"];
            $nestedData[] = $row["name"];
            $nestedData[] = $row["department_name"];
            $nestedData[] = $row["type_of_req_id"] ? $type_of_request[$row["type_of_req_id"]] : $type_of_request[$row["request_type"]];
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
