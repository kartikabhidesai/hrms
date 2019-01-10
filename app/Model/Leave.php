<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use Config;

class Leave extends Model {

    protected $table = 'leaves';

    public function addnewleave($request) {
        $objLeave = new Leave();
        $objLeave->start_date = $request->input('start_date');
        $objLeave->end_date = $request->input('end_date');
        $objLeave->reason = $request->input('reason');
        $objLeave->created_at = date('Y-m-d H:i:s');
        $objLeave->updated_at = date('Y-m-d H:i:s');
        $objLeave->save();

        return TRUE;
    }

}
