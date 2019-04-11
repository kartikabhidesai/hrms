<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Users;
use App\Model\ExperiencBased;
use PDF;
use Config;

class ExperiencBased extends Model {

    protected $table = 'exprience_basd_leave_count';

    public function getCount($id){
         $query = ExperiencBased::from('exprience_basd_leave_count')
                ->where('leave_categories_id',$id)
                ->select('*')->get();
        return $query;
    }
}
