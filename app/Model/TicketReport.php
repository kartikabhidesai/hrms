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

    public function addTicketReport($postData, $id){
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
                $objPayroll->company_id = '';
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
        $ticketCount = TicketReport::orderBy('id', 'desc')->first();
        $num = 1;
        if(isset($ticketCount) && !empty($ticketCount) && $ticketCount->count() > 0){
            $num = $ticketCount->id;
            $num + 1;
        }        
        $tolalLength = 4;
        $forCount = $tolalLength - strlen($num);
        $generateString = '';
        for ($i=1; $i <= $forCount; $i++) { 
            $generateString .= 0;
        }
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
        $result = TicketReport::select('ticket_report.*','tickets.*', 'employee.id as emp_id', 'employee.name as empName', 'comapnies.company_name')
                            ->leftjoin('tickets', 'tickets.assign_to', '=', 'ticket_report.employee_id')
                            ->leftjoin('employee', 'employee.id', '=', 'ticket_report.employee_id')
                            ->leftjoin('department', 'employee.department', '=', 'department.id')
                            ->leftjoin('comapnies', 'comapnies.id', '=', 'employee.company_id')
                            ->get()
                            ->toArray();
        return $result;
    }

    public function getAllEmployeeForTicket($cId){
        $result = Ticket::where('company_id', $cId)->select(DB::raw('GROUP_CONCAT( tickets.assign_to SEPARATOR ",") AS empId'))->orderBy('tickets.assign_to')->get()->toArray();
        return $result;
    }
}
