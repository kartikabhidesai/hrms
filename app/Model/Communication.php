<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\UserHasPermission;
use App\Model\Communication;
use Config;
use Auth;
use DB;

class Communication extends Model
{
    protected $table = 'communication';

    protected $fillable = ['id', 'employee_id', 'company_id', 'message', 'is_read'];

    public function addNewCommunication($request, $companyId)
    {
        $file = '';
        $newCommnucation = new Communication();
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

    public function addNewCommunicationEmp($request, $companyId, $empId)
    {
        $file = '';
        $newCommnucation = new Communication();
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

    public function employeeEmailsForCommunication($empId)
    {
        $getListOfEmailOfEmp = Communication::select('comapnies.company_name', 'communication.id', 'communication.employee_id', 'communication.message', 'communication.file', 'communication.is_read', 'communication.subject', 'communication.created_at')
                                        ->join('comapnies', 'communication.company_id', '=', 'comapnies.id')
                                        ->where('communication.employee_id', $empId)
                                        ->where('communication.from', 'COMPANY')
                                        ->get();

        if(count($getListOfEmailOfEmp) > 0) {
            return $getListOfEmailOfEmp;
        } else {
            return null;
        }
    }

    public function companyEmailsForCommunication($cmpId)
    {
        $getListOfEmailOfCmp = Communication::select('employee.name', 'communication.id', 'communication.employee_id', 'communication.message', 'communication.file', 'communication.is_read', 'communication.subject', 'communication.created_at')
                                        ->join('employee', 'communication.employee_id', '=', 'employee.id')
                                        ->where('communication.company_id', $cmpId)
                                        ->where('communication.from', 'EMPLOYEE')
                                        ->get();

        if(count($getListOfEmailOfCmp) > 0) {
            return $getListOfEmailOfCmp;
        } else {
            return null;
        }
    }

    public function companyEmailCommunicationDetail($cmpId, $id)
    {
        $findCommunication = Communication::select('employee.email', 'communication.id', 'communication.employee_id', 'communication.message', 'communication.file', 'communication.is_read', 'communication.subject', 'communication.created_at')
                                        ->join('employee', 'communication.employee_id', '=', 'employee.id')
                                        ->where('communication.id', $id)
                                        ->first();

        if($findCommunication) {
            return $findCommunication;
        } else {
            return null;
        }
    }

    public function employeeEmailCommunicationDetail($empId, $id)
    {
        $findCommunication = Communication::select('comapnies.email', 'communication.id', 'communication.employee_id', 'communication.message', 'communication.file', 'communication.is_read', 'communication.subject', 'communication.created_at')
                                        ->join('comapnies', 'communication.company_id', '=', 'comapnies.id')
                                        ->where('communication.employee_id', $empId)
                                        ->first();

        if($findCommunication) {
            return $findCommunication;
        } else {
            return null;
        }
    }

    public function sendCompanyEmails($cmpId)
    {
        $getListOfEmailOfCmp = Communication::select('employee.name', 'communication.id', 'communication.employee_id', 'communication.message', 'communication.file', 'communication.is_read', 'communication.subject', 'communication.created_at')
                                        ->join('employee', 'communication.employee_id', '=', 'employee.id')
                                        ->where('communication.company_id', $cmpId)
                                        ->where('communication.from', 'COMPANY')
                                        ->get();

        if(count($getListOfEmailOfCmp) > 0) {
            return $getListOfEmailOfCmp;
        } else {
            return null;
        }
    }

    public function sendEmployeeEmails($empId)
    {
        $getListOfEmailOfCmp = Communication::select('employee.name', 'communication.id', 'communication.employee_id', 'communication.message', 'communication.file', 'communication.is_read', 'communication.subject', 'communication.created_at')
                                        ->join('employee', 'communication.employee_id', '=', 'employee.id')
                                        ->where('communication.employee_id', $empId)
                                        ->where('communication.from', 'EMPLOYEE')
                                        ->get();

        if(count($getListOfEmailOfCmp) > 0) {
            return $getListOfEmailOfCmp;
        } else {
            return null;
        }
    }
}
