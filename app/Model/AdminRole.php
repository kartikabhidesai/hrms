<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\AdminUserHasPermission;
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
            $newAdminRole->created_at = date('Y-m-d H:i:s');
            $newAdminRole->updated_at = date('Y-m-d H:i:s');
            if($newAdminRole->save()){
                $lastId = $newAdminRole->id;
                if (!empty($request->input('checkboxes'))) {
                    $permisson = $request->input('checkboxes');
                    for ($i = 0; $i < count($permisson); $i++) {
                        $systemUser = new AdminUserHasPermission();
                        $systemUser->permission_id = $permisson[$i];
                        $systemUser->user_id = $lastId;
                        $systemUser->updated_at = date('Y-m-d H:i:s');
                        $systemUser->created_at = date('Y-m-d H:i:s');
                        $result = $systemUser->save();
                    }
                }
                return true;
            }
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
            $newAdminRole->updated_at = date('Y-m-d H:i:s');
            // return $newAdminRole->save();
            if($newAdminRole->save()){
                $lastId = $newAdminRole->id;
                $delete = AdminUserHasPermission::where('user_id',  $request->input('role_id'))->delete();
                if (!empty($request->input('checkboxes'))) {
                    $permisson = $request->input('checkboxes');
                    for ($i = 0; $i < count($permisson); $i++) {
                        $systemUser = new AdminUserHasPermission();
                        $systemUser->permission_id = $permisson[$i];
                        $systemUser->user_id = $lastId;
                        $systemUser->updated_at = date('Y-m-d H:i:s');
                        $systemUser->created_at = date('Y-m-d H:i:s');
                        $result = $systemUser->save();
                    }
                }
                return true;
            }
        }else{
            return '2';
        }
    }
    
    public function getAdminRole(){
        $objAdminRoledata=AdminRole::select('*')->get();
       return ($objAdminRoledata);
    }
   
    public function getMasterPermisson() {
        $result = DB::table('permission_master')->where('permission_master.is_active', '=', '1')->get();
        return $result;
    }  

    public function getAdminMasterPermisson() {
        $result = DB::table('permission_master')->where('permission_master.is_active', '=', '1')->where('permission_master.type', '=', 'ADMIN')->get();
        return $result;
    }

    public function getCpmpanyMasterPermisson() {
        $result = DB::table('permission_master')->where('permission_master.is_active', '=', '1')->where('permission_master.type', '=', 'COMPANY')->get();
        return $result;
    }

}
