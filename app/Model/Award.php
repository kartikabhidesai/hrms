<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Users;
use App\Model\Award;
use Config;

class Award extends Model {

    protected $table = 'award';

    public function addAwardData($request, $logedcompanyId) {

        $file_attachment = '';
        if(isset($request->file_attachment) && !empty($request->file_attachment))
        {
            $file_attachment = 'award_attachment' . time() . '.' . $request->file_attachment->getClientOriginalName();
            $destinationPath = public_path('/uploads/award_attachment/');
            $request->file_attachment->move($destinationPath, $file_attachment);
        }
        
        $objAward = new Award();
        $objAward->company_id = $logedcompanyId;
        $objAward->employee_id = $request->input('employee');
        $objAward->department = $request->input('department');
        $objAward->award = $request->input('award');
        $objAward->date = date("Y-m-d", strtotime($request->input('date')));
        $objAward->comment = $request->input('comment');
        $objAward->file_attachment = $file_attachment==''?'':$file_attachment;

        return ($objAward->save());
    }

    public function getAwardList($request, $id) {
        $requestData = $_REQUEST;

        $columns = array('emp_name','award.award','award.date','award.comment');

        $query = Award::from('award')->join('employee','award.employee_id','employee.id');

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

        if(Auth::guard('company')->check()) 
        {
            $query->where('award.company_id', $id);
        }
        else
        {
            $query->where('award.employee_id', $id);
        }

        $resultArr = $query->skip($requestData['start'])
                ->take($requestData['length'])
                ->select('award.*','employee.name as emp_name')
                ->get();

        $totalData = count($resultArr);
        $totalFiltered = count($resultArr);

        $data = array();

        foreach ($resultArr as $row) {
            $nestedData = array();
            $actionHtml = '';

            if(Auth::guard('company')->check()) 
            {
                $actionHtml .= '<a href="#awardDetailsModel" data-toggle="modal" data-id="'.$row['id'].'" title="Details" class="link-black text-sm awardDetails" data-toggle="tooltip" data-original-title="Show"><i class="fa fa-eye"></i></a>';
                $actionHtml .= '<a href="' . route('award-edit', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';

                $nestedData[] = $row["emp_name"];
            }
            else
            {
                $actionHtml .= '<a href="#awardDetailsModel" data-toggle="modal" data-id="'.$row['id'].'" title="Details" class="link-black text-sm awardDetails" data-toggle="tooltip" data-original-title="Show"><i class="fa fa-eye"></i></a>';
            }
            
            $nestedData[] = '$'.$row["award"];
            $nestedData[] = date("d-m-Y", strtotime($row["date"]));
            $nestedData[] = $row["comment"];
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

    public function editAward($request,$id) {
    
        // print_r($request->input());
        // exit;

        $file_attachment = '';
        if(isset($request->file_attachment) && !empty($request->file_attachment))
        {
            $file_attachment = 'award_attachment' . time() . '.' . $request->file_attachment->getClientOriginalName();
            $destinationPath = public_path('/uploads/award_attachment/');
            $request->file_attachment->move($destinationPath, $file_attachment);
        }

        $findAward = Award::where('id', $id)->update(['employee_id' => $request->employee,
                                                        'department' => $request->department,
                                                        'award' => $request->award,
                                                        'date' => date("Y-m-d", strtotime($request->date)),
                                                        'comment' => $request->comment,
                                                        'file_attachment' => $file_attachment==''?'':$file_attachment,
                                                        'updated_at' => date('Y-m-d H:i:s')]);
        // var_dump($findAward); exit();

        if($findAward){
            return TRUE;
        }else{
            return FALSE;
        }
    }

}
