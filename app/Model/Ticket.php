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

    public function saveTicket($request)
    {    
    	if(Auth::guard('company')->check()) {
    		$userData = Auth::guard('company')->user();
    		$getAuthCompanyId = Company::where('email', $userData->email)->first();
    	}

        // echo "<pre>qw"; print_r($request->ticket_attachment); exit();

        $id = DB::table('tickets')->insertGetId(
                                                ['code' => $request->input('ticket_code'),
                                                'subject' => $request->input('subject'),
                                                'priority' => $request->input('priority'),
                                                'assign_to' => $request->input('assign_to'),
                                                'details' => $request->input('details'),
                                                'company_id' => $getAuthCompanyId->id,
                                                'created_at' => date('Y-m-d H:i:s'),
                                                'updated_at' => date('Y-m-d H:i:s')
                                                ]
                                            );

        if (!file_exists(public_path('/uploads/ticket_attachment'))) {
            mkdir(public_path('/uploads/ticket_attachment'),'0777',false);
        }

        if(isset($request->ticket_attachment) && !empty($request->ticket_attachment))
        {
            foreach ($request->ticket_attachment as $key => $value){
                // $image = $request->file($value);
                $file_attachment = 'ticket_attachment' . time() . '.' . $value->getClientOriginalExtension();
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

    public function getdatatable()
    {
        $requestData = $_REQUEST;
        $userData = Auth::guard('company')->user();
        $companyId = Company::where('email', $userData->email)->first();
        $columns = array(
            // datatable column index  => database column name
            0 => 'tickets.code',
            1 => 'tickets.priority',
            2 => 'tickets.status',
            3 => 'tickets.subject',
            4 => 'tickets.assign_to',
            5 => 'tickets.created_by',
            6 => 'tickets.details',
            7 => 'tickets.updated_by',
            8 => 'tickets.file_attachment'
        );

        // $query = Department::join('designation', 'designation.department_id', '=', 'department.id');  /*using join*/
        $query = Ticket::join('employee','employee.id','tickets.assign_to')->with(['ticketAttachments'])->where('tickets.company_id', $companyId->id)->select('tickets.*','employee.name as emp_name'); /*using eloquent relationship*/
        if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
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
                            // ->select('department.id', 'department.department_name','designation_name')
                            ->get();

        // echo "<pre>"; print_r($resultArr); exit();

        $data = array();
        foreach ($resultArr as $row) {
            $actionHtml ='';
            // $actionHtml .= '<a href="' . route('department-edit', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            // $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm deleteDepartment" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["code"];
            $nestedData[] = $row["priority"];
            $nestedData[] = 'sss';
            $nestedData[] = $row["subject"];
            $nestedData[] = $row["emp_name"];
            $nestedData[] = $row["created_at"];
            $nestedData[] = $row["details"];
            $fileAttachmentArr = [];

            foreach ($row->ticketAttachments as $key => $value) {
                $fileAttachmentArr[] = $value["file_attachment"];
            }
            $nestedData[] = implode(', ', $fileAttachmentArr);
            // $nestedData[] = '1';
            // $nestedData[] = $actionHtml;
            $data[] = $nestedData;
        }

        // echo "<pre>"; print_r($nestedData); exit();

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        return $json_data;
    }

    /*Relationship for designation*/
    public function ticketAttachments()
    {
        return $this->hasMany('App\Model\TicketAttachments');
    }

    public function editDepartment($request)
    {
        $name = '';
        $id = $request->input('edit_id');

        if($request->input('designation') == null) {
        	return false;
        }
        /*find & update department*/
        $findDepartment = Department::where('id', $id)->update(['department_name' => $request->department_name, 'updated_at' => date('Y-m-d H:i:s')]);

        /*find & update designations*/
        $findDesignation = Designation::where('department_id', $id)->get();

        foreach($findDesignation as $designation) {
            $deleteDesignation = $designation->delete();
        }

        $designation = $request->input('designation');
        for($i=0;$i<count($request->input('designation'));$i++){
            $objDesignation = new Designation();
            if($designation[$i] != ""){
                $objDesignation->department_id = $id;
                $objDesignation->designation_name = $designation[$i];
                $objDesignation->created_at = date('Y-m-d H:i:s');
                $objDesignation->updated_at = date('Y-m-d H:i:s');
                $objDesignation->save();
            }
        }
        return TRUE;
    }

    public function getDepartmentByCompany($company_id)
    {
        $arrDepartment = Department::where('company_id', $company_id)
                            ->pluck('department_name', 'id')
                            ->toArray();
        // print_r($arrDepartment);exit;
        return $arrDepartment;
    }

}
