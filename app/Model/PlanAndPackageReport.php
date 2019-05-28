<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\PlanAndPackageReport;
use App\Model\Company;
use App\Model\Users;
use Config;

class PlanAndPackageReport extends Model {

    protected $table = 'plan_and_package_report';
    
    public function getPlanAndPackageReportData(){
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'plan_and_package_report.num_of_report',
            1 => 'plan_and_package_report.downloaded_report_subscription',
            2 => 'plan_and_package_report.download_date',
        );

        $query = PlanAndPackageReport::from('plan_and_package_report');
        if (!empty($requestData['search']['value'])) {
            // if there is a search parameter, $requestData['search']['value'] contains search parameter
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
       // print_r($requestData);exit;
        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                           ->take($requestData['length'])
                           ->select('plan_and_package_report.*')->get();
        
        $data = array();
       
        foreach ($resultArr as $row) {
            $nestedData = [];
            $nestedData[] = $row["num_of_report"];
            $nestedData[] = $row["downloaded_report_subscription"];            
            $nestedData[]    = date('d-m-Y',strtotime($row["download_date"]));
            $nestedData[] = '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm planAndPackageDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
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
}
