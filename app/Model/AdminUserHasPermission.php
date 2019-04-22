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

}
