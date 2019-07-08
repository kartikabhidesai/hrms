<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use Config;

class Performance extends Model {

    protected $table = 'performances';

    public function addEmployeeperformance($request,$compnyid) {
        $performanceCount = Performance::select('id')
        ->where('employee_id', $request->employee_id)
        ->where('month', $request->months)
        ->where('year', $request->year)
        ->get();
        // echo $performanceCount . ' Hii ';exit();
        if (count($performanceCount) == 0) {
            $objper = new Performance();
            // print_r($request->file()); 
            // print_r($request->input()); exit;
            //$request->rating="1";
            $objper->company_id = $compnyid;
            $objper->employee_id = $request->employee_id;
            $objper->availability = (isset($request->availableVal) ? $request->availableVal : '0');
            $objper->dependability = (isset($request->depandiablity) ? $request->depandiablity : '0') ;
            $objper->job_knowledge = (isset($request->jobKnow) ? $request->jobKnow : '0') ;
            $objper->quality = (isset($request->qualityVal) ? $request->qualityVal : '0') ;
            $objper->working_relationship = (isset($request->productivityVal) ? $request->productivityVal : '0') ;
            $objper->productivity = (isset($request->workingVal) ? $request->workingVal : '0') ;
            $objper->honesty = (isset($request->honestyVal) ? $request->honestyVal : '0') ;
            $objper->notes_and_details =  $request->notes_and_details;
            $objper->month =  $request->months;
            $objper->year =  $request->year;
            $file = '';
            if ($request->file()) {
                $image = $request->file('attachment');
                $file = 'performance' . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/performance/');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $image->move($destinationPath, $file);
            }
            $objper->file_attachment =  $file;
            $objper->save();

            if ($objper) {
                return TRUE;
            } else {
                return false;
            }
        }else{
            return 'Exist';
        }
    }


    public function getEmployeePerformanceList($id) {

            $result = Performance::select('performances.*')
                    ->where('performances.employee_id', '=', $id)
                    ->get()->toArray();
       // print_r($result);exit;
        return $result;
    }

   public function getPerformanceList($request, $companyId) {

        $requestData = $_REQUEST;
        $data = $request->input('data');
   
        if ($data['department'] != NULL) {
            $department = $data['department'];
        } else {
            $department = "";
        }

        /* Don't remove this code as it's in-progress */
         if($data['emparray'] != NULL  ) {
          $emparray = $data['emparray'];
          } else {
          $emparray = "";
          } 

        $columns = array(
            // datatable column index  => database column name
            0 => 'employee.id',
            1 => 'employee.employee_name',
            2 => 'employee.company_name',
            3 => 'employee.doj',
        );
        $query = Employee::select('employee.*', 'department.department_name')
        ->join('department', 'employee.department', '=', 'department.id');
        if(isset($department)  && $department > 0){
            $query->where('employee.department', $department);    
        }
        if(isset($employee) && $employee > 0){
            $query->where('employee.id', $employee);
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

        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                ->take($requestData['length'])
                ->select('employee.*','employee.name as employee_name','employee.date_of_joining as doj','department.department_name')
                ->get();
        // print_r($resultArr);exit();
        $data = array();

        foreach ($resultArr as $key => $row) {
            // $actionHtml = '<a href="#performancesDetailsModel" data-toggle="modal" data-id="'.$row['id'].'" title="Details" class="btn btn-default link-black text-sm performancesDetails" data-toggle="tooltip" data-original-title="Show"><i class="fa fa-eye"></i></a>';
            $actionHtml ='<a href="employee-performance-list/'.$row['id'].'" class="link-black text-sm" data-id="'.$row['id'].'" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-eye"></i></a>';
            $nestedData = array();
            $radioHtml = '<input type="checkbox" value="'.$row['id'].'" class="empId" id="empId" name="empchk[]">';
            $nestedData[] = $radioHtml;
            $nestedData[] = $row["employee_name"];
            $nestedData[] = $row["department_name"];
            $nestedData[] = $row["doj"];
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
    
    public function getPerformanceListCompany($request, $companyId) {

        $requestData = $_REQUEST;
        $data = $request->input('data');
   
        if ($data['department'] != NULL) {
            $department = $data['department'];
        } else {
            $department = "";
        }

        /* Don't remove this code as it's in-progress */
         if($data['emparray'] != NULL  ) {
          $emparray = $data['emparray'];
          } else {
          $emparray = "";
          } 

        $columns = array(
            // datatable column index  => database column name
            0 => 'employee.id',
            1 => 'employee.employee_name',
            2 => 'employee.company_name',
            3 => 'employee.doj',
        );
        $query = Employee::select('employee.*', 'department.department_name')
        ->join('department', 'employee.department', '=', 'department.id');
        if(isset($department)  && $department > 0){
            $query->where('employee.department', $department);    
        }
        if(isset($employee) && $employee > 0){
            $query->where('employee.id', $employee);
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

        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                ->take($requestData['length'])
                ->select('employee.*','employee.name as employee_name','employee.date_of_joining as doj','department.department_name')
                ->get();
        // print_r($resultArr);exit();
        $data = array();

        foreach ($resultArr as $key => $row) {
            // $actionHtml = '<a href="#performancesDetailsModel" data-toggle="modal" data-id="'.$row['id'].'" title="Details" class="btn btn-default link-black text-sm performancesDetails" data-toggle="tooltip" data-original-title="Show"><i class="fa fa-eye"></i></a>';
            $actionHtml ='<a href="employee-employee-performance-list/'.$row['id'].'" class="link-black text-sm" data-id="'.$row['id'].'" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-eye"></i></a>';
            $nestedData = array();
            $radioHtml = '<input type="checkbox" value="'.$row['id'].'" class="empId" id="empId" name="empchk[]">';
            $nestedData[] = $radioHtml;
            $nestedData[] = $row["employee_name"];
            $nestedData[] = $row["department_name"];
            $nestedData[] = $row["doj"];
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
    
    public function getEmployeePerformanceDetailsList($r,$id) {
        $result = Performance::select('performances.*', 'comapnies.company_name','employee.name')
                ->join('comapnies', 'performances.company_id', '=', 'comapnies.id')
                ->join('employee', 'performances.employee_id', '=', 'employee.id')
                ->where('performances.company_id', '=', $id)
                ->where('performances.employee_id', $r)
                ->get()->toArray();
       
    
       
        return $result;
    }
    
    public function lastPerformance($id){
        $result = Performance::select('performances.*')
                ->where('performances.employee_id', '=', $id)
                ->orderBy('created_at', 'desc')
                ->first()->toarray();
//        return $result;
        if(count($result) > 0){
          $emp_total = (int)$result['availability'] + 
                     (int)$result['dependability'] + 
                     (int)$result['job_knowledge'] + 
                     (int)$result['quality'] + 
                     (int)$result['productivity'] + 
                     (int)$result['working_relationship'] + 
                     (int)$result['honesty'] ;
            $perstange = ($emp_total*100)/35 ;
            return $perstange;  
        }else{
            return "0";  
        }
        
    }
}
