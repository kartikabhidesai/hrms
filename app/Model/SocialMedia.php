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
use App\Http\Controllers\TokenController;

class SocialMedia extends Model
{
    protected $table = 'social_media';

    public function addSocialMedia($request)
    {
      $post_to = '';
        if($request->post_to) 
        {
            $post_to = implode(',',$request->post_to); 
        }

        $id = DB::table('social_media')->insertGetId(['user_id'=>1,'accounts' => $post_to,
                                            'message' => $request->input('message'),
                                            'deliver_to' => $request->input('delivery_option'),
                                            'deliver_date' => $request->input('delivery_date') != null ? date('Y-m-d', strtotime($request->input('delivery_date'))) : date('Y-m-d'),
                                            'deliver_time' => $request->input('delivery_time') != null ? date('H:i:s', strtotime($request->input('delivery_time'))) : date('H:i:s'), 
                                            'status'=> 'pending',//$request->input('delivery_time') != null && $request->input('delivery_time') != null ? 'pending' : 'posted',
                                            'created_at' => date('Y-m-d H:i:s'),
                                            'updated_at' => date('Y-m-d H:i:s')]);

        if (!file_exists(public_path('/uploads/social_media'))) {
            mkdir(public_path('/uploads/social_media'),'0777',false);
        }

        if(isset($request->file_upload) && !empty($request->file_upload) && !empty($request->file_upload[0]) )
        {
            foreach ($request->file_upload as $key => $value){
                // $image = $request->file($value);
                $file_attachment = 'file_upload' . time() . '.' . $value->getClientOriginalName();
                $destinationPath = public_path('/uploads/social_media/');
                $value->move($destinationPath, $file_attachment);

                $file_attachment = DB::table('social_media_files')->insertGetId(
                                                ['social_media_id' => $id,
                                                'file_name' => $file_attachment,
                                                'created_at' => date('Y-m-d H:i:s'),
                                                'updated_at' => date('Y-m-d H:i:s')
                                                ]
                                            );
            }
        }
        if($request->input('delivery_time')==''){
            $obj=new TokenController();
            foreach ($request->post_to as $pst){
                if($pst=='facebook')
                    $obj->fbShare(1,$id);
                elseif($pst=='twitter')
                    $obj->twShare(1,$id);
            }
        }

        return TRUE;
    }

    public function getdatatable($request)
    {
        $requestData = $_REQUEST;

        $data = $request->input('data');

        $query = SocialMedia::select('social_media.*');

        $columns = array(
            // datatable column index  => database column name
            'social_media.message',
            'social_media.status',
            'social_media.deliver_date',
            'social_media.deliver_time'
        );

        
        if (!empty($requestData['search']['value'])) {
            $searchVal = $requestData['search']['value'];
            $query->where(function($query) use ($columns, $searchVal, $requestData) {
                $flag = 0;
                foreach ($columns as $key => $value) {
                    $searchVal = $requestData['search']['value'];
                    if ($requestData['columns'][$key]['searchable'] == 'true') {
                        if ($flag == 0) {
                            $query->where($value, 'like', '%' . $searchVal . '%');
                            $flag = $flag + 1;
                        } else {
                            $query->orWhere($value, 'like', '%' . $searchVal . '%');
                        }
                    }
                }
            });
        }
        
        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());
        $resultArr = $query->skip($requestData['start'])
                            ->take($requestData['length'])
                            ->get();

        $data = array();
        foreach ($resultArr as $row) {
            $actionHtml ='';
            $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm SocialMediaDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["message"];
            $nestedData[] = $row["status"];
            $nestedData[] = $row["deliver_date"];
            $nestedData[] = $row["deliver_time"];
            $nestedData[] = $actionHtml;
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        return $json_data;
    }
	
	function getPost($post_id,$user_id){
		$post=SocialMedia::join('social_media_files as smf','smf.social_media_id','=','social_media.id')
							->where(['social_media.id'=>$post_id,'user_id'=>$user_id])
							->first(['social_media.id as sm_id','user_id','accounts','message','smf.file_name']);
							
		return $post;				
	}
	

    public function getEmpviewTicketStatus($ticketId,$Empid) {
        // echo $ticketId."-".$Empid;
        $result = Ticket::select('code', 'subject', 'status', 'priority','details', 'complete_progress','id')->where('assign_to', $Empid)->where('id', $ticketId)->first();
        return $result;
    }
}
