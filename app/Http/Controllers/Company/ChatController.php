<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Users;
use App\Model\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Chat;
use Illuminate\Support\Facades\Auth;
use App\Model\Company;
use App\Model\Notification;
use App\Model\NotificationMaster;
//use App\Model\Users;
use App\Model\UserNotificationType;
use App\Model\SendSMS;

class ChatController extends Controller{
    
    public function index(){
        
        $data['header'] = array(
            'title' => 'Chat',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Chat view' => 'Chat view'));
        $data['funinit'] = array('Chat.init()');
        $data['js'] = array('company/chat.js');
        
        return view('company.chat.chat',$data);
    }
    
    public function ajaxAction(Request $request){
        
        $action = $request->input('action');
        switch($action){
            case 'fetch_user':
                $userData = Auth::guard('company')->user();
                $getAuthCompanyId = Company::where('email', $userData->email)->first();
                $logeduserId = $getAuthCompanyId->user_id;
                $chatObj = new chat();
                $user_fetch = $chatObj->fetch_user($logeduserId);
                return $user_fetch;
                break;
            case 'search_user_list':
                $userData = Auth::guard('company')->user();
                $getAuthCompanyId = Company::where('email', $userData->email)->first();
                $logeduserId = $getAuthCompanyId->user_id;
                $chatObj = new chat();
                $user_fetch = $chatObj->search_user_list($logeduserId,$request->input('search_name'));
                return $user_fetch;
                break;
            case 'update_last_activity':
                $updateActivity = new chat();
                $last_active = $updateActivity->update_last_activity();
                return json_encode($last_active);
                break;
            case 'insert_chat':
                $userData = Auth::guard('company')->user();
                $getAuthCompanyId = Company::where('email', $userData->email)->first();
                
                $logeduserId = $getAuthCompanyId->user_id;

                $insertChat = new chat();
                $insertData = $insertChat->insert_chat($logeduserId,$request);

                $notificationMasterId=20;
                $objNotificationMaster = new NotificationMaster();
                $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatusNew($logeduserId,$notificationMasterId);
                
                if($NotificationUserStatus->status==1 )
                {
                    
                        $objUserNotificationType = new UserNotificationType();
                        $result = $objUserNotificationType->checkMessage($NotificationUserStatus->id);
                        
                        if($result[0]['status'] == 1){
//                            SMS  Notification
                            $notificationMasterId=1;
                            $msg= "Chat in  New Message.";
                            $objSendSms = new SendSMS();
                            $sendSMS = $objSendSms->sendSmsNotificaationNew($notificationMasterId,$request->input('to_user_id'),$msg);
                        }
                        
                        if($result[1]['status'] == 1){
//                            EMAIL Notification
                            $notificationMasterId=1;
                            $msg= "Chat in  New Message.";
                            $objSendEmail = new Users();
                            $sendEmail = $objSendEmail->sendEmailNotificationNew($notificationMasterId,$request->input('to_user_id'),$msg);
                        }
                        
                        if($result[2]['status'] == 1){
//                            chat Notification
                        }
                        
                        if($result[3]['status'] == 1){
                        //notification add
                        $objNotification = new Notification();
                        $objEmployee = new Employee();
                        $chatMessage="Chat in  New Message.";

                        $route_url="employee-chat";
                        $ret = $objNotification->addNotification($request->input('to_user_id'),$chatMessage,$route_url,$notificationMasterId);
                
                        }
                    }

                $user_fetch = $insertChat->fetchUserLastMessage($logeduserId,$request->input('to_user_id'));
                return $user_fetch;
                // return json_encode($insertData);
                break;
            case 'user-message-list':
                $userData = Auth::guard('company')->user();
                $getAuthCompanyId = Company::where('email', $userData->email)->first();
                $logeduserId = $getAuthCompanyId->user_id;
                $chatObj = new chat();
                $user_fetch = $chatObj->fetchUserMessageList($logeduserId,$request->input('to_user_id'));
                return $user_fetch;
                break;
            case '':
        }
        
    }
    
}

