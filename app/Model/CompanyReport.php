<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\OrderReport;
use App\Model\Company;
use App\Model\Users;
use Config;

class CompanyReport extends Model {

    protected $table = 'company_report';
    
    public function getCompanyReportData(){
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'company_report.company_report_number',
            1 => 'company_report.status',
            2 => 'company_report.download_date',
        );

        $query = OrderReport::from('company_report');
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
                           ->select('company_report.*')->get();
        
        $data = array();
       
        foreach ($resultArr as $row) {
            $nestedData = [];
            $nestedData[] = $row["company_report_number"];
            $nestedData[] = $row["status"];            
            $nestedData[]    = date('d-m-Y',strtotime($row["download_date"]));
            $nestedData[] = '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm companyReportDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
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

    public function addCompanyReport($request)
    {
        $insert = DB::table('company_report')->insertGetId(['status'=>$request->status,'download_date' =>date('Y-m-d'),'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);

        $numlength = strlen((string)$insert);
        $append_letter = 7 - $numlength;
        $str = '';
        for($i=0;$i<=$append_letter;$i++)
        {
            $str.='0';
        }
        $update = DB::table('company_report')->where('id',$insert)->update(['company_report_number' =>$str.$insert]);
        if($update){
            return true;
        }else{
            return false;
        }
    }

    public function getCompanyPdfData($request)
    {
        if(strtolower(@$request->status)=='all' || @$request->status=='')
        {
            $res = Company::get()->toArray();
        }   
        else
        {
            $res = Company::where('status',$request->status)->get()->toArray();
        }

        return $res;
    }   
}
