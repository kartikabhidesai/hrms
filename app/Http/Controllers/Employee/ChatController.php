<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\chat;
use Illuminate\Support\Facades\Auth;
use App\Model\Company;
use App\Model\Employee;



class ChatController extends Controller{
    
    public function index(){
        
        $data['header'] = array(
            'title' => 'Chat',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Chat view' => 'Chat view'));
                $data['funinit'] = array('Chat.init()');
        $data['js'] = array('employee/chat.js');
        return view('employee.chat.chat',$data);
    }
    
    public function ajaxAction(Request $request){
        
        $action = $request->input('action');
        switch($action){
            case 'fetch_user':
                $userData = Auth::guard('employee')->user();
                $getAuthEmployeeId = Employee::where('email', $userData->email)->first();
                $logeduserId = $getAuthEmployeeId->user_id;
                $chatObj = new chat();
                $user_fetch = $chatObj->fetch_user($logeduserId);
                return $user_fetch;
                break;
            case 'update_last_activity':
                $updateActivity = new chat();
                $last_active = $updateActivity->update_last_activity();
                return json_encode($last_active);
                break;
            case 'insert_chat':
                $userData = Auth::guard('employee')->user();
                $getAuthEmployeeId = Employee::where('email', $userData->email)->first();
                $logeduserId = $getAuthEmployeeId->user_id;
                $insertChat = new chat();
                $insertData = $insertChat->insert_chat($logeduserId,$request);
                $user_fetch = $insertChat->fetchUserLastMessage($logeduserId,$request->input('to_user_id'));
                return $user_fetch;
                // return json_encode($insertData);
                break;
            case 'user-message-list':
                $userData = Auth::guard('employee')->user();
                $getAuthEmployeeId = Employee::where('email', $userData->email)->first();
                $logeduserId = $getAuthEmployeeId->user_id;
                $chatObj = new chat();
                $user_fetch = $chatObj->fetchUserMessageList($logeduserId,$request->input('to_user_id'));
                return $user_fetch;
                break;
            case '':
        }
        
    }
    
}

