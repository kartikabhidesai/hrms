<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Users;
use App\Model\Emails;
use PDF;
use Config;

class AdminRole extends Model {

    protected $table = 'admin_role';
    
    public function createAdminRole($request){

        $result = AdminRole::select('email')->where('email', $request->input('email'))->get();
        if (count($result) == 0) {
            $newAdminRole=new AdminRole();
            $newpass = Hash::make($request->input('password'));
            $newAdminRole->user_name=$request->input('user_name');
            $newAdminRole->email=$request->input('email');
            $newAdminRole->password=$newpass;
            $newAdminRole->status=$request->input('status');
            $newAdminRole->department=$request->input('department');
            $newAdminRole->role=$request->input('role');
            $newAdminRole->created_at = date('Y-m-d H:i:s');
            $newAdminRole->updated_at = date('Y-m-d H:i:s');
            return $newAdminRole->save();
        }else{
            return '2';
        }
    }    
    public function editAdminRole($request){
        $result = AdminRole::select('email')->where('id', '!=' , $request->input('role_id'))->where('email', $request->input('email'))->get();
        if (count($result) == 0) {
            $newAdminRole=  AdminRole::find($request->input('role_id'));
            $newpass = Hash::make($request->input('password'));
            $newAdminRole->user_name=$request->input('user_name');
            $newAdminRole->email=$request->input('email');
            // $newAdminRole->password=$newpass;
            $newAdminRole->status=$request->input('status');
            $newAdminRole->department=$request->input('department');
            $newAdminRole->role=$request->input('role');
            $newAdminRole->updated_at = date('Y-m-d H:i:s');
            return $newAdminRole->save();
        }else{
            return '2';
        }
    }
    
   
    public function getAdminRole(){
        $objAdminRoledata=AdminRole::select('*')->get();
        // print_r($objAdminRoledata);exit;
       return ($objAdminRoledata);
    }
   
}
