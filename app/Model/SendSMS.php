<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Model\UserHasPermission;
use Config;

class SendSMS extends Model
{
    protected $table = 'send_sms';

    protected $fillable = ['id', 'emp_id', 'company_id', 'message'];

    public function getSMSDatatable($request, $companyId) {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'employee_name',
            2 => 'message'
        );
        $query = SendSMS::from('send_sms');

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
                        ->where('company_id', $companyId)
                        ->select('id', 'emp_id', 'message')->get();
        $data = array();

        foreach ($resultArr as $row) {
            $actionHtml = $request->input('gender');
            $nestedData = array();
            $nestedData[] = $row["id"];
            $nestedData[] = $row["employee_name"];
            $nestedData[] = $row["message"];

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
