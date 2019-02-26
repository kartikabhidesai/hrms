<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function addTask($request, $companyId)
    {
        $objTask = new Task();
       	$objTask->company_id = $companyId;
       	$objTask->department_id = $request->department;
       	$objTask->employee_id = $request->employee;
       	$objTask->assign_date = date('Y-m-d', strtotime($request->assign_date));
       	$objTask->deadline_date = date('Y-m-d', strtotime($request->deadline_date));
       	$objTask->task = $request->task;
       	$objTask->priority = $request->priority;
       	$objTask->about_task = $request->about_task;

       	if($request->file()){
       		$image = $request->file('file');
            $file = 'tasks' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/tasks/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image->move($destinationPath, $file);
            $objTask->file = '/uploads/tasks/'.$file;
        }

       	$objTask->created_at = date('Y-m-d H:i:s');
        $objTask->updated_at = date('Y-m-d H:i:s');
        $objTask->save();

        if ($objTask) {
            return TRUE;
        }else{
            return false;
        }
    }

    public function getTaskList($companyId)
    {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'tasks.id',
            1 => 'tasks.task',
            2 => 'tasks.employee_id',
            3 => 'tasks.priority',
            4 => 'tasks.about_task',
        );
        $query = Task::join('employee as emp','tasks.employee_id', '=', 'emp.id')
                      ->where('tasks.company_id',$companyId);

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

        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                           ->take($requestData['length'])
                           ->select('tasks.assign_date', 'tasks.deadline_date', 'tasks.task', 'tasks.priority', 'tasks.about_task', 'emp.name as emp_name')
                           ->get();
                           // print_r($resultArr);exit();
        $data = array();

        foreach ($resultArr as $key => $row) {
          // $actionHtml = $request->input('gender');
           $actionHtml = '<a href="#" class="link-black text-sm" data-toggle="tooltip" data-original-title="View" > <i class="fa fa-eye"></i></a>';
            $nestedData = array();
            // $nestedData[] = $key;
            $nestedData[] = $row["task"];
            $nestedData[] = $row["emp_name"];
            $nestedData[] = $row["priority"];
            $nestedData[] = 'Pending';
            $nestedData[] = '100%';
            $nestedData[] = $row["about_task"];
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

    public function getEmpTaskList($empId)
    {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'tasks.id',
            1 => 'tasks.task',
            2 => 'tasks.employee_id',
            3 => 'tasks.priority',
            4 => 'tasks.about_task',
        );
        $query = Task::where('tasks.employee_id',$empId);

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

        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                           ->take($requestData['length'])
                           ->select('tasks.assign_date', 'tasks.deadline_date', 'tasks.task', 'tasks.priority', 'tasks.about_task')
                           ->get();
                           // print_r($resultArr);exit();
        $data = array();

        foreach ($resultArr as $key => $row) {
          // $actionHtml = $request->input('gender');
           $actionHtml = '<a href="#" class="link-black text-sm" data-toggle="tooltip" data-original-title="View" > <i class="fa fa-eye"></i></a>';
            $nestedData = array();
            // $nestedData[] = $key++;
            $nestedData[] = $row["task"];
            $nestedData[] = date('m/d/Y',strtotime($row["assign_date"]));
            $nestedData[] = date('m/d/Y',strtotime($row["deadline_date"]));
            $nestedData[] = $row["priority"];
            $nestedData[] = $row["about_task"];
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
