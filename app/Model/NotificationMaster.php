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
       
        $NotificationMaster=DB::table('notification_master')->get();
        foreach($NotificationMaster as $row)
        {
            DB::table('user_notification')->insert(
                ['company_id' => $userdata->id,'notification_master_id'=> $row->id]
            );
        }
        $userNotification=DB::table('user_notification')
                            ->select('id')
                            ->where(["company_id" => $userdata->id])
                            ->get();
                    
        foreach($userNotification as $row)
        {
           
            for($i=1; $i<=4; $i++){
                 DB::table('user_notification_type')->insert(
                        ['user_notification_id' => $row->id,
                         'user_notification_type'=> $i,
                         'status'=>'0',
                         "created_at" => date('Y-m-d H:i:s'),
                         "updated_at" => date('Y-m-d H:i:s')
                        ]
                    );
            }
        }
        
        return TRUE;
    }

    public function getEmployeeNotificationList($userid) {
        $query =DB::table('user_notification as un')
//                    ->join('user_notification_type as unt', 'un.id', '=', 'unt.user_notification_id')
                    ->join('notification_master as nm', 'nm.id', '=', 'un.notification_master_id')
                    ->where('un.company_id',$userid)
                    ->select(array('un.id','nm.notification_name','nm.description','un.status'))
                    ->get();
        // $data = array();
        for($i = 0 ; $i<count($query); $i++ ){
            $array_query =DB::table('user_notification as un')
                        ->join('user_notification_type as untype', 'un.id', '=', 'untype.user_notification_id')
                        ->join('notification_master as nm', 'nm.id', '=', 'un.notification_master_id')
                        ->groupBy('untype.user_notification_type')
                        ->where('untype.user_notification_id',$query[$i]->id)
                        ->select(array('untype.status'))
                        ->get();
//            print_r();
                $temp = [];        
                foreach ($array_query AS $row){
                    array_push($temp, $row->status);
                }
            $query[$i]->type=$temp;
            
        }
        
        return $query;
    }

    public function onOffUserNotificationStatus($id,$status){
//        print_r($id);
//        exit();
        $objSavedata=DB::table('user_notification')
                    ->where('id',$id)
                    ->update(['status'=>$status]);
        return ($objSavedata);
     }

    public function checkNotificationUserStatus($userid,$notification_master_id){
        $getdata=DB::table('user_notification')
                    ->where('company_id',$userid)
                    ->where('notification_master_id',$notification_master_id)
                    ->select('*')
                    ->first();
        
        return @$getdata->status;
    }
    
     public function checkNotificationUserStatusNew($userid,$notification_master_id){
        $getdata=DB::table('user_notification')
                    ->where('company_id',$userid)
                    ->where('notification_master_id',$notification_master_id)
                    ->select('*')
                    ->first();
        
        return $getdata;
    }
    
    public function changeType($request){
        $data=$request->input('data');
        
        $objSavedata=DB::table('user_notification_type')
                            ->where('user_notification_type',$data['notificationValue'])
                            ->where('user_notification_id',$data['userNotificationId'])
                            ->update(['status'=>$data['checkBox']]);
        return ($objSavedata);
    }
     
}
