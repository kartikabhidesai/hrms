<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Chat;
// use Illuminate\Support\Facades\Auth;
use App\Model\Company;
use App\User;
use App\Model\Users;
use Auth;
use Route;
use APP;



class ChatController extends Controller{

    public function __construct() {
        // parent::__construct();
        $this->middleware('admin');
    }
    
    public function index(){
        
        $data['header'] = array(
            'title' => 'Chat',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Chat view' => 'Chat view'));
        $data['js'] = array('admin/chat.js');
        $data['funinit'] = array('Chat.init()');
        return view('admin.chat.chat',$data);
    }
    
    public function ajaxAction(Request $request){
        
        $action = $request->input('action');
        switch($action){
            case 'fetch_user':
                $userData = Auth::guard('admin')->user();
                $getAuthAdminId = User::where('email', $userData->email)->first();
                $logeduserId = $getAuthAdminId->id;
                $chatObj = new chat();
                $user_fetch = $chatObj->fetch_user($logeduserId);
                return $user_fetch;
                break;
            case 'search_user_list':
                $userData = Auth::guard('admin')->user();
                $getAuthAdminId = User::where('email', $userData->email)->first();
                $logeduserId = $getAuthAdminId->id;
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
                $userData = Auth::guard('admin')->user();
                $getAuthAdminId = User::where('email', $userData->email)->first();
                $logeduserId = 1;
                $insertChat = new chat();
                $insertData = $insertChat->insert_chat($logeduserId,$request);
                $user_fetch = $insertChat->fetchUserLastMessage($logeduserId,$request->input('to_user_id'));
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

