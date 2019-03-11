<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Users;
use App\Model\Recruitment;
use App\Model\Department;
use PDF;
use Config;
use File;

class Recruitment extends Model
{
    protected $table = 'recruitment';

    public function addRecruitment ($request,$companyId)
    {  
        // print_r($request);exit;
    	$newRecruitment = new Recruitment();
    	$newRecruitment->company_id = $companyId;
    	$newRecruitment->task = $request->task;
    	$newRecruitment->department_id = $request->department;
        $newRecruitment->responsibility = $request->responsibility;
        $newRecruitment->requirement = $request->requirement;
        $newRecruitment->experience_level = $request->experience_level;
        $newRecruitment->jobtime = $request->jobtime;
        $newRecruitment->contract = $request->contract;
    	$newRecruitment->salary = $request->salary;
    	$newRecruitment->email = $request->email;
        $newRecruitment->conatact_us = $request->conatact_us;
        $newRecruitment->start_date = date('Y-m-d', strtotime($request->start_date));
    	$newRecruitment->expire_date =  date('Y-m-d', strtotime($request->expire_date));
    	$newRecruitment->job_id = $request->job_id;
        $newRecruitment->save();
        
        if($newRecruitment) {
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }
    
    public function getRecruitment()
    {
        $userData = Auth::guard('company')->user();
        $getAuthCompanyId = Company::where('email', $userData->email)->first();

        $arrRecruitment = Recruitment::
                            // where('company_id', $company_id)
                            where('company_id', $getAuthCompanyId->id)
                            ->pluck('department_name', 'id')
                            ->toArray();
                
        return $arrRecruitment;
    }

    public function getdatatable()
    {
        $requestData = $_REQUEST;
        $userData = Auth::guard('company')->user();
        $companyId = Company::where('email', $userData->email)->first();
        $columns = array(
            // datatable column index  => database column name
            0 => 'recruitment.id',
            1 => 'recruitment.task',
            2 => 'recruitment.responsibility',
            
        );
        $query = Recruitment::from('recruitment')->where('company_id', $companyId->id);
        // $query = Recruitment::with(['department'])->where('company_id', $companyId->id); /*using eloquent relationship*/
        // ->groupBy('designation.department_id');
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
                            ->select('recruitment.id', 'recruitment.task','recruitment.department_id','recruitment.responsibility','recruitment.requirement','recruitment.experience_level','recruitment.jobtime','recruitment.contract','recruitment.salary','recruitment.email','recruitment.start_date','recruitment.expire_date','recruitment.job_id','recruitment.status')
                            ->get();

        $data = array();
        foreach ($resultArr as $row) {
            $actionHtml ='';
            $actionHtml .= '<a href="' . route('recruitment-edit', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm recruitmentDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row['id'];
            $nestedData[] = $row["task"];
            $nestedData[] = $row["responsibility"];
            if($row["experience_level"] == 0) {
                $nestedData[] = 'High';
            } else if($row["experience_level"] == 1) {
                $nestedData[] = 'Medium';
            } else {
                $nestedData[] = 'Low';
            }
            $nestedData[] = $row["start_date"]." - ".$row["expire_date"];
            $nestedData[] = $actionHtml;
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        return $json_data;
    }

    /*Relationship for designation*/
    public function designation()
    {
        return $this->hasMany('App\Model\Designation');
    }

    public function editRecruitment($request,$id,$companyId)
    {
        // print_r($companyId);
            // $id = $request->input('editId');

            $objRecruitment = Recruitment::from('recruitment')->where('id', $id)->where('company_id', $companyId)->first();
            $objRecruitment->task = $request->task;
            $objRecruitment->department_id = $request->department;
            $objRecruitment->responsibility = $request->responsibility;
            $objRecruitment->requirement = $request->requirement;
            $objRecruitment->experience_level = $request->experience_level;
            $objRecruitment->jobtime = $request->jobtime;
            $objRecruitment->contract = $request->contract;
            $objRecruitment->salary = $request->salary;
            $objRecruitment->email = $request->email;
            $objRecruitment->conatact_us = $request->conatact_us;
            $objRecruitment->start_date = date('Y-m-d', strtotime($request->start_date));
            $objRecruitment->expire_date =  date('Y-m-d', strtotime($request->expire_date));
            $objRecruitment->job_id = $request->job_id;
            $objRecruitment->updated_at = date('Y-m-d H:i:s');
            $objRecruitment->save();
            
        return TRUE;
    }

    public function getRecruitmentByCompany($company_id)
    {
        $arrRecruitment = Recruitment::where('company_id', $company_id)
                            ->pluck('department_name', 'id')
                            ->toArray();
        // print_r($arrRecruitment);exit;
        return $arrRecruitment;
    }

}
