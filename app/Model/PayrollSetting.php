<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use Config;

class PayrollSetting extends Model {

    protected $table = 'payroll_setting';

    public function addpayrollSetting($request){
//        print_r($request->input());
//        exit();
        
    }
}
