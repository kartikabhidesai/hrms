<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\UserNotificationType;
use App\Model\Sendmail;
use App\Model\OrderInfo;
use App\Model\Category;
use App\Model\Service;
use App\Model\Users;
use PDF;
use Config;
use File;

class UserNotificationType extends Model {
    protected $table = 'user_notification_type';
    
    public function checkMessage($id){
        $result= UserNotificationType::select('status')
                ->where('user_notification_id',$id)
                ->get()->toarray();
        return $result;
    }
}
