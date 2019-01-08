<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Users;
use PDF;
use Config;

class Employee extends Model {
    protected $table = 'employee';
   
    public function addEmployee($request) {

      // print_r( $request->file());
      // print_r( $request->input());exit;
        $emp_pic = '';
        if($request->file()){
            $image = $request->file('emp_pic');
            $emp_pic = 'employee'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $emp_pic);    
        }
         $resume = '';
        if($request->file()){
            $image = $request->file('resume');
            $resume = 'resume'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $resume);    
        }
         $offer_latter = '';
        if($request->file()){
            $image = $request->file('offer_latter');
            $offer_latter = 'offer_latter'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $offer_latter);    
        }
        $join_letter = '';
        if($request->file()){
            $image = $request->file('join_letter');
            $join_letter = 'join_letter'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $join_letter);    
        }
        $contect_agre = '';
        if($request->file()){
            $image = $request->file('contect_agre');
            $contect_agre = 'contect_agreement'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $contect_agre);    
        }  
        $other = '';
        if($request->file()){
            $image = $request->file('other');
            $other = 'other'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $other);    
        }

        $objEmployee = new Employee();
        $objEmployee->name = $request->input('name');
        $objEmployee->father_name = $request->input('father_name');
        $objEmployee->date_of_birth = date('Y-m-d',strtotime($request->input('date_of_birth')));
        $objEmployee->gender = $request->input('gender');
        $objEmployee->phone = $request->input('phone');
        $objEmployee->local_address = $request->input('local_address');
        $objEmployee->permanent_address = $request->input('permanent_address');
        $objEmployee->nationality = $request->input('nationality');
        $objEmployee->martial_status = $request->input('martial_status');
        $objEmployee->photo = $emp_pic;
        $objEmployee->email = $request->input('email');
        $objEmployee->password = $request->input('newpassword');
        $objEmployee->emloyee_id = $request->input('employee_id');
            
        $objEmployee->department = $request->input('department');
        $objEmployee->designation = $request->input('designation');
        $objEmployee->date_of_joining = date('Y-m-d',strtotime($request->input('doj')));
        $objEmployee->joining_salary = $request->input('join_salary');
        $objEmployee->status = $request->input('status');

        $objEmployee->account_holder_name = $request->input('account_holder_name');
        $objEmployee->account_number = $request->input('account_number');
        $objEmployee->bank_name = $request->input('bank_name');
        $objEmployee->branch = $request->input('branch');

        $objEmployee->resume_file = $resume;
        $objEmployee->offer_letter = $offer_latter;
        $objEmployee->joining_letter = $join_letter;
        $objEmployee->contact_agreement = $contect_agre;
        $objEmployee->other = $other;

        $objEmployee->created_at = date('Y-m-d H:i:s');
        $objEmployee->updated_at = date('Y-m-d H:i:s');
        $objEmployee->save();
        return TRUE;
    }

 public function editDemo($request) {
      
       $name = $request->input('gender');
        if($request->file()){
            $image = $request->file('demo_pic');
            $name = 'admin'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $name);    
        }
        $objEmployee = Demo::find($request->input('edit_id'));
        $objEmployee->first_name = $request->input('first_name');
        $objEmployee->last_name = $request->input('last_name');
        $objEmployee->user_id = '1';
        $objEmployee->gender = $request->input('gender');
        $objEmployee->image = $name;
        $objEmployee->created_at = date('Y-m-d H:i:s');
        $objEmployee->updated_at = date('Y-m-d H:i:s');
        $objEmployee->save();
        return TRUE;
    }

     public function getEmployeeDatatable($request) {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'ra.id',
            1 => 'ra.name',
            2 => 'ra.father_name',
            3 => 'ra.gender',
        );
        $query = Employee::from('employee as ra');

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
           ->select('ra.id', 'ra.name','ra.father_name', 'ra.photo','ra.phone','ra.employee_id','ra.date_of_joining', 'ra.created_at','ra.gender')->get();
        $data = array();
   
        foreach ($resultArr as $row) {
           $actionHtml = $request->input('gender');
           $actionHtml .= '<a href="' . route('employee-edit', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm empDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["email"];
            $nestedData[] = $row["name"];
            $nestedData[] = $row["father_name"];
            $nestedData[] = $row["gender"];
            $nestedData[] = date('d-m-Y',strtotime($row["date_of_joining"]));
            $nestedData[] = $row["phone"];
            $nestedData[] = $row["employee_id"];
          
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
