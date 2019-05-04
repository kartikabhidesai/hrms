<?php

namespace App\Model;

use config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Doctrine\DBAL\Driver\SQLSrv\LastInsertId;
use App\Model\Users;
use App\Model\Chat;

class Chat extends Model{
    protected $table = 'chat_message';
    public function fetch_user($id){
       $result = DB::table('users')->where('id','!=',$id)->get();
       return $result;
    }
    
    public function update_last_activity(){
        $result = DB::table('login_details')->where('id','=',$id)->update('last_active','=', now());
        return $result;
    }
    
    public function insert_chat($from_user_id,$request){
        $insertChat = new chat();
        $insertChat->to_user_id = $request->input('to_user_id');
        $insertChat->from_user_id = $from_user_id;
        $insertChat->chat_message = $request->input('message');
        return ($insertChat->save());
    }
    
    public function fetchUserMessageList($fromUser,$toUser){
        $result = Chat::select('chat_message.*', 'users.name', 'users.user_image')
                    ->join('users', 'chat_message.from_user_id', '=', 'users.id')
                    ->where([['chat_message.to_user_id','=',$toUser],['chat_message.from_user_id','=',$fromUser]])
                    ->orWhere([['chat_message.from_user_id','=',$toUser],['chat_message.to_user_id','=',$fromUser]])->orderBy('chat_message.created_at', 'DESC')->get();
        return $result;
     }

     public function fetchUserLastMessage($fromUser,$toUser){
        $result = Chat::select('chat_message.*', 'users.name', 'users.user_image')
                    ->join('users', 'chat_message.from_user_id', '=', 'users.id')
                    ->where([['chat_message.to_user_id','=',$toUser],['chat_message.from_user_id','=',$fromUser]])
                    ->orWhere([['chat_message.from_user_id','=',$toUser],['chat_message.to_user_id','=',$fromUser]])->orderBy('chat_message.created_at', 'DESC')->first();
        return $result;
     }
 
}

