<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\OrderInfo;
use App\Model\Category;
use App\Model\Service;
use App\Model\Users;
use PDF;
use Config;
use File;

class Users extends Model {
    protected $table = 'users';
   
    public function saveUserInfo($request) {
        $newpassword = ($request->input('password') != '') ? $request->input('password') : null;
        $newpass = Hash::make($newpassword);
        $objUser = new Users();
        $objUser->name = $request->input('first_name');
        $objUser->email = $request->input('email');
        $objUser->type = 'CLIENT';
//        $objUser->role_type = $request->input('role_type');
        $objUser->password = $newpass;
        $objUser->created_at = date('Y-m-d H:i:s');
        $objUser->updated_at = date('Y-m-d H:i:s');
        $objUser->save();
        return TRUE;
    }
    public function addEmp($request) {
        $objUser = new Users();
         $dublicateCheck = Users::where('email', '=',  $request->input('email'))
                ->count();
        if ($dublicateCheck == 0) {
            $objUser->name = $request->input('name');
            $objUser->email = $request->input('email');
            $objUser->type = 'EMPLOYEE';
            $objUser->password = Hash::make($request->input('id'));
            $objUser->created_at = date('Y-m-d H:i:s');
            $objUser->updated_at = date('Y-m-d H:i:s');
            $objUser->save();
            return $objUser->id;
        }else{
            return false;
        }
    }

    public function passwordReset($email) {
        $result =  Users::select('users.*')->where('users.email', '=', $email)->get()->toArray();
        
        if($result){
           $newpassword = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzASLKJHGDMNBVCXZPOIUYTREWQ", 6)), 0, 6);
        
            $objUser = Users::find($result[0]['id']);
            $objUser->password = Hash::make($newpassword);
            $objUser->created_at = date('Y-m-d H:i:s');
            $objUser->save();

            $mailData['subject'] = 'Forgot password';
            $mailData['attachment'] = array();
            $mailData['mailto'] =  $result[0]['email'];
            $sendMail = new Sendmail;
            $mailData['data']['caller_email'] = $result[0]['email'];
            $mailData['data']['name'] = $result[0]['name'];
            $mailData['data']['password'] = $newpassword;
            $mailData['template'] = 'emails.forgot-email';
            $res = $sendMail->sendSMTPMail($mailData);
            return true;
        }
        return false;
    }

    public function saveEditUserInfo($request, $userId)
    {
     
        $name = '';
        $objUser = Users::find($userId);
        
        if($request->file()){
           
            $existImage = public_path('/uploads/client/').$objUser->user_image;
            if (File::exists($existImage)) { // unlink or remove previous company image from folder
                File::delete($existImage);
            }
            
            $image = $request->file('profile_pic');
            $name = 'profile_img'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $name);    
            $objUser->user_image = $name;
        }
        // $objUser->name = !empty($request->input('newpassword')) ? Hash::make($request->input('newpassword')) : $request->input('oldpassword');
        $objUser->name = $request->input('first_name');
        
        if ($objUser->save()) {
            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function updatePassword($request, $userId)
    {
        $objUser = Users::find($userId);
        $objUser->password = !empty($request->input('new_password')) ? Hash::make($request->input('new_password')) : $request->input('old_password');
        $objUser->save();
        return TRUE;
    }
    
    public function sendEmailNotification($notificationMasterId,$employeeId,$msg){
            $result = Employee::select('email')
                        ->where('employee.id',$employeeId)
                        ->get();
            
            $email = $result[0]->email;
            
//            $mailData['data']='';
            $mailData['data']['msg']=$msg;
            $mailData['subject'] = $msg;
            $mailData['attachment'] = array();
            $mailData['template'] ="company.emails.notification";
            $mailData['mailto'] = 'parthkhunt12@gmail.com';
            $sendMail = new Sendmail;
            $sendMail->sendSMTPMail($mailData);
            
    }
    
     public function sendEmailNotificationNew($notificationMasterId,$employeeId,$msg){
          
            $userDetails= Users::select("type","id","email")
                        ->where("id",$employeeId)
                        ->get();
            
            if($userDetails[0]->type != 'ADMIN'){
                $email = $userDetails[0]->email;
                $mailData['data']['msg']=$msg;
                $mailData['subject'] = $msg;
                $mailData['attachment'] = array();
                $mailData['template'] ="company.emails.notification";
                $mailData['mailto'] = 'parthkhunt12@gmail.com';
                $sendMail = new Sendmail;
                $sendMail->sendSMTPMail($mailData);
            }
            
           
//            $mailData['data']='';
            
            
    }
}
