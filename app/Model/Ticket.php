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

class Ticket extends Model
{
    protected $table = 'tickets';
    // protected $fillable = ['title'];

    public function saveTicket($request)
    {    
       
    	if(Auth::guard('company')->check()) {
    		$userData = Auth::guard('company')->user();
    		$getAuthCompanyId = Company::where('email', $userData->email)->first();

            $id = DB::table('tickets')->insertGetId(['code' => $request->input('ticket_code'),
                    'subject' => $request->input('subject'),
                    'status' => 'New',
                    'priority' => $request->input('priority'),
                    'assign_to' => $request->input('assign_to'),
                    'due_date' => date('Y-m-d', strtotime($request->input('due_date'))),
                    'details' => $request->input('details'),
                    'manager_name' => $request->input('manager'),
                    'department_id' => $request->input('department'),
                    'company_id' => $getAuthCompanyId->id,
                    'created_by'=>'COMPANY',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')]);
    	}else{
            $userData = Auth::guard('employee')->user();
            $empData = Employee::select('employee.*')->where('user_id',$userData->id)->first();
            // echo "<pre>"; print_r($userData->id); print_r($empData->id); exit();
            $id = DB::table('tickets')->insertGetId(['code' => $request->input('ticket_code'),
                    'subject' => $request->input('subject'),
                    'status' => 'New',
                    'priority' => $request->input('priority'),
                    'assign_to' => $empData->id,
                    'due_date' => date('Y-m-d', strtotime($request->input('due_date'))),
                    'details' => $request->input('details'),
                    'company_id' => $empData->company_id,
                    'created_by'=>'EMPLOYEE',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')]);
        }

        if (!file_exists(public_path('/uploads/ticket_attachment'))) {
            mkdir(public_path('/uploads/ticket_attachment'),'0777',false);
        }

        if(isset($request->ticket_attachment) && !empty($request->ticket_attachment))
        {
            foreach ($request->ticket_attachment as $key => $value){
                // $image = $request->file($value);
                $file_attachment = 'ticket_attachment' . time() . '.' . $value->getClientOriginalName();
                $destinationPath = public_path('/uploads/ticket_attachment/');
                $value->move($destinationPath, $file_attachment);

                $file_attachment = DB::table('ticket_attachments')->insertGetId(
                                                ['ticket_id' => $id,
                                                'file_attachment' => $file_attachment,
                                                'created_at' => date('Y-m-d H:i:s'),
                                                'updated_at' => date('Y-m-d H:i:s')
                                                ]
                                            );

            }
        }
        return TRUE;
    }
    
    public function getDepartment()
    {
        $userData = Auth::guard('company')->user();
        $getAuthCompanyId = Company::where('email', $userData->email)->first();

        $arrDepartment = Department::
                            // where('company_id', $company_id)
                            where('company_id', $getAuthCompanyId->id)
                            ->pluck('department_name', 'id')
                            ->toArray();
                
        return $arrDepartment;
    }

    public function getdatatable($request)
    {
        $requestData = $_REQUEST;

        $data = $request->input('data');

        if ($data['priority'] != NULL) {
            $priority = $data['priority'];
        } else {
            $priority = "";
        }

        /* Don't remove this code as it's in-progress */
        if($data['status'] != NULL) {
            $status = $data['status'];
        } else {
            $status = "";
        }

        if(Auth::guard('company')->check()) 
        {
            $userData = Auth::guard('company')->user();
            $companyId = Company::where('email', $userData->email)->first();
            $query = Ticket::join('department','department.id','tickets.department_id')
                            ->join('employee','employee.id','tickets.assign_to')
                            ->join('comapnies','comapnies.id','tickets.company_id')
                            ->with(['ticketAttachments'])
                            ->where('tickets.company_id', $companyId->id)
                            ->select('tickets.*','employee.name as emp_name','department.department_name as departmentName' , 'comapnies.company_name');
        }
        else
        {
            $userData = Auth::guard('employee')->user();
            $empData = Employee::select('employee.*')->where('user_id',$userData->id)->first();
            $query = Ticket::join('department','department.id','tickets.department_id')
                            ->join('employee','employee.id','tickets.assign_to')
                            ->join('comapnies','comapnies.id','tickets.company_id')
                            ->with(['ticketAttachments'])
                            ->where('tickets.assign_to', $empData->id)
                            ->select('tickets.*','employee.name as emp_name','department.department_name as departmentName' ,'comapnies.company_name');
        }

        if ($priority) {
            $query->where('tickets.priority', "=", $priority);
        }

        /* Don't remove this code as it's in-progress */
        // if($status){
        //     $query->where('tickets.status', "=", $status);
        // }

        $columns = array(
            // datatable column index  => database column name
            'tickets.code',
            'tickets.priority',
            'tickets.status',
            'tickets.subject',
            // 'tickets.assign_to',
            'tickets.created_by',
            'department.department_name',
            'tickets.manager_name',
            'tickets.details',
            // 'tickets.updated_by',
            // 'ticket_attachments.file_attachment'
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

        if(Auth::guard('company')->check()){
            $loginuser = 'company';
        }else{
            $loginuser = 'employee';
        }
        
        $data = array();
        foreach ($resultArr as $row) {
            $actionHtml ='';
            // $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm deleteDepartment" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["code"];
            $nestedData[] = $row["priority"];
            $nestedData[] = $row["status"];
            $nestedData[] = $row["subject"];

            if($loginuser == 'company'){
                $nestedData[] = $row["emp_name"];
            }else{
                
            }
            $nestedData[] = $row["created_by"];
            $nestedData[] = $row["departmentName"];
            $nestedData[] = $row["manager_name"];
            $nestedData[] = $row["details"];
            $fileAttachmentArr = [];

            foreach ($row->ticketAttachments as $key => $value) {
                // $fileAttachmentArr[] = $value["file_attachment"];
                $fileAttachmentArr[] = '<a href="'.'download-attachment/'.$value["file_attachment"].'" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" >'.$value["file_attachment"].'</a>';
            }

            $nestedData[] = implode(', ', $fileAttachmentArr);

            if($loginuser == 'company'){
                $actionHtml = '<a href="#ticketDetailsModel" data-toggle="modal" data-id="'.$row['id'].'" title="Details" class="link-black text-sm ticketDetails" data-toggle="tooltip" data-original-title="Show"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                $actionHtml .='<a href="ticket-comments/'.$row['id'].'" class="link-black text-sm" data-id="'.$row['id'].'" data-toggle="tooltip" data-original-title="View Details"> <i class="fa fa-comments"></i></a>';
            }else{
                $actionHtml = '<a href="#ticketDetailsModel" data-toggle="modal" data-id="'.$row['id'].'" title="Details" class="link-black text-sm ticketDetails" data-toggle="tooltip" data-original-title="Show"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                // $actionHtml .= '<a href="#ticketEditModel" data-toggle="modal" data-id="' . $row['id'] . '" class="link-black text-sm ticketEdit" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-edit"></i></a>';   
                $actionHtml .='<a href="ticket-comments/'.$row['id'].'" class="link-black text-sm" data-id="'.$row['id'].'" data-toggle="tooltip" data-original-title="View Details"> <i class="fa fa-comments"></i></a>';
                $actionHtml .= '<a href="#updateTicketStatusModel"  data-toggle="modal" data-id="' . $row['id'] . '" title="Update" class="link-black text-sm updateTicketStatusModel" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';   
                                
            }

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
    
    public function getdatatableCompany($request)
    {
        $requestData = $_REQUEST;

        $data = $request->input('data');

        if ($data['priority'] != NULL) {
            $priority = $data['priority'];
        } else {
            $priority = "";
        }

        /* Don't remove this code as it's in-progress */
        if($data['status'] != NULL) {
            $status = $data['status'];
        } else {
            $status = "";
        }
        
        
        if(Auth::guard('employee')->check()) 
        {
            $userData = Auth::guard('employee')->user();
            
            $companyId = Employee::select('*')->where('user_id', $userData['id'])->get();
            $userID = Company::select('user_id')->where('id', $companyId[0]['company_id'])->get();
//            print_r($companyId);
//            exit;
            $company_Id = $companyId[0]['company_id'];
//            print_r($userData['id']);
//            die();
//            $companyId = Company::where('email', $companyId[0]['email'])->first();
            $query = Ticket::join('employee','employee.id','tickets.assign_to')
                            ->join('comapnies','comapnies.id','tickets.company_id')
                            ->with(['ticketAttachments'])->where('tickets.company_id', $company_Id)
                            ->select('tickets.*','employee.name as emp_name', 'comapnies.company_name');
        }
        if ($priority) {
            $query->where('tickets.priority', "=", $priority);
        }
        $columns = array(
            // datatable column index  => database column name
            'tickets.code',
            'tickets.priority',
            'tickets.status',
            'tickets.subject',
            // 'tickets.assign_to',
            'tickets.created_by',
            'tickets.details',
            // 'tickets.updated_by',
            // 'ticket_attachments.file_attachment'
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

        if(Auth::guard('company')->check()){
            $loginuser = 'company';
        }else{
            $loginuser = 'employee';
        }
       
        $data = array();
        foreach ($resultArr as $row) {
            $actionHtml ='';
            // $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm deleteDepartment" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["code"];
            $nestedData[] = $row["priority"];
            $nestedData[] = $row["status"];
            $nestedData[] = $row["subject"];

            if($loginuser == 'company'){
                $nestedData[] = $row["emp_name"];
            }else{
                $nestedData[] = $row["emp_name"];
            }
            
            $nestedData[] = $row["created_by"];
            $nestedData[] = $row["details"];
            $fileAttachmentArr = [];

            foreach ($row->ticketAttachments as $key => $value) {
                // $fileAttachmentArr[] = $value["file_attachment"];
                $fileAttachmentArr[] = '<a href="'.'download-attachment/'.$value["file_attachment"].'" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" >'.$value["file_attachment"].'</a>';
            }

            $nestedData[] = implode(', ', $fileAttachmentArr);

            if($loginuser == 'company'){
                $actionHtml = '<a href="#ticketDetailsModel" data-toggle="modal" data-id="'.$row['id'].'" title="Details" class="link-black text-sm ticketDetails" data-toggle="tooltip" data-original-title="Show"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                $actionHtml .='<a href="ticket-comments/'.$row['id'].'" class="link-black text-sm" data-id="'.$row['id'].'" data-toggle="tooltip" data-original-title="View Details"> <i class="fa fa-comments"></i></a>';
            }else{
                
                if($loginuser == 'employee'){
                    $actionHtml = '<a href="#ticketDetailsModel" data-toggle="modal" data-id="'.$row['id'].'" title="Details" class="link-black text-sm ticketDetails" data-toggle="tooltip" data-original-title="Show"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                    $actionHtml .='<a href="employee-ticket-comments/'.$row['id'].'" class="link-black text-sm" data-id="'.$row['id'].'" data-toggle="tooltip" data-original-title="View Details"> <i class="fa fa-comments"></i></a>';
                }else{
                    $actionHtml = '<a href="#ticketDetailsModel" data-toggle="modal" data-id="'.$row['id'].'" title="Details" class="link-black text-sm ticketDetails" data-toggle="tooltip" data-original-title="Show"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                    // $actionHtml .= '<a href="#ticketEditModel" data-toggle="modal" data-id="' . $row['id'] . '" class="link-black text-sm ticketEdit" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-edit"></i></a>';   
                    $actionHtml .='<a href="employee-ticket-comments/'.$row['id'].'" class="link-black text-sm" data-id="'.$row['id'].'" data-toggle="tooltip" data-original-title="View Details"> <i class="fa fa-comments"></i></a>';
                    $actionHtml .= '<a href="#updateTicketStatusModel"  data-toggle="modal" data-id="' . $row['id'] . '" title="Update" class="link-black text-sm updateTicketStatusModel" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';   
                }               
            }

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
    
    public function getEmpviewTicketStatus($ticketId,$Empid) {
        // echo $ticketId."-".$Empid;
        $result = Ticket::select('code', 'subject', 'status', 'priority','details', 'complete_progress','id')->where('assign_to', $Empid)->where('id', $ticketId)->first();
        return $result;
    }

    public function updateTicketStatusEmp($request, $empid) {
        // echo $request->ticket_id;
        // exit;
        $objTicket = Ticket::firstOrNew(array('assign_to' => $empid,'id'=>$request->ticket_id));        
        $objTicket->complete_progress = $request->complete_progress;
        $objTicket->status = $request->status;
        $objTicket->save();
        if ($objTicket) {
            return TRUE;
        } else {
            return false;
        }
    }

    public function ticketAttachments()
    {
        return $this->hasMany('App\Model\TicketAttachments');
    }

    public function getTicketNotComplitedList() {
        $dates=date('Y-m-d');
        $result = Ticket::select('subject','company_id','id')->where('due_date', $dates)->where('status','!=', '2')->get()->toArray();
        return $result;
    }

    /*public function getNewTaskCount($company_id,$status)
    {
        $statusCount = Ticket::where('company_id', $company_id)
                            ->count();
        return $statusCount;
    }

    public function getInprogressTaskCount($company_id,$status)
    {
        $statusCount = Ticket::where('company_id', $company_id)
                            ->where('status', 'inoprogress')
                            ->count();
        return $statusCount;
    }

    public function getCompletedTaskCount($company_id,$status)
    {
        $statusCount = Ticket::where('company_id', $company_id)
                            ->where('status', 'completed')
                            ->count();
        return $statusCount;
    }*/
}
