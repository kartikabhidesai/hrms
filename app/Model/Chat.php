<?php

namespace App\Model;

use config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Doctrine\DBAL\Driver\SQLSrv\LastInsertId;
use App\Model\Employee;
use App\Model\Users;
use App\Model\Chat;
use App\Model\Company;
class Chat extends Model{
    protected $table = 'chat_message';
    public function fetch_user_new($id){
        $emp_id= Employee::select("company_id")
                         ->where('user_id',$id)
                         ->get();
        
        $companyId = $emp_id[0]->company_id ;
        
//        $user_id= Company::select("user_id")
//                         ->where('id',$companyId)
//                         ->get();
//       
//        $result = DB::table('users')
//                ->join('comapnies', 'users.id', '=', 'comapnies.user_id')
//                ->join('employee', 'comapnies.id', '=', 'employee.company_id')
//                ->where('users.id','!=',$id)
//                ->where("comapnies.id",$companyId)
//                ->whereIn("users.id",$user_id)
//                ->get();
//            return $result;
       $comapnies = DB::table('users')
                    ->join('comapnies', 'users.id', '=', 'comapnies.user_id')
//                    ->join('employee', 'comapnies.id', '=', 'employee.company_id')
                    ->where("comapnies.id",$companyId)
                    ->where("users.type","!=","ADMIN")
                    ->where('users.id','!=',$id)
                    ->select("users.*")
                    ->get()->toarray();
       
       
       $employee = DB::table('users')
                    ->join('employee', 'users.id', '=', 'employee.user_id')
                    ->where("employee.company_id",$companyId)
                    ->where("users.type","!=","ADMIN")
                    ->where('users.id','!=',$id)
                    ->select("users.*")
                    ->get()->toarray();
       if($comapnies){
           array_push($employee,$comapnies[0]);
       }
       
        return  $employee ;
    
    }
    public function fetch_user($id){
        $emp_id= Company::select("id")
                        ->where('user_id',$id)
                        ->get();
        
        $companyId = $emp_id[0]->id ;
        
       $result = DB::table('users')
                ->join('employee', 'users.id', '=', 'employee.user_id')
                ->where('users.id','!=',$id)
                ->where('employee.company_id',$companyId)
                ->where('users.type', '!=','COMPANY')
                ->get()->toarray();
       
        $admin = DB::table('users')
                ->where('id','!=',$id)
                ->where('type','ADMIN')
                ->get()->toarray();
        array_push($result,$admin[0]);
       return $result;
    }
    public function fetch_user_admin($id){
        
       $result = DB::table('users')
                ->where('id','!=',$id)
                ->where('type','COMPANY')
                ->get();
       return $result;
       
    }
    
     public function search_user_listnew($id,$search_name){
         $emp_id= Company::select("id")
                        ->where('user_id',$id)
                        ->get();
        
        $companyId = $emp_id[0]->id ;
        
       $result = DB::table('users')
                ->join('employee', 'users.id', '=', 'employee.user_id')
                ->where('users.id','!=',$id)
                ->where('users.name','like','%'.$search_name.'%')
                ->where('employee.company_id',$companyId)
                ->where('users.type', '!=','COMPANY')
                ->get()->toarray();
       
        $admin = DB::table('users')
                ->where('id','!=',$id)
                ->where('name','like','%'.$search_name.'%')
                ->where('type','ADMIN')
                ->get()->toarray();

        if($admin){
             array_push($result,$admin[0]);
        }
       
       return $result;
     
    }

    public function search_user_list($id,$search_name){
        $result = DB::table('users')
                ->where('id','!=',$id)
                ->where('name','like','%'.$search_name.'%')
                ->where("users.type","!=","ADMIN")
                ->get();
        return $result;
    }
    public function search_user_list_emp($id,$search_name){
         $emp_id= Employee::select("company_id")
                         ->where('user_id',$id)
                         ->get();
        
        $companyId = $emp_id[0]->company_id ;
        
       $comapnies = DB::table('users')
                    ->join('comapnies', 'users.id', '=', 'comapnies.user_id')
//                    ->join('employee', 'comapnies.id', '=', 'employee.company_id')
                    ->where('users.name','like','%'.$search_name.'%')
                    ->where("comapnies.id",$companyId)
                    ->where("users.type","!=","ADMIN")
                    ->where('users.id','!=',$id)
                    ->select("users.*")
                    ->get()->toarray();
       
       
       $employee = DB::table('users')
                    ->join('employee', 'users.id', '=', 'employee.user_id')
                    ->where("employee.company_id",$companyId)
                    ->where('users.name','like','%'.$search_name.'%')
                    ->where("users.type","!=","ADMIN")
                    ->where('users.id','!=',$id)
                    ->select("users.*")
                    ->get()->toarray();
       if($comapnies){
           array_push($employee,$comapnies[0]);
       }
        
        return  $employee ;
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

