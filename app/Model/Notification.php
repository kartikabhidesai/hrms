<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\Company;
use Config;

class Notification extends Model {

    protected $table = 'notification';

    public function addNotification($user_id,$message) {

        

        $objNotification = new Notification();
        $objNotification->user_id = $user_id;
        $objNotification->message =  $message;
        $objNotification->created_at = date('Y-m-d H:i:s');
        $objNotification->updated_at = date('Y-m-d H:i:s');
        $objNotification->save();

        return TRUE;
    }


    public function editNotificationStatus($request) {

        $objNotification = Notification::find($request->input('user_id'));
        $objNotification->status =  $request->input('status');
        $objNotification->updated_at = date('Y-m-d H:i:s');
        $objNotification->save();

        return TRUE;
    }

    public function zeroNotificationCount($user_id) {
        $notificationid=$this->getNotificationList($user_id);
        foreach($notificationid as $nid)
        {
            $objNotification = Notification::find($nid['id']);
                $objNotification->status =  1;
                $objNotification->updated_at = date('Y-m-d H:i:s');
                $objNotification->save();
        }

        // $objNotification = Notification::where('id', $user_id);
        // if (!empty($objNotification)) {
        //     $objNotification->status =  1;
        // $objNotification->updated_at = date('Y-m-d H:i:s');
        // $objNotification->save();
        // }

        return TRUE;
    }
    

    public function getNotificationList($userid) {
       
        $query = Notification::from('notification as notification')
                ->where('notification.user_id',$userid)
                ->where('notification.status',0)
                ->select('notification.id','notification.message','notification.created_at')->orderBy('id','DESC')
                ->get()->toArray();
        // $data = array();
        
        return $query;
    }

    public function getNotificationCount($userid) {
       
        $query = Notification::where('notification.user_id',$userid)->where('notification.status',0)->get()->count();
        return $query;
    }
}
