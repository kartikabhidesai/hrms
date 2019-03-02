<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\UserHasPermission;
use App\Model\CommunicationReply;
use Config;
use Auth;
use DB;

class CommunicationReply extends Model
{
    protected $table = 'communication_reply';

    protected $fillable = ['id','communication_id','employee_id', 'company_id', 'message', 'is_read'];

    public function addNewCommunicationReply($request, $companyId)
    {
        $file = '';
        $newCommnucation = new CommunicationReply();
        $newCommnucation->communication_id = $request->communication_id;
        $newCommnucation->employee_id = $request->emp_id;
        $newCommnucation->company_id = $companyId;
        $newCommnucation->message = trim($request->summernote, '');
        $newCommnucation->subject = $request->subject;
        $newCommnucation->from = 'COMPANY';
        if ($request->file('file')) {
            $image = $request->file('file');
            $file = 'communication' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/communication/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image->move($destinationPath, $file);
            $newCommnucation->file = '/uploads/communication/'.$file;
        }
        $newCommnucation->is_read = 0;
        $newCommnucation->created_at = date('Y-m-d H:i:s');
        $newCommnucation->created_at = date('Y-m-d H:i:s');
        $newCommnucation->save();
        return TRUE;
    }

    public function addNewCommunicationReplyEmp($request, $companyId, $empId)
    {
        $file = '';
        $newCommnucation = new CommunicationReply();
        $newCommnucation->communication_id = $request->communication_id;
        $newCommnucation->employee_id = $empId;
        $newCommnucation->company_id = $companyId;
        $newCommnucation->message = trim($request->summernote, '');
        $newCommnucation->subject = $request->subject;
        $newCommnucation->from = 'EMPLOYEE';
        if ($request->file('file')) {
            $image = $request->file('file');
            $file = 'communication' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/communication/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image->move($destinationPath, $file);
            $newCommnucation->file = '/uploads/communication/'.$file;
        }
        $newCommnucation->is_read = 0;
        $newCommnucation->created_at = date('Y-m-d H:i:s');
        $newCommnucation->created_at = date('Y-m-d H:i:s');
        $newCommnucation->save();
        return TRUE;
    }

    public function employeeEmailsForCommunicationReply($empId)
    {
        $getListOfEmailOfEmp = CommunicationReply::select('comapnies.company_name', 'communication_reply.id', 'communication_reply.employee_id', 'communication_reply.message', 'communication_reply.file', 'communication_reply.is_read', 'communication_reply.subject', 'communication_reply.created_at')
                                        ->join('comapnies', 'communication_reply.company_id', '=', 'comapnies.id')
                                        ->where('communication_reply.employee_id', $empId)
                                        ->where('communication_reply.from', 'COMPANY')
                                        ->get();

        if(count($getListOfEmailOfEmp) > 0) {
            return $getListOfEmailOfEmp;
        } else {
            return null;
        }
    }

    public function companyEmailsForCommunicationReply($cmpId)
    {
        $getListOfEmailOfCmp = CommunicationReply::select('employee.name', 'communication_reply.id', 'communication_reply.employee_id', 'communication_reply.message', 'communication_reply.file', 'communication_reply.is_read', 'communication_reply.subject', 'communication_reply.created_at')
                                        ->join('employee', 'communication_reply.employee_id', '=', 'employee.id')
                                        ->where('communication_reply.company_id', $cmpId)
                                        ->where('communication_reply.from', 'EMPLOYEE')
                                        ->get();

        if(count($getListOfEmailOfCmp) > 0) {
            return $getListOfEmailOfCmp;
        } else {
            return null;
        }
    }

    public function companyEmailCommunicationReplyDetail($cmpId, $id)
    {
        $findCommunication = CommunicationReply::select('employee.email', 'communication_reply.id', 'communication_reply.employee_id', 'communication_reply.message', 'communication_reply.file', 'communication_reply.is_read', 'communication_reply.subject', 'communication_reply.created_at')
                                        ->join('employee', 'communication_reply.employee_id', '=', 'employee.id')
                                        ->where('communication_reply.id', $id)
                                        ->first();

        if($findCommunication) {
            return $findCommunication;
        } else {
            return null;
        }
    }

    public function employeeEmailCommunicationReplyDetail($empId, $id)
    {
        $findCommunication = CommunicationReply::select('comapnies.email', 'communication_reply.id', 'communication_reply.employee_id', 'communication_reply.message', 'communication_reply.file', 'communication_reply.is_read', 'communication_reply.subject', 'communication_reply.created_at')
                                        ->join('comapnies', 'communication_reply.company_id', '=', 'comapnies.id')
                                        ->where('communication_reply.employee_id', $empId)
                                        ->where('communication_reply.id', $id)
                                        ->first();

        if($findCommunication) {
            return $findCommunication;
        } else {
            return null;
        }
    }

    public function sendCompanyEmails($cmpId)
    {
        $getListOfEmailOfCmp = CommunicationReply::select('employee.name', 'communication_reply.id', 'communication_reply.employee_id', 'communication_reply.message', 'communication_reply.file', 'communication_reply.is_read', 'communication_reply.subject', 'communication_reply.created_at')
                                        ->join('employee', 'communication_reply.employee_id', '=', 'employee.id')
                                        ->where('communication_reply.company_id', $cmpId)
                                        ->where('communication_reply.from', 'COMPANY')
                                        ->get();

        if(count($getListOfEmailOfCmp) > 0) {
            return $getListOfEmailOfCmp;
        } else {
            return null;
        }
    }

    public function sendEmployeeEmails($empId)
    {
        $getListOfEmailOfCmp = CommunicationReply::select('employee.name', 'communication_reply.id', 'communication_reply.employee_id', 'communication_reply.message', 'communication_reply.file', 'communication_reply.is_read', 'communication_reply.subject', 'communication_reply.created_at')
                                        ->join('employee', 'communication_reply.employee_id', '=', 'employee.id')
                                        ->where('communication_reply.employee_id', $empId)
                                        ->where('communication_reply.from', 'EMPLOYEE')
                                        ->get();

        if(count($getListOfEmailOfCmp) > 0) {
            return $getListOfEmailOfCmp;
        } else {
            return null;
        }
    }
}
