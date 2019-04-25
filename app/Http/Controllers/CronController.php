<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Task;
use App\Model\Ticket;
use App\Model\Notification;
use App\Model\TypeOfRequest;
use App\Model\Recruitment;
use Config;
class CronController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('guest', ['except' => 'logout']);
    }


    public function taskExpired() {
        
        $objTask = new Task();
        $getTask=$objTask->getTaskNotComplitedList();
       
        foreach($getTask as $val){
            $taskName=$val['task']." Task is Expired.";
            $objCompany = new Company();
            $u_id=$objCompany->getUseridById($val['company_id']);
            $route_url="task-list";
            $objNotification = new Notification();
            $ret = $objNotification->addNotification($u_id,$taskName,$route_url);
        }
    }

    public function ticketExpired() {

        $objTicket = new Ticket();
        $getTicket=$objTicket->getTicketNotComplitedList();
       
        foreach($getTicket as $val){
            $ticketName=$val['subject']." Ticket is Expired.";
            $objCompany = new Company();
            $u_id=$objCompany->getUseridById($val['company_id']);
            $route_url="ticket-list";
            $objNotification = new Notification();
            $ret = $objNotification->addNotification($u_id,$ticketName,$route_url);
        }
    }

    public function recruitmentSubmissionExpiry() {

        $objRecruitment = new Recruitment();
        $getRecruitment=$objRecruitment->getRecruitmentNotComplitedList();
        // print_r($getRecruitment);exit;
        foreach($getRecruitment as $val){
            $ticketName=date('d-m-Y', strtotime($val['expire_date']))." expiry of the submission period on the work offer.";
            $objCompany = new Company();
            $u_id=$objCompany->getUseridById($val['company_id']);
            $route_url="recruitment";
            $objNotification = new Notification();
            $ret = $objNotification->addNotification($u_id,$ticketName,$route_url);
        }
    }

}