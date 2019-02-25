<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Order;
use Config;

class Order extends Model {

    protected $table = 'order';

    public function createOrder($request){

          $newOrder=new Order();
          $newOrder->company_name=$request->input('company_name');
          $newOrder->subcription=$request->input('subcription');
          $newOrder->request_type=$request->input('request_type');
          $newOrder->payment_type=$request->input('payment_type');
          $newOrder->status=0;
          $newOrder->created_at = date('Y-m-d H:i:s');
          $newOrder->updated_at = date('Y-m-d H:i:s');
          return $newOrder->save();
    }
    
    public function getOrderData(){
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'order.id',
            1 => 'order.company_name',
            2 => 'order.subcription',
            3 => 'order.request_type',
            4=> 'order.payment_type',
            5=>'order.status',
        );

        $query = Order::from('order');
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
                           ->select('order.id', 'order.company_name', 'order.subcription', 'order.request_type', 'order.payment_type','order.status','order.created_at')->get();
       
        $subcription =Config::get('constants.subcription');
        $request_type =Config::get('constants.request_type');
        $payment_type =Config::get('constants.payment_type');
        
        $data = array();
       
        foreach ($resultArr as $row) {
            if($row["status"] == 0){
                $statusHtml='<span class="label label-warning ">Pending</span>';
            }
            if($row["status"] == 1){
                $statusHtml='<span class="label label-success ">Accept</span>';
            }
            
            if($row["status"] == 2){
                $statusHtml='<span class="label label-danger ">Reject</span>';
            }
            
            $actionHtml = '';
//            $actionHtml .= '<a href="' . route('edit-company', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
//            $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm CompanyDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
//            
            $nestedData = array();
            $nestedData[] = $row["id"];
            $nestedData[] = $row["company_name"];
            $nestedData[] = date('d-m-Y',strtotime($row["created_at"]));
            $nestedData[] = $subcription[$row["subcription"]];
            $nestedData[] = $request_type[$row["request_type"]];
            $nestedData[] = $payment_type[$row["payment_type"]];
            $nestedData[] = $statusHtml;
//            $nestedData[] = date('d-m-Y',strtotime($row["expiry_at"]));
            $nestedData[] = $actionHtml;
            $data[] = $nestedData;
        }
       //echo "<pre>";print_r($data);exit;

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        
        

        return $json_data;
    }
}
