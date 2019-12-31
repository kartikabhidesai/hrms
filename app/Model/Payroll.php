<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use Config;

class Payroll extends Model {

    protected $table = 'pay_roll';

    public function addnewpayroll($request, $id) {
        $result = Payroll::where('employee_id', '=', $id)
                ->where('month', '=', $request->input('months'))
                ->where('year', '=', $request->input('year'))
                ->count();

        $departmentId = Employee::select('department.id')
                ->join('department', 'employee.department', '=', 'department.id')
                ->where('employee.id', $id)
                ->first();

        if ($result == 0) {
            $objPayroll = new Payroll();
            $objPayroll->employee_id = $id;
            $objPayroll->salary_grade = $request->input('salary_grade');
            $objPayroll->basic_salary = $request->input('basic_salary');
            $objPayroll->over_time = $request->input('over_time');
            // $objPayroll->department = $departmentId->id;
            $objPayroll->due_date = $request->input('due_date');
            $objPayroll->housing = $request->input('housing');
            $objPayroll->medical = $request->input('medical');
            $objPayroll->transportation = $request->input('transportation');
            $objPayroll->travel = $request->input('travel');
            $objPayroll->award = $request->input('award');
            $objPayroll->month = $request->input('months');
            $objPayroll->year = $request->input('year');
            $objPayroll->remarks = $request->input('remarks');
            $objPayroll->extra_allowance = json_encode($request->extraallowance);
            $objPayroll->extra_deduction = json_encode($request->extradeduction);
            $objPayroll->created_at = date('Y-m-d H:i:s');
            $objPayroll->updated_at = date('Y-m-d H:i:s');
            $objPayroll->save();
            return 'Added';
        } else {
            return 'Exists';
        }
    }

    public function editPayroll($request, $id) {

        $result = Payroll::where('employee_id', '=', $request->input('empId'))
                ->where('id', '!=', $request->input('editId'))
                ->where('month', '=', $request->input('months'))
                ->where('year', '=', $request->input('year'))
                ->count();

        $departmentId = Employee::select('department.id')
                ->join('department', 'employee.department', '=', 'department.id')
                ->where('employee.id', $id)
                ->first();

        if ($result == 0) {
            $objPayroll = Payroll::find($request->input('editId'));
            $objPayroll->salary_grade = $request->input('salary_grade');
            $objPayroll->basic_salary = $request->input('basic_salary');
            $objPayroll->over_time = $request->input('over_time');
            // $objPayroll->department = $departmentId->id;
            $objPayroll->due_date = $request->input('due_date');
            $objPayroll->housing = $request->input('housing');
            $objPayroll->medical = $request->input('medical');
            $objPayroll->transportation = $request->input('transportation');
            $objPayroll->travel = $request->input('travel');
            $objPayroll->award = $request->input('award');
            $objPayroll->month = $request->input('months');
            $objPayroll->year = $request->input('year');
            $objPayroll->remarks = $request->input('remarks');
            if ($request->extraallowance) {
                $objPayroll->extra_allowance = json_encode($request->extraallowance);
            }
            if ($request->extradeduction) {
                $objPayroll->extra_deduction = json_encode($request->extradeduction);
            }
            $objPayroll->created_at = date('Y-m-d H:i:s');
            $objPayroll->updated_at = date('Y-m-d H:i:s');
            $objPayroll->save();
            return TRUE;
        } else {
            return 'Exists';
        }
    }

    public function getPayroll($id) {
        return Payroll::select('pay_roll.*')
                        ->where('employee_id', '=', $id)
                        ->orderBy('id', 'DESC')
                        ->get()
                        ->toArray();
    }

    public function getPayrollV2($id) {
//        print_r($id);die();
        return Payroll::select('pay_roll.*')->where('id', '=', $id)->get()->toArray();
    }

    public function getPayslipPdfDetail($postData, $id) {
        $result = Payroll::select('pay_roll.*', 'employee.id as emp_id', 'employee.name as empName', 'comapnies.company_name')
                ->leftjoin('employee', 'employee.id', '=', 'pay_roll.employee_id')
                ->leftjoin('department', 'employee.department', '=', 'department.id')
                ->leftjoin('comapnies', 'comapnies.id', '=', 'employee.company_id')
                ->where('pay_roll.month', $postData['months'])
                ->where('pay_roll.year', $postData['year'])
                ->where('pay_roll.employee_id', $id)
                ->get()
                ->toArray();

        return $result;
    }

    public function getPayslipPdfDetailPDF($postData, $id) {

        $result = Payroll::select('pay_roll.*', 'employee.id as emp_id', 'employee.name as empName', 'comapnies.company_name')
                ->leftjoin('employee', 'employee.id', '=', 'pay_roll.employee_id')
                ->leftjoin('department', 'employee.department', '=', 'department.id')
                ->leftjoin('comapnies', 'comapnies.id', '=', 'employee.company_id')
                ->where('pay_roll.id', $id)
//                            ->where('pay_roll.employee_id', $id)
                ->get()
                ->toArray();

        return $result;
    }

    public function getPayslipmodalDetail($Data) {

        $result = Payroll::select('pay_roll.*', 'employee.id as emp_id', 'employee.name as empName', 'comapnies.company_name')
                ->leftjoin('employee', 'employee.id', '=', 'pay_roll.employee_id')
                ->leftjoin('department', 'employee.department', '=', 'department.id')
                ->leftjoin('comapnies', 'comapnies.id', '=', 'employee.company_id')
//                            ->where('pay_roll.month', $Data['month'])
//                            ->where('pay_roll.year', $Data['year'])
                ->where('pay_roll.employee_id', $Data['employeeid'])
                ->where('pay_roll.id', $Data['payrollId'])
                ->get()
                ->toArray();


        return json_encode($result);
    }

    public function getTransactionDetails($postData) {
        // print_r($postData);exit;
        $sql = Payroll::select('pay_roll.*', 'employee.id as emp_id', 'employee.name as empName', 'comapnies.company_name')
                ->leftjoin('employee', 'employee.id', '=', 'pay_roll.employee_id')
                ->leftjoin('department', 'employee.department', '=', 'department.id')
                ->leftjoin('comapnies', 'comapnies.id', '=', 'employee.company_id');
        $startDate = '';
        $endDate = '';
        $currentDate = date('Y-m-d');
        if ($postData['transaction'] == 'specific_date') {
            $startDate = date('Y-m-d', strtotime($postData['from_date']));
            $endDate = date('Y-m-d', strtotime($postData['to_date']));
        } else if ($postData['transaction'] == '3_months') {
            $startDate = date('Y-m-d', strtotime("-3 months", strtotime($currentDate)));
            $endDate = date('Y-m-d');
        } else if ($postData['transaction'] == '6_months') {
            $startDate = date('Y-m-d', strtotime("-6 months", strtotime($currentDate)));
            $endDate = date('Y-m-d');
        } else if ($postData['transaction'] == 'last_year') {
            $startDate = date('Y-m-d', strtotime("-12 months", strtotime($currentDate)));
            $endDate = date('Y-m-d');
        }
        // echo $startDate;exit;
        if (!empty($startDate) && !empty($endDate)) {
            $sql->Where(function($sql) use($startDate, $endDate) {
                $sql->orWhere(function($sql) use($startDate, $endDate) {
                    $sql->whereBetween('pay_roll.created_at', [$startDate, $endDate]);
                });
            });
        }
        $result = $sql->get()->toArray();
        // echo '<pre/>';
        // print_r($result);exit;
        return $result;
    }

    public function getPayrollDatatable($request) {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'employee.name', 'employee.father_name',
            1 => 'department.department_name',
            2 => 'pay_roll.basic_salary',
            3 => 'pay_roll.salary_grade',
            4 => 'employee.date_of_joining',
            5 => 'employee.bank_name',
        );

        $query = Payroll::from('pay_roll')
                ->leftjoin('employee', 'employee.id', '=', 'pay_roll.employee_id')
                ->leftjoin('department', 'department.id', '=', 'employee.department');

        if ($request['data']['empid'] != 'all') {
            $query->where('employee.id', $request['data']['empid']);
        }
        if ($request['data']['deptid'] != 'all') {
            $query->where('employee.department', $request['data']['deptid']);
        }

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
                ->groupby('pay_roll.employee_id')
                ->select('department.department_name', 'pay_roll.basic_salary', 'pay_roll.salary_grade', 'pay_roll.id', 'employee.name', 'employee.father_name', 'employee.date_of_joining', 'employee.bank_name', 'employee.branch', 'pay_roll.employee_id')
                ->get();
        // $resultArr = $query->skip($requestData['start'])
        //                 ->take($requestData['length'])
        //                 ->select('ra.id', 'ra.location', 'ra.department_id', 'ra.budget', 'ra.requirement', 'ra.number', 'ra.type', 'ra.created_at',DB::raw('GROUP_CONCAT(training_emp_dept.id SEPARATOR ",") AS service_name_data'),DB::raw('GROUP_CONCAT(employee.name SEPARATOR " | ") AS employeeName'))->get();
        $data = array();

        foreach ($resultArr as $row) {
            // print_r($row);exit;
            $actionHtml = "";
            $actionHtml .= '<a href="' . route('payroll-emp-detail', $row['employee_id']) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-eye"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["name"] . " " . $row["father_name"];
            $nestedData[] = $row["department_name"];
            $nestedData[] = $row["basic_salary"];
            $nestedData[] = $row["salary_grade"];
            $nestedData[] = $row["date_of_joining"];
            $nestedData[] = $row["bank_name"];
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

    public function getPayrollEmpDatatable($id) {

        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'pay_roll.basic_salary',
            1 => 'pay_roll.month', 'pay_roll.year',
            2 => 'pay_roll.medical',
            3 => 'pay_roll.over_time',
            4 => 'pay_roll.transportation',
            5 => 'employee.status',
            6 => 'pay_roll.travel',
        );

        $query = Payroll::from('pay_roll')
                ->leftjoin('employee', 'employee.id', '=', 'pay_roll.employee_id')
                ->where('pay_roll.employee_id', $id);

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
                ->select('pay_roll.id', 'pay_roll.basic_salary', 'pay_roll.medical', 'pay_roll.over_time', 'pay_roll.transportation', 'pay_roll.travel', 'pay_roll.month', 'pay_roll.year', 'employee.status')
                ->get();
        // $resultArr = $query->skip($requestData['start'])
        //                 ->take($requestData['length'])
        //                 ->select('ra.id', 'ra.location', 'ra.department_id', 'ra.budget', 'ra.requirement', 'ra.number', 'ra.type', 'ra.created_at',DB::raw('GROUP_CONCAT(training_emp_dept.id SEPARATOR ",") AS service_name_data'),DB::raw('GROUP_CONCAT(employee.name SEPARATOR " | ") AS employeeName'))->get();
        $data = array();

        foreach ($resultArr as $row) {
            // print_r($row);exit;
            $actionHtml = "";
            $actionHtml .= '<a href="' . route('payroll-edit', $row['id']) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-edit"></i></a>
                                        <a href="#deleteModel" data-toggle="modal" data-id="' . $row["id"] . '" class="link-black text-sm empDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["basic_salary"];
            $nestedData[] = date('M', $row["month"]) . ' ' . $row["year"];
            $nestedData[] = $row["medical"];
            $nestedData[] = $row["over_time"];
            $nestedData[] = $row["transportation"];
            $nestedData[] = $row["status"];
            $nestedData[] = $row["travel"];
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
