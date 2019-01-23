<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use Config;

class Payroll extends Model {

    protected $table = 'pay_roll';

    public function addnewpayroll($request) {
        echo '<pre>';
        print_r($request);
        exit;
        $objPayroll = new Payroll();

        $objLeave->save();

        return TRUE;
    }

}
