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
        $userData = Auth::guard('company')->user();
        $data['userid'] = $userData->id;
       
        if(isset($_COOKIE['company_chatuserid'])){
           
            $data['chat'] = "yes";
            $objChatHistory =  new Chat();
            $data['chatdetails'] = $objChatHistory->gethistroy($userData->id,$_COOKIE['company_chatuserid']);
           
        }else{
            $data['chat'] = "no";
            $data['chatdetails'] = '';
        }
        $data['header'] = array(
            'title' => 'Chat',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Chat view' => 'Chat view'));
        $data['funinit'] = array('Chat.init()');
        $data['js'] = array('company/chat.js');
        
        return view('company.chat.chat',$data);
    }
    
    public function indexnew(Request $request,$userId){
        
        $data['header'] = array(
            'title' => 'Chat',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Chat view' => 'Chat view'));
        $data['funinit'] = array('Chat.initdefultopen('.$userId.')');
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
                $user_fetch = $chatObj->search_user_listnew($logeduserId,$request->input('search_name'));
                
                return $user_fetch;
                break;
            case 'update_last_activity':
                $updateActivity = new chat();
                $last_active = $updateActivity->update_last_activity();
                return json_encode($last_active);
                break;
            case 'setuserid':
                setcookie("company_chatuserid", $request->input('to_user_id'), time() + (86400 * 30),  "/","");
                setcookie("company_chatusername", $request->input('to_user_name'), time() + (86400 * 30),  "/","");
                
            case 'autorefresh':
                    if(isset($_COOKIE['company_chatuserid'])){
                        $userData = Auth::guard('company')->user();
                        $sendid = $userData->id;
                        $reciverid = $_COOKIE['company_chatuserid'];
                        $objChatHistory =  new Chat();
                        $data['chatdetails'] = $objChatHistory->gethistroy($sendid,$reciverid);
                        $data['reciverid'] = $reciverid;
                        return json_encode($data);
                        break;
                    }else{
                        return "false";
                        break;
                    }
                
            case 'insert_chat':
//                print_r($request->input());
//                exit;
                $reciveid = $request->input('to_user_id');
//                Employee::select('user_id')->where('id',$request->input('to_user_id'))->get();
                
                $userData = Auth::guard('company')->user();
                $getAuthCompanyId = Company::where('email', $userData->email)->first();
                
                $logeduserId = $getAuthCompanyId->user_id;

                $insertChat = new chat();
                $insertData = $insertChat->insert_chat($logeduserId,$request);
                
                $notificationMasterId=20;
                $objNotificationMaster = new NotificationMaster();
                $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatusNew($logeduserId,"5");
                
                if($NotificationUserStatus->status==1 )
                {
                  
                        $objUserNotificationType = new UserNotificationType();
                        $result = $objUserNotificationType->checkMessage($NotificationUserStatus->id);
                             
                        if($result[0]['status'] == 1){
                           
//                            SMS  Notification
                            $notificationMasterId=20;
                            $msg= "Chat in  New Message.";
                            $objSendSms = new SendSMS();
                            $sendSMS = $objSendSms->sendSmsNotificaationNew($notificationMasterId,$reciveid,$msg);
                        }
                        
                        if($result[1]['status'] == 1){
                         
//                            EMAIL Notification
                            $notificationMasterId=20;
                            $msg= "Chat in  New Message.";
                            $objSendEmail = new Users();
                            $sendEmail = $objSendEmail->sendEmailNotificationNew($notificationMasterId,$reciveid,$msg);
                        }
                        
                        if($result[2]['status'] == 1){
//                            chat Notification
                        }
                        
                        if($result[3]['status'] == 1){
                            
                            $userData = Auth::guard('company')->user();
                            $getAuthCompanyId = Company::where('email', $userData->email)->first();
                            $logeduserId = $getAuthCompanyId->user_id;
                            $objUser =  new Users();
                            $result = $objUser->getUserType($reciveid);
                            if($result == "ADMIN"){
                                $route_url='admin-chat' ;
                            }
                            
                            if($result == "EMPLOYEE"){
                                $route_url=strtolower($result)."/employee-chatnew/".$logeduserId ;
                            }
                            
                            if($result == "COMPANY"){
                                $route_url=strtolower($result)."/chatnew/".$logeduserId ;
                            }
                        //notification add
                            $objNotification = new Notification();
                            $objEmployee = new Employee();
                            $chatMessage="Chat in  New Message.";
                            $ret = $objNotification->addNotification($reciveid,$chatMessage,$route_url,$notificationMasterId);
                        }
                    }

                $user_fetch = $insertChat->fetchUserLastMessage($logeduserId,$reciveid);
               
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
        }
        
    }
    
}

