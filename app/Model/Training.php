<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\TraningEmployeeDepartment;
use DB;
class Training extends Model
{
    protected $table = 'training';

    public function addTraining($request, $companyId)
    {
       
        $newTraining = new Training();
    	$newTraining->company_id = $companyId;
    	$newTraining->location = $request->location;
    	$newTraining->department_id = $request->department_id;
        $newTraining->budget = $request->budget;
        $newTraining->requirement = $request->requinment;
    	$newTraining->number = $request->numbers;
    	$newTraining->type = $request->Types;
    	$newTraining->save();

    	if($newTraining) {
            $lastId = $newTraining->id;
            $objNew = new TraningEmployeeDepartment();
            $objNew->addTraningDetails($request,$lastId);
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }

    public function getCompanyTraining($companyId)
    {
        
        $getListOfTraining = Training::select('location','department_id','budget','requirement','number','type')
                                        ->where('company_id', $companyId)
                                        ->get();

        if(count($getListOfTraining) > 0) {

            foreach ($getListOfTraining as $key => $value) {
                $dd=date('Y, m, d',strtotime($value['start']));
                $getListOfTrainingList[]=array('title'=>$value['title'],'start'=>$dd);
            }
                
            return $getListOfTrainingList;
        } else {
            return null;
        }
    }

    public function getTrainingDatatable($request, $companyId) {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'ra.id',
            1 => 'ra.location',
            2 => 'ra.budget',
            3 => 'ra.requirement',
        );
        $query = Training::from('training as ra')
                ->leftjoin('training_emp_dept', 'training_emp_dept.training_id', '=', 'ra.id')
                // ->leftjoin('employee', 'employee.id', '=', 'training_emp_dept.employee_id')
                ->where('ra.company_id', $companyId)
                // ->groupBy('ra.id')
                ;

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
                        ->select('ra.id', 'ra.location', 'ra.department_id', 'ra.budget', 'ra.requirement', 'ra.number', 'ra.type', 'ra.created_at')->get(); 
        // $resultArr = $query->skip($requestData['start'])
        //                 ->take($requestData['length'])
        //                 ->select('ra.id', 'ra.location', 'ra.department_id', 'ra.budget', 'ra.requirement', 'ra.number', 'ra.type', 'ra.created_at',DB::raw('GROUP_CONCAT(training_emp_dept.id SEPARATOR ",") AS service_name_data'),DB::raw('GROUP_CONCAT(employee.name SEPARATOR " | ") AS employeeName'))->get();
        $data = array();

        foreach ($resultArr as $row) {
            // print_r($row);exit;
            // $actionHtml = $request->input('location');
            // $actionHtml .= '<a href="' . route('training-edit', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            $actionHtml = '<a href="#deleteModel" data-toggle="modal" data-id="' . $row['id'] . '" class="link-black text-sm deleteTraning" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["location"];
            $nestedData[] = $row["budget"];
            $nestedData[] = $row["requirement"];         
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
    public function getTrainingEmployeeDatatable($request, $employeeId) {
        print_r($employeeId);
        die();
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'ra.id',
            1 => 'ra.location',
            2 => 'ra.budget',
            3 => 'ra.requirement',
            4 => 'employee.name',
        );
        $query = Training::from('training as ra')
                ->join('training_emp_dept', 'training_emp_dept.training_id', '=', 'ra.id')
                ->join('employee', 'employee.id', '=', 'ra.company_id')
                ->where('training_emp_dept.employee_id', $employeeId);

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
                        ->select('ra.id', 'ra.location', 'ra.department_id', 'ra.budget', 'ra.requirement', 'ra.number', 'ra.type', 'ra.created_at')->get();
        $data = array();
        foreach ($resultArr as $row) {
            // $actionHtml = $request->input('location');
            // $actionHtml .= '<a href="' . route('training-edit', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            $actionHtml = '<a href="#trainingDetailsModel" data-toggle="modal" data-id="' . $row['id'] . '" class="link-black text-sm viewTraning" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-eye"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["location"];
            $nestedData[] = $row["budget"];
            $nestedData[] = $row["requirement"];         
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

    public function getTrainingDetails($postData){
        
        $query = Training::from('training as ra')
                ->join('training_emp_dept', 'training_emp_dept.training_id', '=', 'ra.id')
                ->join('employee', 'employee.id', '=', 'ra.company_id')
                ->join('department as depart', 'ra.department_id', '=', 'depart.id')
                ->where('ra.id', $postData['id']);
        $result = $query->select('ra.id', 'ra.location', 'depart.department_name','ra.department_id', 'ra.budget', 'ra.requirement', 'ra.number', 'ra.type', 'ra.created_at')->get()->toArray();  
        return  $result;     
    }
}
