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

class Emails extends Model {
//    protected $table = 'demo';
    public function addemailTemplate($request){
        //print_r($request->input());exit;
        return TRUE;
    }
    
    public function editemailTemplate($request){
        //print_r($request->input());exit;
        return TRUE;
    }
   
}
