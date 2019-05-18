<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\Company;
use App\Model\Notification;
use Config;

class NotificationMaster extends Model {

    protected $table = 'notification_master';

    public function addNotificationMasterUser() {

        $userdata =  DB::table('users')->orderBy('id', 'desc')->first();
        print_r($userdata);exit;
        $NotificationMaster=DB::table('notification_master')->get();
        foreach($NotificationMaster as $row)
        {
            DB::table('user_notification')->insert(
                ['company_id' => $userdata[0]->id,'notification_master_id'=> $row->id]
            );
        }
        return TRUE;
    }

    public function getEmployeeNotificationList($userid) {
        $query =DB::table('user_notification as un')
                ->join('notification_master as nm', 'nm.id', '=', 'un.notification_master_id')
                ->where('un.company_id',$userid)
                ->select(array('un.id','nm.notification_name','nm.description','un.status'))
                ->get();
        // $data = array();
        
        return $query;
    }

    public function onOffUserNotificationStatus($id,$status){
        $objSavedata=DB::table('user_notification')->where('id',$id)->update(['status'=>$status]);
        return ($objSavedata);
     }

    public function checkNotificationUserStatus($userid,$notification_master_id){
        
        $getdata=DB::table('user_notification')->where('company_id',$userid)->where('notification_master_id',$notification_master_id)->select('status')->first();
        return $getdata->status;
    }
     
     
}
