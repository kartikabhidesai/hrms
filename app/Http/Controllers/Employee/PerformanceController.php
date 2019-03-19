<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Department;
use App\Model\Performance;
use Config;
use PDF;

class PerformanceController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('employee');
    }


    public function index(Request $request) {

        $userID = $this->loginUser->id;
        $id = Employee::select('id')->where('user_id', $userID)->first();

        $performanceObj = new Performance;
        $data['employeePerfirmance'] = $performanceObj->getEmployeePerformanceList($id['id']);

        $EmpObj = new Employee;
        $data['singleemployee'] = $EmpObj->getAllEmployeeForPerformance($id['id']);

        $data['header'] = array(
            'title' => 'Performance for ' . $data['singleemployee']['name'],
            'breadcrumb' => array(
                'Home' => route("admin-dashboard")));

        $data['empId'] = $id['id'];
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/performance.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Performance.init()');
        $data['css'] = array();
        $data['monthis'] = Config::get('constants.months');
        return view('employee.performance.performance-employee-list', $data);
    }

    public function addPerformance(Request $request) {
        if ($request->isMethod('post')) {
           
            $objperformnce = new Performance();
            $userid = $this->loginUser->id;
            $companyId = Company::select('id')->where('user_id', $userid)->first();
            $ret = $objperformnce->addEmployeeperformance($request,$companyId->id);
            if ($ret=='Exist' && $ret != 1) {
                $return['status'] = 'error';
                $return['message'] = 'Performance Already Exist.';
            }elseif ($ret == 1) {
                $return['status'] = 'success';
                $return['message'] = 'Performance Added successfully.';
                $return['redirect'] = route('employee-performance-list',array('id' => $request->input('employee_id')));
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Somethin went wrong while adding new performance!';
            }
             echo json_encode($return);
            exit;
        }
    }

    public function PerformanceDownloadPDF(Request $request)
    {   
        $postData = $request->input();
        $empArray = $postData['empchk'];

        $userid = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userid)->first();
       
        $performanceObj = new Performance;
        $data['empPdfArray'] = $performanceObj->getEmployeePerformanceDetailsList($empArray, $companyId->id);
           
        $file= date('d-m-YHis')."performance.pdf";
        $pdf = PDF::loadView('employee.performance.performance-list-pdf', $data);
        return $pdf->download($file);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $userID = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userID)->first();
                $performanceObj = new Performance;
                $performanceList = $performanceObj->getPerformanceList($request, $companyId->id);
                echo json_encode($performanceList);
                break;
            case 'getPerformancePercentage':

                if($request->empid != '' && $request->time_period != '')
                {
                    $performanceObj = new Performance;
                    $performanceList = $performanceObj->getEmployeePerformanceList($request->empid);

                    $emp_time = explode('-',$request->time_period);
                
                    $newtimeYear = date("Y",strtotime("-".$emp_time[0]." ".$emp_time[1]));
                    $newtimeMonth = date("m",strtotime("-".$emp_time[0]." ".$emp_time[1]));
                    // echo "<pre>"; print_r($emp_time[0].' - '.$emp_time[1].' - '.$newtimeYear.' - '.$newtimeMonth);

                    $emp_total = $count = 0;
                    if (isset($performanceList) && !empty($performanceList)) 
                    {
                        foreach ($performanceList as $key => $value)
                        {
                            $temp_check = false;
                            if((int)$newtimeYear < (int)$value['year'])
                            {
                                $temp_check = true;
                            }
                            elseif ($newtimeYear == $value['year']) 
                            {
                                if((int)$newtimeMonth <= (int)$value['month'])
                                {
                                    $temp_check = true;
                                }
                            }

                            // echo "<pre>"; print_r($newtimeYear.' - '.$value['year']);
                            // echo "<pre>"; print_r($newtimeMonth.' - '.$value['month']);
                            // var_dump($temp_check); 
                            // echo "<br/>";

                            if ($temp_check == true) 
                            {
                                $emp_total = $emp_total+(int)$value['availability']+
                                    (int)$value['dependability']+
                                    (int)$value['job_knowledge']+
                                    (int)$value['quality']+
                                    (int)$value['productivity']+
                                    (int)$value['working_relationship']+
                                    (int)$value['honesty'];
                                $count++;
                            }
                        }

                        if ($count != 0) 
                        {
                            $grand_total = 5 * 7 * $count; 
                            $percentage = round((($emp_total*100)/$grand_total),2);    
                            return ['status'=>'success','percentage'=>$percentage];
                        }
                        else
                        {
                            return ['status'=>'error','message'=>'No record found'];
                        }
                    }
                    else
                    {
                        return ['status'=>'error','message'=>'No record found'];
                    }
                }
                else
                {
                    return ['status'=>'error','message'=>'Please select value'];
                }
                break;
        }
    }

}
