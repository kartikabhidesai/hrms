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

    public function addEmployee($request, $userId, $companyId) {
        $emp_pic = '';
        if ($request->file('emp_pic')) {
            $image = $request->file('emp_pic');
            $emp_pic = 'employee' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $emp_pic);
        }
        $resume = '';
        if ($request->file('resume')) {
            $image = $request->file('resume');
            $resume = 'resume' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $resume);
        }
        $offer_latter = '';
        if ($request->file('offer_latter')) {
            $image = $request->file('offer_latter');
            $offer_latter = 'offer_latter' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $offer_latter);
        }
        $join_letter = '';
        if ($request->file('join_letter')) {
            $image = $request->file('join_letter');
            $join_letter = 'join_letter' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $join_letter);
        }
        $contect_agre = '';
        if ($request->file('contect_agre')) {
            $image = $request->file('contect_agre');
            $contect_agre = 'contect_agreement' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $contect_agre);
        }
        $other = '';
        if ($request->file('other')) {
            $image = $request->file('other');
            $other = 'other' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $other);
        }

        /* Store Images to folder for newly fields */
        $driver_license = '';
        if ($request->file('driver_license')) {
            $image = $request->file('driver_license');
            $driver_license = 'driver_license' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $driver_license);
        }

        $national_id = '';
        if ($request->file('national_id')) {
            $image = $request->file('national_id');
            $national_id = 'national_id' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $national_id);
        }

        $iqama_id = '';
        if ($request->file('iqama_id')) {
            $image = $request->file('iqama_id');
            $iqama_id = 'iqama_id' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $iqama_id);
        }

        $passport = '';
        if ($request->file('passport')) {
            $image = $request->file('passport');
            $passport = 'passport' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $passport);
        }

        $objEmployee = new Employee();
        $objEmployee->name = $request->input('name');
        $objEmployee->user_id = $userId;
        $objEmployee->company_id = $companyId;
        $objEmployee->father_name = $request->input('father_name');
        $objEmployee->date_of_birth = date('Y-m-d', strtotime($request->input('date_of_birth')));
        $objEmployee->gender = $request->input('gender');
        $objEmployee->phone = $request->input('phone');
        $objEmployee->local_address = $request->input('local_address');
        $objEmployee->permanent_address = $request->input('permanent_address');
        $objEmployee->nationality = $request->input('nationality');
        $objEmployee->martial_status = $request->input('martial_status');
        $objEmployee->photo = $emp_pic;
        $objEmployee->email = $request->input('email');
        $objEmployee->password = Hash::make($request->input('newpassword'));
        $objEmployee->employee_id = $request->input('employee_id');

        $objEmployee->department = $request->input('department');
        $objEmployee->designation = $request->input('designation');
        $objEmployee->date_of_joining = date('Y-m-d', strtotime($request->input('doj')));
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

        /* Save newly added fields to DB */
        $objEmployee->religion = $request->input('religion');
        $objEmployee->driver_license = $driver_license;
        $objEmployee->iqama_id = $iqama_id;
        $objEmployee->iqama_expire_date = date('Y-m-d', strtotime($request->input('iqama_expire_date')));
        $objEmployee->passport = $passport;
        $objEmployee->passport_expire_date = date('Y-m-d', strtotime($request->input('passport_expire_date')));
        $objEmployee->job_title = $request->input('job_title');
        $objEmployee->employee_type = $request->input('employee_type');
        $objEmployee->national_id = $national_id;

        $objEmployee->created_at = date('Y-m-d H:i:s');
        $objEmployee->updated_at = date('Y-m-d H:i:s');
        $objEmployee->save();
        return $objEmployee->id;
    }

    public function editEmployee($request, $id) {
        $emp_pic = '';
        if ($request->file('emp_pic')) {
            $image = $request->file('emp_pic');
            $emp_pic = 'employee' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $emp_pic);
        }
        $resume = '';
        if ($request->file('resume')) {
            $image = $request->file('resume');
            $resume = 'resume' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $resume);
        }
        $offer_latter = '';
        if ($request->file('offer_latter')) {
            $image = $request->file('offer_latter');
            $offer_latter = 'offer_latter' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $offer_latter);
        }
        $join_letter = '';
        if ($request->file('join_letter')) {
            $image = $request->file('join_letter');
            $join_letter = 'join_letter' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $join_letter);
        }
        $contect_agre = '';
        if ($request->file('contect_agre')) {
            $image = $request->file('contect_agre');
            $contect_agre = 'contect_agreement' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $contect_agre);
        }
        $other = '';
        if ($request->file('other')) {
            $image = $request->file('other');
            $other = 'other' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $other);
        }

        /* Edit Images to folder for newly fields */
        $driver_license = '';
        if ($request->file('driver_license')) {
            $image = $request->file('driver_license');
            $driver_license = 'driver_license' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $driver_license);
        }

        $national_id = '';
        if ($request->file('national_id')) {
            $image = $request->file('national_id');
            $national_id = 'national_id' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $national_id);
        }

        $iqama_id = '';
        if ($request->file('iqama_id')) {
            $image = $request->file('iqama_id');
            $iqama_id = 'iqama_id' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $iqama_id);
        }

        $passport = '';
        if ($request->file('passport')) {
            $image = $request->file('passport');
            $passport = 'passport' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $passport);
        }

        $objEmployee = Employee::find($id);
        $objEmployee->name = $request->input('name');
        $objEmployee->father_name = $request->input('father_name');
        $objEmployee->date_of_birth = date('Y-m-d', strtotime($request->input('date_of_birth')));
        $objEmployee->gender = $request->input('gender');
        $objEmployee->phone = $request->input('phone');
        $objEmployee->local_address = $request->input('local_address');
        $objEmployee->permanent_address = $request->input('permanent_address');
        $objEmployee->nationality = $request->input('nationality');
        $objEmployee->martial_status = $request->input('martial_status');
        $objEmployee->photo = $emp_pic;
        $objEmployee->email = $request->input('email');
        $objEmployee->password = empty($request->input('newpassword')) ? $request->input('oldpassword') : Hash::make($request->input('newpassword'));
        ;
        $objEmployee->employee_id = $request->input('employee_id');
        $objEmployee->department = $request->input('department');
        $objEmployee->designation = $request->input('designation');
        $objEmployee->date_of_joining = date('Y-m-d', strtotime($request->input('doj')));
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

        /* Edit newly added fields to DB */
        $objEmployee->religion = $request->input('religion');
        $objEmployee->driver_license = $driver_license;
        $objEmployee->iqama_id = $iqama_id;
        $objEmployee->iqama_expire_date = date('Y-m-d', strtotime($request->input('iqama_expire_date')));
        $objEmployee->passport = $passport;
        $objEmployee->passport_expire_date = date('Y-m-d', strtotime($request->input('passport_expire_date')));
        $objEmployee->job_title = $request->input('job_title');
        $objEmployee->employee_type = $request->input('employee_type');
        $objEmployee->national_id = $national_id;

        $objEmployee->created_at = date('Y-m-d H:i:s');
        $objEmployee->updated_at = date('Y-m-d H:i:s');
        $objEmployee->save();
        return TRUE;
    }

    public function updateEmpId($empId, $userId) {
        $objEmployee = Employee::find($empId);
        $objEmployee->user_id = $userId;
        $objEmployee->save();
        return TRUE;
    }

    public function getEmployeeDatatable($request, $companyId) {
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
                        ->where('company_id', $companyId)
                        ->select('ra.id', 'ra.name', 'ra.father_name', 'ra.photo', 'ra.phone', 'ra.email', 'ra.employee_id', 'ra.date_of_joining', 'ra.created_at', 'ra.gender')->get();
        $data = array();

        foreach ($resultArr as $row) {
            $actionHtml = $request->input('gender');
            $actionHtml .= '<a href="' . route('employee-edit', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="' . $row['id'] . '" class="link-black text-sm empDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["email"];
            $nestedData[] = $row["name"];
            $nestedData[] = $row["father_name"];
            $nestedData[] = $row["gender"];
            $nestedData[] = date('d-m-Y', strtotime($row["date_of_joining"]));
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

    public function getAllEmployee($id = NULL) {

        if ($id) {

            $result = Employee::select('employee.*')
                    ->where('employee.id', '=', $id)
                    ->get()
                    ->first()
                    ->toArray();
        } else {

            $result = Employee::select('employee.*', 'department.department_name')
                    ->join('department', 'employee.department', '=', 'department.id')
                    ->get();
        }
        return $result;
    }

    public function getEmploydetails($userId) {
        $result = Employee::select('department.department_name', 'department.id as dep_id', 'employee.name', 'employee.company_id', 'employee.id as emp_id')
                        ->join('department', 'employee.department', '=', 'department.id')
                        ->where('employee.user_id', $userId)->get();

        return $result;
    }

    public function getEmployDetailV2($userId, $year, $month, $employee, $department) {
        
       
//        Employee::select('employee.*,pay_roll.*')
//                ->leftjoin('pay_roll', 'employee.id', '=', 'pay_roll.employee_id')
//                ->whereIn('pay_roll.month',$month)
//                ->get();
        
        $sql = Employee::select('employee.name', 'employee.employee_id', 'employee.company_id', 'employee.id as emp_id', 'pay_roll.remarks', 'pay_roll.month', 'pay_roll.year')
                ->leftjoin('pay_roll', 'employee.id', '=', 'pay_roll.employee_id');
         
            $sql->where('pay_roll.month', $month);
            $sql->where('pay_roll.year', $year);
         
//        if (!empty($year) && empty($month)) {
//            $sql->orWhere(function($sql) use($year) {
//                $sql->orWhere(function($sql) use($year) {
//                    $sql->whereBetween('employee.date_of_joining', [date($year . '-01-01'), date($year . '-12-31')]);
//                });
//                $sql->orWhere(function($sql) use($year) {
//                    $sql->whereBetween('employee.date_of_joining', [date($year . '-01-01'), date($year . '-12-31')]);
//                });
//            });
//        }
        // if (!empty($year) && !empty($month)) {
        // $sql->orWhere(function($sql) use($year, $month) {
        //     $sql->orWhere(function($sql) use($year, $month) {
        //         $sql->whereBetween('date_of_joining', [date($year . '-' . $month . '-01'), date($year . '-' . $month . '-31')]);
        //                     });
        //     $sql->orWhere(function($sql) use($year, $month) {
        //         $sql->whereBetween('date_of_joining', [date($year . '-' . $month . '-01'), date($year . '-' . $month . '-31')]);
        //     });
        // });
        // }
        if (!empty($employee) && $employee !== 'all') {
            $sql->where('employee.id', $employee);
        }
        if (!empty($department)) {
            $sql->where('employee.department', $department);
        }

        $sql->where('employee.company_id', $userId);
        $result = $sql->get();
        return $result;
    }

    public function getUserid($id) {
        $result = Employee::select('id')->where('user_id', $id)->get();
        if (count($result) > 0) {
            return $result[0]['id'];
        } else {
            return false;
        }
    }

    public function getEmployee($company_id) {
        // echo $company_id;exit;
        $arrEmployee = Employee::where('company_id', $company_id)
                ->pluck('name', 'id')
                ->toArray();
        return $arrEmployee;
    }

    //chetan creaated
    public function getAllEmployeeofCompany($loggedIncmpid) {
        $arrEmployee = Employee::select('employee.*', 'department.department_name')
                ->where('employee.company_id', $loggedIncmpid)
                ->join('department', 'employee.department', '=', 'department.id')
                ->get();

        return $arrEmployee;
    }

}
