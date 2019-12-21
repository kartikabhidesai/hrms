<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Model\Chat;
use App\Model\Company;
use App\User;
use App\Model\SendSMS;
use App\Model\Notification;
use App\Model\Users;
use Auth;
use Route;
use APP;


class ChatController extends Controller{
    public function __construct() {
        $this->middleware('admin');
    }
    
    public function index(Request $request){
        $userData = Auth::guard('admin')->user();
        $data['userid'] = $userData->id;
       
        if(isset($_COOKIE['chatuserid'])){
            $data['chat'] = "yes";
            $objChatHistory =  new Chat();
            $data['chatdetails'] = $objChatHistory->gethistroy($userData->id,$_COOKIE['chatuserid']);
           
        }else{
            $data['chat'] = "no";
            $data['chatdetails'] = '';
        }
        $data['header'] = array(
            'title' => 'Chat',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Chat view' => 'Chat view'));
        $data['js'] = array('admin/chat.js');
        $data['funinit'] = array('Chat.init()');                   
        return view('admin.chat.chat',$data);
    }
    
    public function chatnew(Request $request,$id){
        
        $objUsers= new Users();
        $data['reciverdetails'] = $objUsers->getreciverdetails($id);
        
        
        $userData = Auth::guard('admin')->user();
        $data['userid'] = $userData->id;
        
        $data['chat'] = "no";
        $objChatHistory =  new Chat();
        $data['chatdetails'] = $objChatHistory->gethistroy($userData->id,$id);
            
            
        $data['header'] = array(
            'title' => 'Chat',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Chat view' => 'Chat view'));
        $data['js'] = array('admin/chat.js');
        $data['funinit'] = array('Chat.initnew('.$id.')');                   
        return view('admin.chat.chatnew',$data);
    }
    
    public function ajaxAction(Request $request){
        
        $action = $request->input('action');
        switch($action){
            
            case 'fetch_user':
                $userData = Auth::guard('admin')->user();
                $getAuthAdminId = User::where('email', $userData->email)->first();
                $logeduserId = $getAuthAdminId->id;
                $chatObj = new chat();
                $user_fetch = $chatObj->fetch_user_admin($logeduserId);
                return $user_fetch;
                break;
            case 'autorefresh':
                if(isset($_COOKIE['chatuserid'])){
                     $userData = Auth::guard('admin')->user();
                    $sendid = $userData->id;
                    $reciverid = $_COOKIE['chatuserid'];
                    $objChatHistory =  new Chat();
                    $data['chatdetails'] = $objChatHistory->gethistroy($sendid,$reciverid);
                    $data['reciverid'] = $reciverid;
                    return json_encode($data);
                    break;
                }else{
                    return "false";
                    break;
                }
            case 'autorefreshuser':
                $userData = Auth::guard('admin')->user();
                $sendid = $userData->id;
                $objChatHistory =  new Chat();
                $data['chatdetails'] = $objChatHistory->gethistroy($sendid,$request->input('to_user_id'));
                $data['reciverid'] = $request->input('to_user_id');
                return json_encode($data);
                break;
               
                
            case 'setuserid':
                setcookie("chatuserid", $request->input('to_user_id'), time() + (86400 * 30),  "/","");
                setcookie("chatusername", $request->input('to_user_name'), time() + (86400 * 30),  "/","");
            
            case 'search_user_list':
                $userData = Auth::guard('admin')->user();
                $getAuthAdminId = User::where('email', $userData->email)->first();
                $logeduserId = $getAuthAdminId->id;
                $chatObj = new chat();
                $user_fetch = $chatObj->search_user_listbyadmin($logeduserId,$request->input('search_name'));
                return $user_fetch;
                break;
            
            case 'update_last_activity':
                $updateActivity = new chat();
                $last_active = $updateActivity->update_last_activity();
                return json_encode($last_active);
                break;
            
            case 'insert_chat':                
                    $userData = Auth::guard('admin')->user();
                    $getAuthAdminId = User::where('email', $userData->email)->first();
                    $logeduserId = $userData->id;
                    $insertChat = new chat();
                    $insertData = $insertChat->insert_chat($logeduserId,$request);
                    $user_fetch = $insertChat->fetchUserLastMessage($logeduserId,$request->input('to_user_id'));
                
                    
                    $notificationMasterId=22;
                    $msg= "Chat in  New Message from ".$userData->name;
                    $objSendEmail = new Users();
                    $sendEmail = $objSendEmail->sendEmailNotificationNewByadmin($notificationMasterId,$request->input('to_user_id'),$msg,$request->input('message'));
                   
                    
                    $userData = Auth::guard('admin')->user();
                   
                    $logeduserId = $userData->id;
                    $objUser =  new Users();
                    $result = $objUser->getUserType($request->input('to_user_id'));
                    $route_url=strtolower($result)."/chatnew/".$logeduserId ;
                    
                    //notification add                    
                    $objNotification = new Notification();
                    $chatMessage= "Chat in  New Message from ".$userData->name;
                    $ret = $objNotification->addNotification($request->input('to_user_id'),$chatMessage,$route_url,$notificationMasterId);
                    
                    
                    
                return $user_fetch;
                // return json_encode($insertData);
                break;
            case 'user-message-list':
                $userData = Auth::guard('admin')->user();
                $getAuthAdminId = User::where('email', $userData->email)->first();
                $logeduserId = 1;
                $chatObj = new chat();
                $user_fetch = $chatObj->fetchUserMessageList($logeduserId,$request->input('to_user_id'));
                return $user_fetch;
                break;
            case '':
        }
        
    }
    
}

