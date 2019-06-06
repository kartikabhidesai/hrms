<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\Users;
use App\Model\Company;
use Config;

class CompanyReport extends Model {

    protected $table = 'company_report';

    public function addClientReport() {

        $objCompanyReport = new CompanyReport();
        return ($objCompanyReport->save());
    }

    public function getCompanyReportData($request) {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'order_report.num_of_report',
            1 => 'order_report.downloaded_report_timeperiod',
            2 => 'order_report.download_date',
        );

        $columns = array('id','status','company_report_number','created_at');

        $query = CompanyReport::select('company_report.*');

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

        $resultArr = $query->skip($requestData['start'])
                ->take($requestData['length'])
                ->get();

        $totalData = count($resultArr);
        $totalFiltered = count($resultArr);

        $data = array();

        foreach ($resultArr as $row) {
            $nestedData = array();
            $actionHtml = '';

            $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm companyReportDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            // $actionHtml .= '<a href="#" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            
            $nestedData[] = $row["company_report_number"];
            $nestedData[] = $row["status"];
            $nestedData[] = date("d-m-Y", strtotime($row["created_at"]));
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

    public function getCompanyPdfData($request) {

        // echo "<pre>"; print_r($request->toArray()); exit();
        $company_report_data = [];

        $sql = Company::select('comapnies.*');
        if (!empty($request->status) && $request->status != 'All') 
        {
            $sql->where('status',$request->status);
        }
        $company_report_data = $sql->get()->toArray();
        // echo "<pre>aaa"; print_r($company_report_data); exit();
        return $company_report_data;
    }
}
