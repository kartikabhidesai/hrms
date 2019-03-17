<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Ticket;
use App\Model\TicketAttahcments;
use PDF;
use Config;
use File;

class TicketComment extends Model
{
    protected $table = 'ticket_comments';

    public function saveTicketComment($request)
    {    
    	if(Auth::guard('company')->check()) {
    		$userData = Auth::guard('company')->user();
            $getAuthCompanyId = Company::where('email', $userData->email)->first();
            
            $id = DB::table('ticket_comments')->insertGetId(['user_id' => $getAuthCompanyId->user_id,
                                                'ticket_id' => $request->ticket_id,
                                                'comments'=> $request->comments,
                                                'created_at' => date('Y-m-d H:i:s'),
                                                'updated_at' => date('Y-m-d H:i:s')]);

    	}else{
            $userData = Auth::guard('employee')->user();
            $empData = Employee::select('employee.*')->where('user_id',$userData->id)->first();
            // echo "<pre>"; print_r($userData->id); print_r($empData); exit();
            $id = DB::table('ticket_comments')->insertGetId(['user_id' => $empData->user_id,
                                                            'ticket_id' => $request->ticket_id,
                                                            'comments'=> $request->comments,
                                                            'created_at' => date('Y-m-d H:i:s'),
                                                            'updated_at' => date('Y-m-d H:i:s')]);
        }

        return TRUE;
    }
    
    public function getTicketCommentDetails($ticket_id)
    {
        $arrTicketCommentList = TicketComment::join('users','users.id','=','ticket_comments.user_id')
                            ->where('ticket_comments.ticket_id', $ticket_id)
                            ->get(['ticket_comments.comments','ticket_comments.created_at','users.name','users.user_image as photo'])
                            ->toArray();
                
        return $arrTicketCommentList;
    }

    

    public function ticketAttachments()
    {
        return $this->hasMany('App\Model\TicketCommentAttachments');
    }

    /*public function getNewTaskCount($company_id,$status)
    {
        $statusCount = TicketComment::where('company_id', $company_id)
                            ->count();
        return $statusCount;
    }

    public function getInprogressTaskCount($company_id,$status)
    {
        $statusCount = TicketComment::where('company_id', $company_id)
                            ->where('status', 'inoprogress')
                            ->count();
        return $statusCount;
    }

    public function getCompletedTaskCount($company_id,$status)
    {
        $statusCount = TicketComment::where('company_id', $company_id)
                            ->where('status', 'completed')
                            ->count();
        return $statusCount;
    }*/
}
