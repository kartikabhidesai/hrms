<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Payment;
use Config;

class Payment extends Model {

    protected $table = 'payment';

    // public function createPayment($request){

        //   $newPayment=new Payment();
        //   $newPayment->name=$request->input('name');
        //   $newPayment->status=$request->input('status');
        //   $newPayment->created_at = date('Y-m-d H:i:s');
        //   $newPayment->updated_at = date('Y-m-d H:i:s');
        //   return $newPayment->save();
    // }
    
    public function getPaymentData(){
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'payment.id',
            1 => 'payment.name',
            2 => 'payment.status',
        );

        $query = Payment::from('payment');
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
                           ->select('payment.id', 'payment.name', 'payment.status','payment.created_at','payment.updated_at')->get();
       
        $data = array();
       
        foreach ($resultArr as $row) {
            
            if($row["status"] == '1'){
                $actionHtml = '<span class="label label-success">Enabled</span>';
            }else{
                $actionHtml = '<span class="label label-danger">Disable</span>';
            }
            
            if($row["status"] == '1'){
                $action = '<a href="#disableModel" data-toggle="modal" data-id="'.$row['id'].'"  title="Disable" class="btn btn-danger link-black text-sm disable" data-toggle="tooltip" data-original-title="Enable" ><i class="fa fa-close"></i></a>';
            }else{
                $action = '<a href="#enableModel" data-toggle="modal" data-id="'.$row['id'].'" title="Enable" class="btn btn-success link-black text-sm enable" data-toggle="tooltip" data-original-title="Enable" ><i class="fa fa-check"></i></a>';
            }

            $nestedData = array();
            $nestedData[] = $row["id"];
            $nestedData[] = $row["name"];
            $nestedData[] = $actionHtml;
            $nestedData[] = $action;
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
    

    public function enableRequest($id){
        $objSavedata=Payment::where('id',$id)->update(['status'=>'1','updated_at'=>date('Y-m-d H:i:s')]);
       return ($objSavedata);
    }
    
    public function disableRequest($id){
        $objSavedata=Payment::where('id',$id)->update(['status'=>'0','updated_at'=>date('Y-m-d H:i:s')]);
        return ($objSavedata);
    }
}
