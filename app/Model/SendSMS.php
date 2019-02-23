<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\UserHasPermission;
use App\Model\Employee;
use Config;
use Auth;
use DB;

class SendSMS extends Model
{
    protected $table = 'send_sms';

    protected $fillable = ['id', 'emp_id', 'company_id', 'message'];

    public function getSMSDatatable($request, $companyId) 
    {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'employee_name',
            2 => 'department_name',
            3 => 'message'
        );

        $query = SendSMS::from('send_sms');

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
                            ->join('employee', 'send_sms.emp_id', '=', 'employee.id')
                            ->join('department', 'employee.department', '=', 'department.id')
                            ->where('send_sms.company_id', $companyId)
                            ->select('send_sms.id as id', 'employee.name as employee_name', 'send_sms.message as message', 'department.department_name')
                            ->get();

        $data = array();

        foreach ($resultArr as $row) {
            $nestedData = array();
            $nestedData[] = $row["employee_name"];
            $nestedData[] = $row["department_name"];
            $nestedData[] = $row["message"];
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

       public function sendNewSMS($request, $companyId)
    {
        
        $emp = explode(',', $request->input('emparray'));
        foreach ($emp as $key => $value) {
            // if($request->dept_id) {
                $newSMS = new SendSMS();
                $newSMS->emp_id = $value;
                $newSMS->company_id = $companyId;
//                $newSMS->department_id =$request->dept_id;
                $newSMS->message = $request->message;
                $newSMS->created_at = date('Y-m-d H:i:s');
                $newSMS->updated_at = date('Y-m-d H:i:s');
                $newSMS->save();
                $newSMS = '';
           // }
           }
        return TRUE;
    }

    public function sendNewSMS11($request, $companyId)
    {
        // print_r($request->all());exit();
        if($request->dept_id) {
            $getEmployees = Employee::where('department', $request->dept_id)->get();
            foreach ($getEmployees as $key => $getEmployee) {
                $newSMS = new SendSMS();
                $newSMS->emp_id = $getEmployee->id;
                $newSMS->company_id = $companyId;
                $newSMS->department_id = $request->dept_id;
                $newSMS->message = $request->message;
                $newSMS->created_at = date('Y-m-d H:i:s');
                $newSMS->updated_at = date('Y-m-d H:i:s');
                $newSMS->save();
            }
        } else {
            $findEmployee = Employee::where('id', $request->emp_id)->first();
            $newSMS = new SendSMS();
            $newSMS->emp_id = $request->emp_id;
            $newSMS->company_id = $companyId;
            $newSMS->department_id = $findEmployee->id;
            $newSMS->message = $request->message;
            $newSMS->created_at = date('Y-m-d H:i:s');
            $newSMS->updated_at = date('Y-m-d H:i:s');
            $newSMS->save();
        }

        return TRUE;
    }
}
