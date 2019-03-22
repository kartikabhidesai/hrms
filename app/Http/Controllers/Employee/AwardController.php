<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Award;
use App\Model\Company;
use App\Model\Employee;
use App\Model\Department;
use Auth;

class AwardController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        parent::__construct();
        $this->middleware('employee');
    }

    public function index() {
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/award.js', 'jquery.form.min.js', 'jquery.timepicker.js');
        $data['funinit'] = array('Award.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Award List',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Award' => 'Award'));

        return view('employee.award.award-list', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $userid = $this->loginUser->id;
                $empId = Employee::select('id')->where('user_id', $userid)->first();
                $awardObj = new Award;
                $AwardList = $awardObj->getAwardList($request, $empId->id);
                echo json_encode($AwardList);
                break;
            case'awardDetails':
                $result = $this->getAwardDetails($request->input('data'));
                break;
        }
    }

    // public function deleteAward($postData) {
    //     if ($postData) {
    //         $findAnnounmnt = Award::where('id', $postData['id'])->first();
    //         $result = $findAnnounmnt->delete();

    //         if ($result) {
    //             $return['status'] = 'success';
    //             $return['message'] = 'Record deleted successfully.';
    //             $return['jscode'] = "setTimeout(function(){
    //                     $('#deleteModel').modal('hide');
    //                     $('#AwardDatatables').DataTable().ajax.reload();
    //                 },1000)";
    //         } else {
    //             $return['status'] = 'error';
    //             $return['message'] = 'Something will be wrong.';
    //         }
    //         echo json_encode($return);
    //         exit;
    //     }
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getAwardDetails($postData)
    {
        $userId = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userId)->first();

        $awardDetails = Award::select('award.*','emp.name as emp_name','department.department_name as dept_name')
                            ->join('employee as emp', 'award.employee_id', '=', 'emp.id')
                            ->join('department', 'award.department', '=', 'department.id')
                            ->where('award.id', $postData)
                            ->first();

        if($awardDetails){
            $awardDetails->date = date("d-m-Y", strtotime($awardDetails->date));
        }

        echo json_encode($awardDetails);
        exit;
    }

    public function downloadAttachment(Request $request,$file_name)
    {
        // echo "<pre>"; print_r($file_name); exit();
        $file = public_path(). "/uploads/award_attachment/".$file_name;
        if(file_exists($file))
        {
            return Response::download($file,$file_name);
        }
        else
        {
            return redirect('employee/award')->with('status', 'file not found!');
        }
    }
}
