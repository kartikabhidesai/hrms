<?php

namespace App\Model;

use config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Doctrine\DBAL\Driver\SQLSrv\LastInsertId;

class Chat extends Model{
    
    public function fetch_user($logeduserId){
       $result = DB::table('users')->where('id',"!=",$logeduserId)->get();
       return $result;
    }
    
    public function update_last_activity(){
        $result = DB::table('login_details')->where('id','=',$id)->update('last_active','=', now());
        return $result;
    }
    
    public function insert_chat($request){
        $insertChat = new chat();
        $insertchat->to_user_id = $request->input('to_user_id');
        $insertchat->from_user_id = $request->input('from_user_id');
        $insertchat->chat_message = $request->input('chat_message');
        $insertChat->save();
    }
    
 
}

