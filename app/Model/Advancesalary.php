<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Users;
use App\Model\Attendance;
use App\Model\Advancesalary;
use App\Model\TypeOfRequest;
use PDF;
use Config;
use File;

class Advancesalary extends Model
{
    protected $fillable = ['name', 'employee_id', 'company_id', 'department_id', 'date_of_submit', 'comments','file_name', 'created_at', 'updated_at'];

    protected $table = 'advance_salary_request';
    
    public function addSalaryRequest($request)
    {
        $objSalary = new Advancesalary();
        $objSalary->name = $request->input('emp_name');
        $objSalary->employee_id = $request->input('emp_id');
        $objSalary->company_id = $request->input('cmp_id');
//        $objSalary->department_id = $request->input('dep_id');
        $objSalary->date_of_submit = date("Y-m-d", strtotime($request->input('date_of_submit')));
        $objSalary->comments = $request->input('comments');
        $objSalary->created_at = date('Y-m-d H:i:s');
        $objSalary->updated_at = date('Y-m-d H:i:s');

        if($request->file('files')) {
          $image = $request->file('files');
          $name = time().'.'.$image->getClientOriginalExtension();
          $destinationPath = public_path('/uploads/employee/advance_salary_request/');
          $image->move($destinationPath, $name);
          $objSalary->file_name = $name;
        }
        
        return ($objSalary->save());
    }
    
    public function getAdvanceSalaryList($employeeid){
        
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'advance_salary.name',
            1 => 'advance_salary.department_name',            
            2 => 'advance_salary.date_of_submit',
            3 => 'advance_salary.comments',
            4 => 'advance_salary.status',
            
        );
         $query = ManageTimeChangeRequest::from('advance_salary_request as advance_salary')
                 ->join('employee as emp','advance_salary.employee_id','=','emp.id')
                 ->join('department as depart', 'emp.department', '=', 'depart.id')
                 ->where('advance_salary.employee_id',$employeeid);
         
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
                    ->select('depart.department_name','advance_salary.status','advance_salary.id', 'advance_salary.name','advance_salary.employee_id', 'advance_salary.company_id', 'advance_salary.date_of_submit','advance_salary.comments')->get();
        $data = array();
       // $type_of_request=Config::get('constants.type_of_request');

        $objTypeOfRequest = new TypeOfRequest();
        $type_of_request = $objTypeOfRequest->getTypeOfRequestV2($employeeid);


        foreach ($resultArr as $row) {
            if($row["status"] == NULL){
                $statusHtml='<span class="label label-warning">Pending</span>';
            }else{
                if($row["status"] == 'approve'){
                    $statusHtml='<span class="label label-success">Approve</span>';
                }else{
                    $statusHtml='<span class="label label-danger">Rejected</span>';
                }
            }
            $actionHtml='<a href="'.route('edit-advance-salary-request', array('id' => $row['id'])).'" class="link-black text-sm requestDelete"><i class="fa fa-pencil-square-o" ></i></a>';
            $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm requestDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
//            $nestedData[] = $row["id"];
            $nestedData[] = $row["name"];
            $nestedData[] = $row["department_name"];
            $nestedData[] = date('Y-m-d',strtotime($row["date_of_submit"]));
            $nestedData[] = $row["comments"];
            $nestedData[] = $statusHtml;
            $nestedData[] = $actionHtml;
            $data[] = $nestedData;
        }
//        echo "<pre>";print_r($data);exit;
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        return $json_data;
    }
    
    public function getAdavanceDetails($id){
        $query = Advancesalary::where('id',$id)->get();
        return $query;
    }
    
    public function editSalaryRequest($request){
//        print_r($request->input());exit;
        if($request->file('files')){
            $image=$request->file('files');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/employee/advance_salary_request/');
            $image->move($destinationPath, $name);  
         }
         $objEditAdvaceSalary=Advancesalary::find($request->input('edit_id'));
         
         $objEditAdvaceSalary->date_of_submit=date('Y-m-d',strtotime($request->input('date_of_submit')));
         $objEditAdvaceSalary->comments=$request->input('comments');
         if($request->file('files')){
             $objEditAdvaceSalary->file_name=$name;
         }
         $objEditAdvaceSalary->updated_at = date('Y-m-d H:i:s');
         return($objEditAdvaceSalary->save());
    }
    
    public function getCompanyAdvanceSalaryList($companyId){
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'advance_salary.name',
            1 => 'advance_salary.department_name',            
            2 => 'advance_salary.date_of_submit',
            3 => 'advance_salary.comments',
            4 => 'advance_salary.status',
            
        );
         $query = ManageTimeChangeRequest::from('advance_salary_request as advance_salary')
                 ->join('employee as emp' ,'advance_salary.employee_id','=','emp.id')
                 ->join('department as depart', 'emp.department', '=', 'depart.id')
                 ->where('advance_salary.company_id',$companyId);
         
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
                    ->select('depart.department_name','advance_salary.status','advance_salary.id', 'advance_salary.file_name', 'advance_salary.name','advance_salary.employee_id', 'advance_salary.company_id', 'advance_salary.date_of_submit','advance_salary.comments')->get();
        $data = array();
       // $type_of_request=Config::get('constants.type_of_request');

         $objTypeOfRequest = new TypeOfRequest();
        $type_of_request = $objTypeOfRequest->getTypeOfRequest($companyId);


        foreach ($resultArr as $row) {
            if($row["status"] == NULL){
                $actionHtml = '<a href="#approveModel" data-toggle="modal" data-id="'.$row['id'].'" title="Approve" class="btn btn-default link-black text-sm approve" data-toggle="tooltip" data-original-title="Approve" ><i class="fa fa-check"></i></a><a href="#disapproveModel" data-toggle="modal" data-id="'.$row['id'].'"  title="Reject" class="btn btn-default link-black text-sm disapprove" data-toggle="tooltip" data-original-title="Approve" ><i class="fa fa-close"></i></a>';
            }else{
                if($row["status"] == 'approve'){
                    $actionHtml='<span class="label label-success">Approved</span>';
                }else{
                    $actionHtml='<span class="label label-danger">Rejected</span>';
                }
            }
            $filePath =  '/uploads/employee/advance_salary_request/'.$row['file_name'];

            $nestedData = array();
              $nestedData[] = '<input type="checkbox" class="chkChangeReq" name="chkChangeReq" value="'.$row['id'].'">';
            $nestedData[] = $row["name"];
            $nestedData[] = $row["department_name"];
            $nestedData[] = date('Y-m-d',strtotime($row["date_of_submit"]));
            $nestedData[] = $row["comments"];
            $nestedData[] = $actionHtml;
            $nestedData[] = "<a target='_blank' href='".$filePath."'>View File</a>";
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
    
    public function approveRequest($id){
       $objSavedata=Advancesalary::where('id',$id)->update(['status'=>'approve','updated_at'=>date('Y-m-d H:i:s')]);
       return ($objSavedata);
    }
    
    public function disapproveRequest($id){
        $objSavedata=Advancesalary::where('id',$id)->update(['status'=>'reject','updated_at'=>date('Y-m-d H:i:s')]);
        return ($objSavedata);
    }

    public function getCompanyApprovedAdvanceSalaryList($companyId){
      return true;
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'advance_salary.name',
            1 => 'advance_salary.department_name',            
            2 => 'advance_salary.date_of_submit',
            3 => 'advance_salary.updated_at',
            4 => 'advance_salary.comments',
            5 => 'advance_salary.action'
        );
         $query = ManageTimeChangeRequest::from('advance_salary_request as advance_salary')
                                         ->join('employee as emp' ,'advance_salary.employee_id','=','emp.id')
                                        ->join('department as depart', 'emp.department', '=', 'depart.id')
                                        ->where('advance_salary.company_id',$companyId)
                                         ->where('advance_salary.status', 'approve');
         
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
                            ->select('depart.department_name','advance_salary.status','advance_salary.id', 'advance_salary.name','advance_salary.employee_id', 'advance_salary.company_id', 'advance_salary.date_of_submit','advance_salary.comments', 'advance_salary.updated_at', 'advance_salary.status')->get();
        $data = array();
        // $type_of_request = Config::get('constants.type_of_request');

        $objTypeOfRequest = new TypeOfRequest();
        $type_of_request = $objTypeOfRequest->getTypeOfRequest($companyId);

        foreach ($resultArr as $row) {
            $nestedData = array();
            $nestedData[] = '<input type="checkbox" class="approved_chk_id" name="approved_chk_id" value="'.$row['id'].'">';
            $nestedData[] = $row["name"];
            $nestedData[] = $row["department_name"];
            $nestedData[] = date('Y-m-d', strtotime($row["date_of_submit"]));
            $nestedData[] = date('Y-m-d', strtotime($row["updated_at"]));
            $nestedData[] = $row["comments"];
            $nestedData[] = $row["status"] == 'approve' ? '<span class="label label-success">Approved</span>' : $row["status"];
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
    public function getCompanyApprovedAdvanceSalaryListV2($companyId){
       
    return  ManageTimeChangeRequest::from('advance_salary_request as advance_salary')
                ->join('employee as emp' ,'advance_salary.employee_id','=','emp.id')
                ->join('department as depart', 'emp.department', '=', 'depart.id')
                ->where('advance_salary.company_id',$companyId)
                ->where('advance_salary.status', 'approve')
                ->select('depart.department_name','advance_salary.status','advance_salary.id', 'advance_salary.name','advance_salary.employee_id', 'advance_salary.company_id', 'advance_salary.date_of_submit','advance_salary.comments', 'advance_salary.updated_at', 'advance_salary.status')->get();
    }
    
    public function getDetails($request)
    {
      $seleteItems = $request->input('selecteditem');
      $AdvanceSalaryRequest = [];
      
      for($i=0;$i<count($seleteItems); $i++){
          $query = ManageTimeChangeRequest::from('advance_salary_request as advance_salary')
                                           ->join('department as depart', 'advance_salary.department_id', '=', 'depart.id')
                                           ->join('comapnies', 'advance_salary.company_id', '=', 'comapnies.id')
                                           // ->leftjoin('pay_roll', 'advance_salary.employee_id', '=', 'pay_roll.employee_id')
                                           ->join('employee', 'advance_salary.employee_id', '=', 'employee.id')
                                           ->where('advance_salary.id',$seleteItems[$i])
                                           ->select('advance_salary.name','advance_salary.comments','advance_salary.date_of_submit','depart.department_name', 'comapnies.company_name', 'advance_salary.date_of_submit', 'employee.phone')
                                           ->get()
                                           ->toarray();
         array_push($AdvanceSalaryRequest,$query[0]);
      }
      return $AdvanceSalaryRequest;
    }

    public function changeAdvanceSalaryStatus($postData){
        $status = $postData['status']; 
        $employeeArr = $postData['arrEmp'];
        foreach ($employeeArr as $key => $value) {
          $objSavedata = Advancesalary::where('id',$value)->update(['status'=> $status,'updated_at'=>date('Y-m-d H:i:s')]);
          $objSavedata = '';
        }
        return true;
    } 
}
