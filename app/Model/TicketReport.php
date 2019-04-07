<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Ticket;
use Config;

class TicketReport extends Model {

    protected $table = 'ticket_report';

    public function addTicketReport($postData, $id,$compid){
        $ticketNumber = $this->getTicketNumber();

        $empCount = Ticket::where('assign_to', '=', $id)
                ->count();
        if ($empCount > 0) {
            $ticketCount = TicketReport::where('employee_id', '=', $id)
                            ->where('department_id', '=', $postData['dept_id'])
                            ->count();
                            // print_r($ticketCount);exit;
            if($ticketCount == 0){
                $ticketNumber = $this->getTicketNumber();
                $objPayroll = new TicketReport();
                $objPayroll->employee_id = $id;
                $objPayroll->company_id = $compid;
                $objPayroll->department_id = $postData['dept_id'];
                $objPayroll->ticket_report_number = $ticketNumber;
                $objPayroll->download_date = date('Y-m-d');
                $objPayroll->created_at = date('Y-m-d H:i:s');
                $objPayroll->updated_at = date('Y-m-d H:i:s');
                $objPayroll->save();    
                $objPayroll = '';
            }                
        } 
    }

    public function getTicketNumber(){

        $ticketCount =  DB::table('system_generate_no')->where('id', 1)->first();
        $str = ltrim($ticketCount->generated_no, '0');
        $str = (empty($str)) ? 1 : $str;
        $tolalLength = 4;
        $forCount = $tolalLength - strlen($str);
        $num =  $str+1;
        $generateString = '';
        for ($i=1; $i <= $forCount; $i++) { 
            $generateString .= 0;
        }
        DB::table('system_generate_no')->where('id', 1)
            ->update(['generated_no' => $generateString.$num]);
        return $generateString.$num;
    }
    
    public function getTicketReportPdfDetail($postData, $id){
        $result = TicketReport::select('ticket_report.*','tickets.*', 'employee.id as emp_id', 'employee.name as empName', 'comapnies.company_name')
                            ->leftjoin('employee', 'employee.id', '=', 'ticket_report.employee_id')
                            ->leftjoin('department', 'employee.department', '=', 'department.id')
                            ->leftjoin('comapnies', 'comapnies.id', '=', 'employee.company_id')
                            ->leftjoin('tickets', 'tickets.assign_to', '=', 'ticket_report.employee_id')
                            ->where('ticket_report.employee_id', $id)
                            ->get()
                            ->toArray();
        return $result;
    }

    public function getTicketSystemData(){
        $result = TicketReport::select('ticket_report.*')
                            ->leftjoin('employee', 'employee.id', '=', 'ticket_report.employee_id')
                            ->get()->toArray();
        return $result;
    }

    public function getTicketReportDetailV2(){
        $result = TicketReport::select('ticket_report.*', 'employee.id as emp_id', 'employee.name as empName', 'comapnies.company_name')
                            ->join('tickets', 'tickets.assign_to', '=', 'ticket_report.employee_id')
                            ->join('employee', 'employee.id', '=', 'ticket_report.employee_id')
                            ->join('department', 'employee.department', '=', 'department.id')
                            ->join('comapnies', 'comapnies.id', '=', 'employee.company_id')
                            ->groupBy('ticket_report.employee_id')
                            ->get()
                            ->toArray();
        return $result;
    }

    public function getAllEmployeeForTicket($cId){
        $result = Ticket::where('company_id', $cId)->select(DB::raw('GROUP_CONCAT(DISTINCT tickets.assign_to SEPARATOR ",") AS empId'))->orderBy('tickets.assign_to')->get()->toArray();
        return $result;
    }
}
