<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use Config;

class Leave extends Model {

    protected $table = 'leaves';

    public function addnewleave($request) {
        $objLeave = new Leave();
        $objLeave->start_date = date('Y-m-d',strtotime($request->input('start_date')));
        $objLeave->end_date = date('Y-m-d',strtotime($request->input('end_date')));
        $objLeave->reason = $request->input('reason');
        $objLeave->created_at = date('Y-m-d H:i:s');
        $objLeave->updated_at = date('Y-m-d H:i:s');
        $objLeave->save();

        return TRUE;
    }
    public function editleave($request) {
        $objLeave = Leave::find($request->input('editId'));
        $objLeave->start_date = date('Y-m-d',strtotime($request->input('start_date')));
        $objLeave->end_date = date('Y-m-d',strtotime($request->input('end_date')));
        $objLeave->reason = $request->input('reason');
        $objLeave->created_at = date('Y-m-d H:i:s');
        $objLeave->updated_at = date('Y-m-d H:i:s');
        $objLeave->save();

        return TRUE;
    }
    

    public function getLeaveDatatable($request) {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'lv.id',
            1 => 'lv.start_date',
            2 => 'lv.end_date',
            3 => 'lv.reason',
        );
        $query = Leave::from('leaves as lv');

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
           ->select('lv.id', 'lv.start_date','lv.end_date', 'lv.reason')->get();
        $data = array();
   
        foreach ($resultArr as $row) {
           $actionHtml = $request->input('gender');
           $actionHtml .= '<a href="' . route('edit-leave', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm leaveDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["id"];
            $nestedData[] = date('d-m-Y',strtotime($row["start_date"]));
            $nestedData[] = date('d-m-Y',strtotime($row["end_date"]));
            $nestedData[] = $row["reason"];
            
            $nestedData[] = $actionHtml;
            $data[] = $nestedData;
        }
       // echo "<pre>";print_r($data);exit;

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        return $json_data;
    }
}
