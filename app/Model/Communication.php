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

    protected $fillable = ['id','communication_id','send_by', 'company_id','send_emp_id','recieve_emp_id','message', 'is_read','file','subject'];

    public function addNewCommunication($request, $companyId)
    {
        $file = '';
        $newCommnucation = new Communication();
        $newCommnucation->employee_id = isset($request->emp_id)?$request->emp_id:0;
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
        $newCommnucation = new Communication();
        $newCommnucation->communication_id = isset($request->communication_id) ? $request->communication_id : 0;

        if(isset($request->mail_to) && $request->mail_to == 'employee')
        {
            $newCommnucation->recieve_emp_id = $request->emp_id;
        }
        else
        {
            $newCommnucation->recieve_emp_id = '';   
        }

        $newCommnucation->send_by = 'EMPLOYEE';
        $newCommnucation->company_id = $companyId;
        $newCommnucation->send_emp_id = $empId;
        $newCommnucation->message = trim($request->summernote, '');
        $newCommnucation->subject = $request->subject;
        $file = '';
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
        $newCommnucation->updated_at = date('Y-m-d H:i:s');
        $newCommnucation->save();
        return TRUE;
    }

    public function addNewCommunicationAdmin($request)
    {
        $file = '';
        $newCommnucation = new Communication();
        $newCommnucation->employee_id = 0;
        $newCommnucation->company_id = $request->cmp_id;
        $newCommnucation->message = trim($request->summernote, '');
        $newCommnucation->subject = $request->subject;
        $newCommnucation->from = 'ADMIN';
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
        $getListOfEmailOfEmp = Communication::select('communication.*','comapnies.company_name as companyName','employee.name as send_emp_name')
            ->leftjoin('comapnies', 'communication.company_id','comapnies.id')
            ->leftjoin('employee', 'communication.send_emp_id','employee.id')
            ->where('communication.recieve_emp_id',$empId)
            ->get();

        // echo "<pre>"; print_r($getListOfEmailOfEmp->toArray()); exit();

        if(count($getListOfEmailOfEmp) > 0) {
            return $getListOfEmailOfEmp;
        } else {
            return null;
        }
    }

    public function companyEmailsForCommunication($cmpId)
    {
        $getListOfEmailOfCmp = Communication::select('employee.name', 'communication.id', 'communication.employee_id', 'communication.message', 'communication.file', 'communication.is_read', 'communication.subject', 'communication.created_at',DB::raw('"communication" as communication_table'))
                                        ->leftjoin('employee', 'communication.employee_id', '=', 'employee.id')
                                        ->where('communication.company_id', $cmpId)
                                        ->where(function($query){
                                            $query->where('communication.from', 'EMPLOYEE');
                                            $query->orWhere('communication.from', 'ADMIN');
                                        })
                                        ->get();

        if(count($getListOfEmailOfCmp) > 0) {
            return $getListOfEmailOfCmp;
        } else {
            return null;
        }
    }

    public function companyEmailsForAdminCommunication()
    {
        $getListOfEmailOfCmp = Communication::select('communication.id', 'communication.employee_id', 'communication.message', 'communication.file', 'communication.is_read', 'communication.subject', 'communication.created_at',DB::raw('"communication" as communication_table'),'comapnies.company_name')
                                        ->join('comapnies','communication.company_id','comapnies.id')
                                        ->where('communication.employee_id',0)
                                        ->where('communication.from', 'COMPANY')
                                        ->get();

        if(count($getListOfEmailOfCmp) > 0) {
            return $getListOfEmailOfCmp;
        } else {
            return null;
        }
    }

    public function companyEmailCommunicationDetail($cmpId, $id)
    {
        $findCommunication = Communication::select('employee.email','employee.name','communication.id', 'communication.employee_id', 'communication.message', 'communication.file', 'communication.is_read', 'communication.subject', 'communication.subject', 'communication.created_at',DB::raw('"communication" as communication_table'))
                                        ->join('employee', 'communication.employee_id', '=', 'employee.id')
                                        ->where('communication.id', $id)
                                        ->first();

        if($findCommunication) {
            return $findCommunication;
        } else {
            return null;
        }
    }

    public function adminEmailCommunicationDetail($id)
    {
        $findCommunication = Communication::select('comapnies.email','comapnies.company_name','communication.id', 'communication.employee_id', 'communication.message', 'communication.file', 'communication.is_read', 'communication.subject', 'communication.subject', 'communication.created_at',DB::raw('"communication" as communication_table'))
                                        ->join('comapnies', 'communication.company_id','comapnies.id')
                                        ->where('communication.id', $id)
                                        ->first();

        if($findCommunication) {
            return $findCommunication;
        } else {
            return null;
        }
    }

    public function employeeEmailCommunicationDetail($id)
    {
        $findCommunication = Communication::select('comapnies.email as companyEmail',
                                                'employee.name as employeeName',
                                                'employee.email as employeeEmail',
                                                'communication.*')
                                        ->leftjoin('comapnies', 'communication.company_id', 'comapnies.id')
                                        ->leftjoin('employee', 'communication.send_emp_id', 'employee.id')
                                        ->where('communication.id', $id)
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

    public function sendAdminEmails()
    {
        $getListOfAdminOfCmp = Communication::select('comapnies.company_name', 'communication.id', 'communication.employee_id', 'communication.message', 'communication.file', 'communication.is_read', 'communication.subject', 'communication.created_at')
                                        ->join('comapnies', 'communication.company_id','comapnies.id')
                                        ->where('communication.employee_id',0)
                                        ->where('communication.from', 'ADMIN')
                                        ->get();

        if(count($getListOfAdminOfCmp) > 0) {
            return $getListOfAdminOfCmp;
        } else {
            return null;
        }
    }

    public function sendEmployeeEmails($empId)
    {
        $getListOfEmailOfCmp = Communication::select('employee.name as employeeName','comapnies.company_name as companyName','communication.*')
            ->leftjoin('employee','communication.send_emp_id','employee.id')
            ->leftjoin('comapnies','communication.company_id','comapnies.id')
            ->where('communication.send_emp_id',$empId)
            ->where('communication.send_by', 'EMPLOYEE')
            ->get();

        if(count($getListOfEmailOfCmp) > 0) {
            return $getListOfEmailOfCmp;
        } else {
            return null;
        }
    }

    public function getComminucationDataEmp($id)
    {
        $getComminucationDataEmp = Communication::select('communication.*')->where('id', $id)->first();

        if($getComminucationDataEmp) {
            return $getComminucationDataEmp;
        } else {
            return null;
        }
    }
}
