<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\Company;
use Config;
use Session;

class Notification extends Model {

    protected $table = 'notification';

    public function addNotification($user_id,$message,$route,$notificationMasterId) {

        $objNotification = new Notification();
        $objNotification->user_id = $user_id;
        $objNotification->notification_master_id = $notificationMasterId;
        $objNotification->message =  $message;
        $objNotification->route =  $route;
        $objNotification->created_at = date('Y-m-d H:i:s');
        $objNotification->updated_at = date('Y-m-d H:i:s');
        $objNotification->save();

        return TRUE;
    }

    public function getNotificationDatatable($userid) {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'nf.id',
            1 => 'nf.message',
            2 => 'nf.created_at',
        );
        $query = Notification::from('notification as nf')
                        ->where('nf.user_id',$userid);
        if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $searchVal = $requestData['search']['value'];
            $query->where(function($query) use ($columns, $searchVal, $requestData) {
                   $flag = 0;
                   foreach ($columns as $key => $value) {
                  $searchVal = $requestData['search']['value'];
                  if ($requestData['columns'][$key]['searchable'] == 'true') {
                      if ($flag == 0) {
                          $query->where($value, 'like', '%' . $searchVal . '%');
                          $flag = $flag + 1;
                      } else {
                          $query->orWhere($value, 'like', '%' . $searchVal . '%');
                      }
                  }
                   }
               });
        }

        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                    ->take($requestData['length'])
                    ->select('nf.id','nf.route', 'nf.message','nf.created_at')->get();
        $data = array();

        $objTypeOfRequest = new TypeOfRequest();
        $type_of_request = $objTypeOfRequest->getTypeOfRequestV2($userid);
        // $type_of_request=Config::get('constants.type_of_request');
     

        foreach ($resultArr as $row) {
//           $actionHtml = $request->input('gender');
        //    $actionHtml = '<a href="' . route('edit-notification', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            $actionHtml = '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm notificationDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] =$row["id"];
            $nestedData[] ='<a style="color:black" href="'.route($row["route"]).'">'.$row["message"].'</a>';
            $nestedData[] = date('d-m-Y',strtotime($row["created_at"]));
           
            
            // $nestedData[] = $actionHtml;
            $data[] = $nestedData;
        }
       // echo "<pre>";print_r($data);exit;

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        return $json_data;
    }


    public function editNotificationStatus($request) {

        $objNotification = Notification::find($request->input('user_id'));
        $objNotification->status =  $request->input('status');
        $objNotification->updated_at = date('Y-m-d H:i:s');
        $objNotification->save();

        return TRUE;
    }

    public function zeroNotificationCount($user_id,$notificationID) {
        // $notificationid=$this->getNotificationList($user_id);

        $objNotification = Notification::find($notificationID);
        // print_r($objNotification);
        // exit;
                $objNotification->status =  1;
                $objNotification->updated_at = date('Y-m-d H:i:s');
                $objNotification->save();

        // foreach($notificationid as $nid)
        // {
        //     $objNotification = Notification::find($nid['id']);
        //         $objNotification->status =  1;
        //         $objNotification->updated_at = date('Y-m-d H:i:s');
        //         $objNotification->save();
        // }

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
                ->select('notification.id','notification.message','notification.route','notification.created_at')
                ->orderBy('id','DESC')
                ->get()->toArray();
        // $data = array();
        
        return $query;
    }

    public function getNotificationCount($userid) {
       
        $query = Notification::where('notification.user_id',$userid)
                                    ->where('notification.status',0)
                                    ->get()
                                    ->count();
        return $query;
    }

    public function SessionNotificationCount($user_id) {
        $countNotification = $this->getNotificationCount($user_id);
        $notificationList = $this->getNotificationList($user_id);
        $items[0]['notification_list']=$notificationList;
        $items[0]['notification_count']=$countNotification;
        return $items;
    }

    public function getEmployeeNotificationList($userid) {
        $query = DB::table('notification_master as nm')
                ->select(array('nm.id','nm.notification_name','nm.description'))
                ->where('nm.key',$type)
                ->get();
        return $query;
    }
    
    public function UpdateNotification($userId){
        $objNotification= DB::table('notification')
                ->where('user_id',$userId)
                ->where('status',0)
                ->update(['status' => 1,
                          'updated_at' => date('Y-m-d H:i:s')]);
    }
}
