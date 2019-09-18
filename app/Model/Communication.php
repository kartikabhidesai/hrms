<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\UserHasPermission;
use App\Model\Communication;
use App\Model\Users;
use Config;
use Auth;
use DB;

class Communication extends Model
{
    protected $table = 'communication';

    protected $fillable = ['id','communication_id','send_by', 'company_id','send_emp_id','recieve_emp_id','message', 'is_read','file','subject'];

    public function addNewCommunicationCmp($request, $companyId)
    {
     
        $file = '';
        $newCommnucation = new Communication();
        $newCommnucation->communication_id = isset($request->communication_id) ? $request->communication_id : 0;
        $newCommnucation->send_by = 'COMPANY';
        $newCommnucation->company_id = $companyId;
        $newCommnucation->send_emp_id = 0;
        $newCommnucation->recieve_emp_id = $request->emp_id;
        $newCommnucation->message = trim($request->summernote,'');
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
        $newCommnucation->created_at = date('Y-m-d H:i:s');
        $newCommnucation->save();
        return TRUE;
    }
    
     public function addNewCommunicationCmpForward($request, $companyId)
    {
        // echo "<pre>new"; print_r($request->toArray()); exit();
        $file = '';
        $newCommnucation = new Communication();
        $newCommnucation->communication_id = isset($request->communication_id) ? $request->communication_id : 0;
        $newCommnucation->send_by = 'COMPANY';
        $newCommnucation->company_id = $companyId;
        $newCommnucation->send_emp_id = 0;
        $newCommnucation->recieve_emp_id = $request->emp_id;
        $newCommnucation->message = trim($request->summernote,'');
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
        
        if($request->oldFile != NULL || $request->oldFile != ''){
            $newCommnucation->file = $request->oldFile;
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

        if(isset($request->mail_to) && $request->mail_to == 'EMPLOYEE')
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
    
    public function addNewCommunicationEmpNew($request, $companyId, $empId)
    {
        $newCommnucation = new Communication();
        $newCommnucation->communication_id = isset($request->communication_id) ? $request->communication_id : 0;

        if(isset($request->mail_to) && $request->mail_to == 'EMPLOYEE')
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
        
        if($request->oldFile != NULL || $request->oldFile != ''){
            $newCommnucation->file = $request->oldFile;
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
        $newCommnucation->communication_id = isset($request->communication_id) ? $request->communication_id : 0;
        $newCommnucation->send_emp_id = 0;
        $newCommnucation->recieve_emp_id = 0;
        $newCommnucation->company_id = $request->cmp_id;
        $newCommnucation->message = trim($request->summernote, '');
        $newCommnucation->subject = $request->subject;
        $newCommnucation->send_by = 'ADMIN';
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
        if($newCommnucation->save()){
             return $newCommnucation->id;
        }else{
            return false;
           
        }
        
    }

    public function employeeEmailsForCommunication($empId)
    {
        $getListOfEmailOfEmp = Communication::select('communication.*','comapnies.company_name as companyName','employee.name as send_emp_name')
            ->leftjoin('comapnies', 'communication.company_id','comapnies.id')
            ->leftjoin('employee', 'communication.send_emp_id','employee.id')
            ->where('communication.recieve_emp_id',$empId)
            ->where('communication.is_trash','0')
            ->orderBy('communication.id','desc')
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
        $getListOfEmailOfCmp = Communication::select('employee.name as employeeName','comapnies.company_name as companyName','communication.*')
                            ->leftjoin('employee','communication.send_emp_id','employee.id')
                            ->leftjoin('comapnies','communication.company_id','comapnies.id')
                            ->where('communication.recieve_emp_id',0)
                            ->where('communication.send_by','!=','COMPANY')
                            ->where('communication.company_id',$cmpId)
                            ->where('communication.is_trash','0')
                            ->orderBy('communication.id','desc')
                            ->get();

        if(count($getListOfEmailOfCmp) > 0) {
            return $getListOfEmailOfCmp;
        } else {
            return null;
        }
    }
    
    public function unreadEmailsForCommunication($cmpId)
    {
        $unreadMail = Communication::select('employee.name as employeeName','comapnies.company_name as companyName','communication.*')
                            ->leftjoin('employee','communication.send_emp_id','employee.id')
                            ->leftjoin('comapnies','communication.company_id','comapnies.id')
                            ->where(function($q){
                                $q->where('communication.recieve_emp_id',0);
                                $q->orWhereNull('communication.recieve_emp_id');
                            })
                            ->where('communication.is_read',0)
                            ->where('communication.is_trash','0')
                            ->where('communication.send_by','!=','COMPANY')
                            ->where('communication.company_id',$cmpId)
                            ->orderBy('communication.id','desc')
                            ->get();
            return count($unreadMail);
    }
    
    public function unreadEmailsForCommunicationEmployee($empId)
    {
        $unreadMail = Communication::select('employee.name as employeeName','comapnies.company_name as companyName','communication.*')
                            ->leftjoin('employee','communication.send_emp_id','employee.id')
                            ->leftjoin('comapnies','communication.company_id','comapnies.id')
                            ->where('communication.recieve_emp_id',$empId)
                            ->where('communication.is_read',0)
                            ->where('communication.send_by','!=','EMPLOYEE')
                            ->where('communication.is_trash','0')
                            // ->where('communication.company_id',$cmpId)
                            ->orderBy('communication.id','desc')
                            ->get();
        // echo "<pre>"; print_r($unreadMail->toArray()); exit(); 
            return count($unreadMail);
    }

    public function unreadEmailsForCommunicationAdmin()
    {
        $unreadMail = Communication::select('comapnies.company_name as companyName','communication.*')
                            ->leftjoin('comapnies','communication.company_id','comapnies.id')
                            ->where('communication.recieve_emp_id',0)
                            ->where('communication.send_emp_id',0)
                            ->where('communication.is_read',0)
                            ->where('communication.send_by','COMPANY')
                            ->orderBy('communication.id','desc')
                            ->get();
            return count($unreadMail);
    }

    public function companyEmailsForAdminCommunication()
    {
        $getListOfEmailOfCmp = Communication::select('communication.*','comapnies.company_name as companyName')
                                        ->join('comapnies','communication.company_id','comapnies.id')
                                        ->where('communication.recieve_emp_id',1)
                                        ->where('communication.send_by','COMPANY')
                                        ->orderBy('communication.id','desc')
                                        ->get();

        if(count($getListOfEmailOfCmp) > 0) {
            return $getListOfEmailOfCmp;
        } else {
            return null;
        }
    }

    public function companyEmailCommunicationDetail($id)
    {
        $findCommunication = Communication::select('employee.name as employeeName','employee.email as employeeEmail','comapnies.company_name as companyName','communication.*')
                                        ->leftjoin('employee','communication.send_emp_id','employee.id')
                                        ->leftjoin('comapnies','communication.company_id','comapnies.id')
                                        ->where('communication.id',$id)
                                        ->first();

        if($findCommunication) {
            return $findCommunication;
        } else {
            return null;
        }
    }

    public function companySendEmailCommunicationDetail($id)
    {
        $findCommunication = Communication::select('employee.name as employeeName','employee.email as employeeEmail','comapnies.company_name as companyName','communication.*')
                                        ->leftjoin('employee','communication.recieve_emp_id','employee.id')
                                        ->leftjoin('comapnies','communication.company_id','comapnies.id')
                                        ->where('communication.id',$id)
                                        ->first();

        // echo "<pre>"; print_r($findCommunication->toArray()); exit();

        if($findCommunication) {
            return $findCommunication;
        } else {
            return null;
        }
    }

    public function adminEmailCommunicationDetail($id)
    {
        $findCommunication = Communication::select('comapnies.email','comapnies.company_name','communication.*')
                                        ->join('comapnies','communication.company_id','comapnies.id')
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
                                        ->leftjoin('employee', 'communication.recieve_emp_id', 'employee.id')
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
        $getListOfEmailOfCmp = Communication::select('employee.name as employeeName','comapnies.company_name as companyName','communication.*')
            ->leftjoin('employee','communication.recieve_emp_id','employee.id')
            ->leftjoin('comapnies','communication.company_id','comapnies.id')
            ->where('communication.company_id', $cmpId)
            ->where('communication.send_by', 'COMPANY')
            ->where(function($q){
                $q->where('communication.send_emp_id',0);
                $q->orwhereNull('communication.send_emp_id');
            })
            ->orderBy('communication.id','desc')
            ->get();

        if(count($getListOfEmailOfCmp) > 0) {
            return $getListOfEmailOfCmp;
        } else {
            return null;
        }
    }
    
    public function sendCompanyEmailsNew($cmpId)
    {
        $getListOfEmailOfCmp = Communication::select("users.name",'communication.*')
                                ->join('users','communication.recieve_emp_id','=','users.id')
                                ->orderBy('communication.id','desc')
                                ->get();
//        print_r($getListOfEmailOfCmp);
//        die();
        
//        $getListOfEmailOfCmp = Communication::select('employee.name as employeeName','comapnies.company_name as companyName','communication.*')
//            ->leftjoin('employee','communication.recieve_emp_id','employee.id')
//            ->leftjoin('comapnies','communication.company_id','comapnies.id')
//            ->where('communication.company_id', $cmpId)
//            ->where('communication.send_by', 'COMPANY')
//            ->where(function($q){
//                $q->where('communication.send_emp_id',0);
//                $q->orwhereNull('communication.send_emp_id');
//            })
//            ->orderBy('communication.id','desc')
//            ->get();

        if(count($getListOfEmailOfCmp) > 0) {
            return $getListOfEmailOfCmp;
        } else {
            return null;
        }
    }

    public function sendAdminEmails()
    {
        $getListOfAdminOfCmp = Communication::select('communication.*','comapnies.company_name as companyName')
                                        ->join('comapnies', 'communication.company_id','comapnies.id')
                                        ->where(function($q){
                                            $q->where('communication.send_emp_id',0);
                                            $q->orwhereNull('communication.send_emp_id');
                                        })
                                        ->where(function($q){
                                            $q->where('communication.recieve_emp_id',0);
                                            $q->orwhereNull('communication.recieve_emp_id');
                                        })
                                        ->where('communication.send_by', 'ADMIN')
                                        ->orderBy('communication.id','desc')
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
            ->leftjoin('employee','communication.recieve_emp_id','employee.id')
            ->leftjoin('comapnies','communication.company_id','comapnies.id')
            ->where('communication.send_emp_id',$empId)
            ->where('communication.send_by', 'EMPLOYEE')
            ->orderBy('communication.id','desc')
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
    
    
    public function Makeread($id){
        $objCommunication = Communication::find($id);
        $objCommunication->is_read = 1;
        $objCommunication->updated_at = date('Y-m-d H:i:s');
        $objCommunication->save();
        return TRUE;
        
    }
    
    public function trashMail($request){
        
        $objCommunication = Communication::find($request['id']);
        $objCommunication->is_trash ='1';
        $objCommunication->updated_at = date('Y-m-d H:i:s');
        return $objCommunication->save();
    }
    
    public function companyTrashEmailsForCommunication($cmpId) {
        $getListOfEmailOfCmp = Communication::select('employee.name as employeeName','comapnies.company_name as companyName','communication.*')
                            ->leftjoin('employee','communication.send_emp_id','employee.id')
                            ->leftjoin('comapnies','communication.company_id','comapnies.id')
                            ->where('communication.recieve_emp_id',0)
                            ->where('communication.send_by','!=','COMPANY')
                            ->where('communication.company_id',$cmpId)
                            ->where('communication.is_trash','1')
                            ->orderBy('communication.id','desc')
                            ->get();

        if(count($getListOfEmailOfCmp) > 0) {
            return $getListOfEmailOfCmp;
        } else {
            return null;
        }
    }
    
    
    public function employeeTrashEmailsForCommunication($empId){
        $getListOfEmailOfEmp = Communication::select('communication.*','comapnies.company_name as companyName','employee.name as send_emp_name')
            ->leftjoin('comapnies', 'communication.company_id','comapnies.id')
            ->leftjoin('employee', 'communication.send_emp_id','employee.id')
            ->where('communication.recieve_emp_id',$empId)
            ->where('communication.is_trash','1')
            ->orderBy('communication.id','desc')
            ->get();

        // echo "<pre>"; print_r($getListOfEmailOfEmp->toArray()); exit();

        if(count($getListOfEmailOfEmp) > 0) {
            return $getListOfEmailOfEmp;
        } else {
            return null;
        }
    }
    
    public function getDetails($id){
       $result= Communication::select("*")
                            ->where("id",$id)
                            ->get();
       return $result[0];
    }
}?>
