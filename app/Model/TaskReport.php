<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\TaskReport;
use App\Model\Task;
use Config;

class TaskReport extends Model {

    protected $table = 'task_report';

    public function addTaskReport($postData, $id,$companyid)
    {
        // print_r($id);
        // print_r($postData);exit;
        // $empCount = Task::where('tasks.employee_id', '=', $id)
        //         ->count();
        // if ($empCount > 0) {
            // $taskCount = TaskReport::where('employee_id', '=', $id)
            //                 ->where('department_id', '=', $postData['dept_id'])
            //                 ->count();
            //                 // print_r($taskCount);exit;
            // if($taskCount == 0){
                $taskNumber = $this->getTaskNumber();
                $objPayroll = new TaskReport();
                $objPayroll->employee_id = $id;
                $objPayroll->company_id = $companyid;
                $objPayroll->department_id = $postData['dept_id'];
                $objPayroll->task_report_number = $taskNumber;
                $objPayroll->download_date = date('Y-m-d');
                $objPayroll->created_at = date('Y-m-d H:i:s');
                $objPayroll->updated_at = date('Y-m-d H:i:s');
                $objPayroll->save();    
                // $objPayroll = '';
                return $objPayroll->id;
            // }                
        // } 
    }
    
    public function getTaskNumber()
    {
        $taskCount = TaskReport::orderBy('id', 'desc')->first();
        $num = 1;
        if(isset($taskCount) && !empty($taskCount) && $taskCount->count() > 0){
            $num = $taskCount->id;
            $num + 1;
        }        
        $tolalLength = 4;
        $forCount = $tolalLength - strlen($num);
        $generateString = '';
        for ($i=1; $i <= $forCount; $i++) { 
            $generateString .= 0;
        }
        return $generateString.$num;
    }
    
    public function getTaskReportPdfDetailById($id,$employee_id)
    {
        // echo $id;
        // exit;
        // $collageArr = [$postData['emparray']];
        $result = TaskReport::select('task_report.*','tasks.task','tasks.assign_date','tasks.deadline_date','tasks.priority','tasks.about_task','tasks.complete_progress','tasks.task_status', 'employee.id as emp_id', 'employee.name as empName', 'comapnies.company_name')
                            ->leftjoin('employee', 'employee.id', '=', 'task_report.employee_id')
                            ->leftjoin('department', 'department.id','=','task_report.department_id')
                            ->leftjoin('comapnies', 'comapnies.id', '=', 'task_report.company_id')
                            ->leftjoin('tasks', 'tasks.employee_id', '=', 'task_report.employee_id')
                            ->where('task_report.id', $id)
                            ->where('task_report.employee_id', $employee_id)
                            ->get()
                            ->toArray();
                            // print_r($result);exit;
        return $result;
    }

    public function getTaskReportPdfDetail($taskReportId, $id, $companyid)
    {
        // echo $taskReportId.",". $id.",". $companyid;exit;
        // $collageArr = [$postData['emparray']];
        $result = TaskReport::select('task_report.*','tasks.task','tasks.assign_date','tasks.deadline_date','tasks.priority','tasks.about_task','tasks.complete_progress','tasks.task_status', 'employee.id as emp_id', 'employee.name as empName', 'comapnies.company_name')
                            ->leftjoin('department', 'department.id', '=', 'task_report.department_id')
                            ->leftjoin('employee', 'employee.department', '=', 'department.id')
                            ->leftjoin('comapnies', 'comapnies.id', '=', 'employee.company_id')
                            ->leftjoin('tasks', 'tasks.employee_id', '=', 'employee.id')
                            ->where('tasks.employee_id', $id)
                            ->where('task_report.id', $taskReportId)
                            ->where('task_report.company_id', $companyid)
                            ->get()
                            ->toArray();
                            // print_r($result);
        return $result;
    }

    public function getTaskDeptAllEmpAll($companyid,$empid = '')
    {
        $query=Task::select(['tasks.*','employee.id as emp_id','employee.name as empName','comapnies.company_name as company_name'])->join('employee','tasks.employee_id','employee.id')->join('comapnies','tasks.company_id','comapnies.id');

            if ($empid == 'All') 
            {
                
            }
            else
            {
                $query->where('tasks.employee_id',$empid);
            }

            $result = $query->where('tasks.company_id',$companyid)->get()->toArray();
                            // print_r($result);    
        return $result;
    }

    public function getTicketSystemData()
    {
        $result = TicketReport::select('ticket_report.*')
                            ->leftjoin('employee', 'employee.id', '=', 'ticket_report.employee_id')
                            ->get()->toArray();
        return $result;
    }

    public function getTaskReportList(){
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'task_report.id',
            1 => 'task_report.task_report_number',
            2 => 'task_report.created_at',
        );

        $query = TaskReport::from('task_report');
        if (!empty($requestData['search']['value'])) {
            // if there is a search parameter, $requestData['search']['value'] contains search parameter
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
       // print_r($requestData);exit;
        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                           ->take($requestData['length'])
                           ->select('task_report.id', 'task_report.employee_id', 'task_report.department_id', 'task_report.task_report_number', 'task_report.created_at')->get();
       
        
        $data = array();
       
        foreach ($resultArr as $row) {
            // $action='<a href="'.'download-taskreport/task-report'.$row['id'].'" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" >'.$value["file_attachment"].'</a>';
            $action= '<a href="'.'download-taskreport/task-report'.$row['id'].'.pdf" class="link-black text-sm"  data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye"></i></a>';
            $action.= ' | <a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm taskReportDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
//            
            $nestedData = array();
            $nestedData[] = $row["id"];
            $nestedData[] = $row["task_report_number"];
            $nestedData[] = date('d-m-Y',strtotime($row["created_at"]));
            $nestedData[] = $action;
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
   
}
