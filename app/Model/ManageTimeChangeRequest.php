<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ManageTimeChangeRequest;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Users;
use App\Model\Employee;
class ManageTimeChangeRequest extends Model
{
    protected $table = 'time_change_requests';
    
    public function addnewTimeManage($request,$userDetails){
//        print_r($request->input());exit;
        $objSavedata=new ManageTimeChangeRequest();
        $objSavedata->name = $request->input('name');
        $objSavedata->employee_id = $request->input('empid');
        $objSavedata->company_id = $request->input('company_id');
        $objSavedata->department_id = $request->input('depart_id');
        $objSavedata->from_date = date("Y-m-d", strtotime($request->input('from_date')));
        $objSavedata->to_date = date("Y-m-d", strtotime($request->input('to_date')));
        $objSavedata->date_of_submit = date("Y-m-d", strtotime($request->input('date_of_submit')));
        $objSavedata->request_type = $request->input('typeRequest');
        $objSavedata->total_hours = $request->input('total_hrs');
        $objSavedata->request_description = $request->input('reuest_note');
        $objSavedata->created_at = date('Y-m-d H:i:s');
        $objSavedata->updated_at = date('Y-m-d H:i:s');
        return $objSavedata->save();
    }
    
    public function getManageTimeChangeList($employeeid){
        
         $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'time_change.id',
            1 => 'time_change.name',            
            2 => 'time_change.department_id',
            3 => 'time_change.date_of_submit',
            4 => 'time_change.from_date',
            5 => 'time_change.to_date',
            6 => 'time_change.request_type',
            7 => 'time_change.total_hours',
            8 => 'time_change.request_description',
            9=> 'time_change.status'
        );
         $query = ManageTimeChangeRequest::from('time_change_requests as time_change')
                 ->join('department as depart', 'time_change.department_id', '=', 'depart.id')
                 ->where('time_change.employee_id',$employeeid);
         
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
                    ->select('depart.department_name','time_change.id', 'time_change.name','time_change.employee_id', 'time_change.company_id','time_change.department_id', 'time_change.from_date','time_change.to_date', 'time_change.date_of_submit','time_change.request_type', 'time_change.total_hours','time_change.request_description', 'time_change.status')->get();
        $data = array();
       
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
            $actionHtml = '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm requestDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
//            $nestedData[] = $row["id"];
            $nestedData[] = $row["name"];
            $nestedData[] = $row["department_name"];
            $nestedData[] = $row["date_of_submit"];
            $nestedData[] = $row["from_date"];
            $nestedData[] = $row["to_date"];
            $nestedData[] = $row["request_type"];
            $nestedData[] = $row["total_hours"];
            $nestedData[] = $row["request_description"];
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
    
    public function companygetManageTimeChangeList($companyId){
        
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'time_change.id',
            1 => 'time_change.name',            
            2 => 'time_change.department_id',
            3 => 'time_change.date_of_submit',
            4 => 'time_change.from_date',
            5 => 'time_change.to_date',
            6 => 'time_change.request_type',
            7 => 'time_change.total_hours',
            8 => 'time_change.request_description',
            9=> 'time_change.status'
        ); 
        
        $query = ManageTimeChangeRequest::from('time_change_requests as time_change')
                ->join('department as depart', 'time_change.department_id', '=', 'depart.id')
                ->where('time_change.company_id',$companyId);
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
                    ->select('depart.department_name','time_change.id', 'time_change.name','time_change.employee_id', 'time_change.company_id','time_change.department_id', 'time_change.from_date','time_change.to_date', 'time_change.date_of_submit','time_change.request_type', 'time_change.total_hours','time_change.request_description', 'time_change.status')->get();
        $data = array();
        
        foreach ($resultArr as $row) {
            if($row["status"] == NULL){
                $actionHtml = '<a href="#approveModel" data-toggle="modal" data-id="'.$row['id'].'" title="Approve" class="btn btn-default link-black text-sm approve" data-toggle="tooltip" data-original-title="Approve" ><i class="fa fa-check"></i></a><a href="#disapproveModel" data-toggle="modal" data-id="'.$row['id'].'"  title="Reject" class="btn btn-default link-black text-sm disapprove" data-toggle="tooltip" data-original-title="Approve" ><i class="fa fa-close"></i></a>';
//                $statusHtml='<span class="label label-warning">Pending</span>';
            }else{
                if($row["status"] == 'approve'){
                    $actionHtml='<span class="label label-success">Approve</span>';
                }else{
                    $actionHtml='<span class="label label-danger">Rejected</span>';
                }
            }
            
            
            $nestedData = array();
//            $nestedData[] = $row["id"];
            $nestedData[] = $row["name"];
            $nestedData[] = $row["department_name"];
            $nestedData[] = $row["date_of_submit"];
            $nestedData[] = $row["from_date"];
            $nestedData[] = $row["to_date"];
            $nestedData[] = $row["request_type"];
            $nestedData[] = $row["total_hours"];
            $nestedData[] = $row["request_description"];
//            $nestedData[] = $statusHtml;
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
    
    public function approveRequest($id){
       $objSavedata=ManageTimeChangeRequest::where('id',$id)->update(['status'=>'approve','updated_at'=>date('Y-m-d H:i:s')]);
       return ($objSavedata);
    }
    
    public function disapproveRequest($id){
        $objSavedata=ManageTimeChangeRequest::where('id',$id)->update(['status'=>'reject','updated_at'=>date('Y-m-d H:i:s')]);
        return ($objSavedata);
    }
  }
