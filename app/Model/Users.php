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

    public function passwordReset($email) {
        $result =  Users::select('users.*')->where('users.email', '=', $email)->get()->toArray();
        if($result){
           $newpassword = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzASLKJHGDMNBVCXZPOIUYTREWQ", 6)), 0, 6);;
        
        $objUser = Users::find($result[0]['id']);
        $objUser->password = Hash::make($newpassword);
        $objUser->created_at = date('Y-m-d H:i:s');
        $objUser->save();

        $mailData['subject'] = 'Forgot password';
        $mailData['attachment'] = array();
        // $mailData['mailto'] = 'shaileshvanaliya91@gmail.com';
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

     public function saveEditUserInfo($request) {
        // print_r($request->input());exit;
        $name = '';
        if($request->file()){
            $image = $request->file('profile_pic');
            $name = 'admin'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/client/');
            $image->move($destinationPath, $name);    
        }
        $userId = $request->input('editid');
        $objUser = Users::find($userId);
        $objUser->name = $request->input('first_name');
        $objUser->user_image = $name;
        if ($objUser->save()) {
            return TRUE;
        } else {

            return FALSE;
        }
    }
}
