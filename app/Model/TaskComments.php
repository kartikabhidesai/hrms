<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\TaskComments;
use PDF;
use Config;

class TaskComments extends Model {
    protected $table = 'task_comments';
   
    public function addComments($request){
        if(Auth::guard('company')->check()) {
            $userData = Auth::guard('company')->user();
            $getAuthCompanyId = Company::where('email', $userData->email)->first();
           
            $id = DB::table('task_comments')->insertGetId(['user_id' => $getAuthCompanyId->user_id,
                                                'task_id' => $request->input('task_id'),
                                                'comments'=> $request->input('comments'),
                                                'created_at' => date('Y-m-d H:i:s'),
                                                'updated_at' => date('Y-m-d H:i:s')]);
        }else{
            $userData = Auth::guard('employee')->user();
            $empData = Employee::select('employee.*')->where('user_id',$userData->id)->first();
            $id = DB::table('task_comments')->insertGetId(['user_id' => $empData->user_id,
                                                        'task_id' => $request->input('task_id'),
                                                        'comments'=> $request->input('comments'),
                                                        'created_at' => date('Y-m-d H:i:s'),
                                                        'updated_at' => date('Y-m-d H:i:s')]);
        }
        return TRUE;
    }
    
    public function getTaskCommentDetails($id){
        $result = TaskComments::select("*")
                                ->where('task_id',$id)
                                ->get();
        return $result;
    
    }
}
