<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;

class AdminUserHasPermission extends Model {

    protected $table = 'admin_user_has_permission';
    
    public function getPermission($userId) {
        $result = AdminUserHasPermission::select('admin_user_has_permission.*')->where('admin_user_has_permission.user_id', '=', $userId)->get();
        return $result;
    }
    
    public function permissionList($id){
        $result = AdminUserHasPermission::select('permission_id')
                 ->where('admin_role_id', '=',$id)->get()->toarray();
        $permissionArray=[];
        for($i = 0; $i < count($result) ;$i++){
            array_push($permissionArray,$result[$i]['permission_id']);
        }
        return $permissionArray;
        
    }

}
