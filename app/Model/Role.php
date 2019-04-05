<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\Role;

class Role extends Model {

    protected $table = 'role';

    public function createRole($request,$company_id){

          $newRole=new Role();
          $newRole->role_name=$request->input('role_name');
          $newRole->company_id=$company_id;
          $newRole->created_at = date('Y-m-d H:i:s');
          $newRole->updated_at = date('Y-m-d H:i:s');
          return $newRole->save();
    }
    
   
    public function getRoleCompanyList($company_id){
        $objRoledata=Role::where('company_id',$company_id)->select('id', 'role_name')->get();
       return ($objRoledata);
    }
}
