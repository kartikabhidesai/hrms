<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use auth;
use App\Model\UserHasPermission;
use App\Model\Users;
use App\Model\Client;

class Client extends Model {

    protected $table = 'client';

    public function addClientData($request, $logedcompanyId) {


        $objClient = new Client();
        $objClient->company_id = $logedcompanyId;
        $objClient->name = $request->input('name');
        $objClient->national_id = $request->input('national_id');
        $objClient->work = $request->input('work');
        $objClient->company = $request->input('comapany');
        $objClient->email = $request->input('email');
        $objClient->street = $request->input('street');
        $objClient->bank = $request->input('bank');
        $objClient->city = $request->input('city');
        $objClient->iban = $request->input('iban');
        $objClient->phone_number = $request->input('phone_number');
        $objClient->mobile_number = $request->input('mobile_number');
        $objClient->state = $request->input('state');
        $objClient->account_number = $request->input('account_number');
        $objClient->zipcode = $request->input('zipcode');
        $objClient->country = $request->input('country');
        $objClient->date_of_joining = date("Y-m-d", strtotime($request->input('date_of_joining')));

        return ($objClient->save());
    }

    public function getClientList($request, $companyId) {

        $requestData = $_REQUEST;

        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'name',
            2 => 'company',
            3 => 'mobile_number'
        );

        //$query = Announcement::;
        $query = Announcement::from('client');

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
                ->select('id', 'name', 'company', 'mobile_number')
                ->get();

        $data = array();

        foreach ($resultArr as $row) {
            $nestedData = array();
            $actionHtml = '';
            $actionHtml .= '<a href="' . route('client-edit', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="' . $row['id'] . '" class="link-black text-sm clientDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData[] = $row["name"];
            $nestedData[] = $row["company"];
            $nestedData[] = $row["mobile_number"];
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

    public function editClient($request, $id) {
        //print_r($request->input());
        //exit;
        $findAward = Client::where('id', $id)->update(['name' => $request->name,
            'national_id' => $request->national_id,
            'work'=>$request->work,
            'company'=>$request->comapany,
            'work'=>$request->work,
            'bank'=>$request->bank,
            'date_of_joining' => date("Y-m-d", strtotime($request->date_of_joining)),
            'iban' => $request->iban,
            'account_number' => $request->account_number,
            'phone_number' => $request->phone_number,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
            'country' => $request->country,
            'updated_at' => date('Y-m-d H:i:s')]);
        if ($findAward) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
