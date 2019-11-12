<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Model\Company;
use App\Model\Department;
use App\Model\Employee;
use App\Model\TicketReport;
use App\Model\HolidayReport;
use Auth;
use Route;
use APP;
use PDF;
use Illuminate\Http\Request;

class HolidayReportController extends Controller {

    public function __construct() {
        // parent::__construct();
        $this->middleware('company');
    }
    
    public function index(Request $request){
       $session = $request->session()->all();
        $userid = $session['logindata'][0]['id'];
        $companyId = Company::select('id')->where('user_id', $userid)->first();
        $data['getAllEmpOfCompany'] = Employee::where('company_id', $companyId->id)->get();
        $data['departments'] = Department::where('company_id', $companyId['id'])->get();
        $dataPdf = array();

        if ($request->isMethod('post')) 
        {
            $postData = $request->input();
            $empArray = $postData['emparray'];
            // print_r($request->dept_id);exit;

            $objHolidayReport = new HolidayReport();
            $dataPdf = $objHolidayReport->generateHolidayReport($request,$companyId->id);        

            // if( $postData['emp_id'] == 'All' && $postData['dept_id'] == 'All'){
            //     $objHolidayReport = new HolidayReport();
            //     $ticketArr = $objHolidayReport->getAllEmployeeForHoliday($companyId->id);        
            //     $empEmplodeArray = explode(',', $ticketArr[0]['empId']);
            // }else{
            //     $empArray = $postData['emparray'];    
            //     $empEmplodeArray = explode(',', $empArray);
            // }

            // foreach ($empEmplodeArray as $key => $value) 
            // {
            //     $objHolidayReport = new HolidayReport();
            //     if(empty($postData['downloadstatus'])){
            //         $employeeArr = $objHolidayReport->addHolidayReport($postData,$value);    
            //     }
            //     $employeeArr = $objHolidayReport->getHolidayReportPdfDetail($postData,$value);  
            //     foreach ($employeeArr as $key => $value) {
            //             if(!empty($employeeArr)){
            //                 $dataPdf[] = $value;
            //             }
            //         }
            // }
                // echo '<pre/>';
            // print_r($dataPdf);exit;


                if(count($dataPdf) > 0)
                {
                    $final_data = [];
                    foreach ($dataPdf as $key1 => $value1) 
                    {
                        foreach ($data['getAllEmpOfCompany'] as $key2 => $value2) 
                        {
                            if($value1['emp_id'] == $value2->id)
                            {
                                $final_data[$value1['emp_id']][] = $value1;
                            }
                        }
                    }
                    
                    $objHolidayReport = new HolidayReport();
                    $addHolidayReport = $objHolidayReport->addHolidayReport($postData,$companyId->id);    

                    $data['holiday_report_number'] = $addHolidayReport['holiday_report_number'];
                    $data['download_date'] = $addHolidayReport['download_date'];

                    $data['empPdfArray'] = $final_data;
                    $file= date('dmYHis')."holiday-report.pdf";
                    $pdf = PDF::loadView('company.holiday-report.holiday-pdf', $data);
                    
                    return $pdf->download($file);    
                }
            }


        $objHolidayReport = new HolidayReport();
        $data['holidayArray'] = $objHolidayReport->getHolidaySystemData();
        // print_r($data['holidayArray']);exit;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/holiday_report.js');
        $data['funinit'] = array('HolidayReport.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Holiday Report',
            'breadcrumb' => array(
                'Home' => route("dashboard"),
                'Report List' => route("report-list"),
                'Holiday Report' => 'holiday-report'));
        return view('company.holiday-report.holiday-report', $data);
    }

     public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case'deleteHoliday':
                $result = $this->deleteHoliday($request->input('data'));
                break;
            case 'getEmployee':
                
                $empId = $request->input('data');
                $session = $request->session()->all();
                $userid = $session['logindata'][0]['id'];
                $companyId = Company::select('id')->where('user_id', $userid)->first();

                $objEmployee = new Employee();
                $employee = $objEmployee->getEmployeeByDept($empId,$companyId->id);
                // print_r($employee);exit;
                echo json_encode($employee);
                break;
        }
    }

    public function deleteHoliday($postData) {
        if ($postData) {
            $findAnnounmnt = HolidayReport::where('id', $postData['id'])->first();
            $result = $findAnnounmnt->delete();
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Record deleted successfully.';
                $return['jscode'] = "setTimeout(function(){
                        $('#deleteModel').modal('hide');
                        location.reload();
                    },1000)";
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
    }

}