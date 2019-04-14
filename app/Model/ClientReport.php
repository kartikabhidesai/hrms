<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\Users;
use App\Model\CLientReport;
use App\Model\Client;
use Config;

class ClientReport extends Model {

    protected $table = 'client_report';

    public function addClientReport() {

        $objCLientReport = new CLientReport();
        return ($objCLientReport->save());
    }

    public function getClientReportList($request) {
        $requestData = $_REQUEST;

        $columns = array('id','created_at');

        $query = CLientReport::select('client_report.*');

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

            $actionHtml .= '<a href="#" data-toggle="modal" data-id="'.$row['id'].'" title="Details" class="link-black text-sm" data-toggle="tooltip" data-original-title="Show"><i class="fa fa-eye"></i></a>';
            $actionHtml .= '<a href="#" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            
            $nestedData[] = $row["id"];
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

    public function getClientReportListPDF($request,$id) {

        $client_report_data = [];
        $todayDate = date('Y-m-d');
         $startDate = '';
            $endDate = '';
            $currentDate = date('Y-m-d');
            if($request->time_period == 'custom'){
                $startDate = date('Y-m-d', strtotime($request->date_period));
                $endDate = date('Y-m-d');
            }else if($request->time_period == '3-months'){
                $startDate = date('Y-m-d', strtotime("-3 months", strtotime($currentDate)));
                $endDate = date('Y-m-d');
            }else if($request->time_period == '6-months'){
                $startDate = date('Y-m-d', strtotime("-6 months", strtotime($currentDate)));
                $endDate = date('Y-m-d');
            }else if($request->time_period  == '1-year'){
                $startDate = date('Y-m-d', strtotime("-12 months", strtotime($currentDate)));
                $endDate = date('Y-m-d');
            }elseif ($request->time_period == 'all') {
                
            }

            $sql = Client::select('client.*');
            if (!empty($startDate) && !empty($endDate)) 
            {
                $sql->Where(function($sql) use($startDate, $endDate) {
                    $sql->orWhere(function($sql) use($startDate, $endDate) {
                        $sql->whereBetween('client.date_of_joining', [$startDate, $endDate]);
                        // $sql->whereBetween('client.date_of_joining', [$startDate, $endDate]);
                    });
                });
            }
            
            $sql->where('company_id',$id);
            $client_report_data = $sql->get()->toArray();

        return $client_report_data;
        // echo "<pre>aaa"; print_r($client_report_data->toArray()); exit();
    }
    
    public function getClientReportListPDFV2($request,$id) {

        $client_report_data = [];
        $todayDate = date('Y-m-d');
        if(isset($request->time_period) && !empty($request->time_period) && $request->date_period == '')
        {
            $emp_time = explode('-',$request->time_period);
                
            $newtimeYear = date("Y",strtotime("-".$emp_time[0]." ".$emp_time[1]));
            $newtimeMonth = date("m",strtotime("-".$emp_time[0]." ".$emp_time[1]));
            $todayDay = date('d');

            $newDate = $newtimeYear.'-'.$newtimeMonth.'-'.$todayDay; 
            // echo $todayDate; echo $newDate; exit();

            $client_report_data = Client::select('client.*')
                                    // ->whereBetween('date_of_joining',[$todayDate,$newDate])
                                    ->where('company_id',$id)
                                    ->get()->toArray();;
        }
        elseif (isset($request->date_period) && $request->date_period != '') 
        {
            $client_report_data = Client::select('client.*')
                                    // ->whereBetween('date_of_joining',[$todayDate,date('Y-m-d',strtotime($request->date_period))])
                                    ->where('company_id',$id)
                                    ->get()->toArray();

        }
        else
        {

        }

        return $client_report_data;
        // echo "<pre>aaa"; print_r($client_report_data->toArray()); exit();
    }

}
