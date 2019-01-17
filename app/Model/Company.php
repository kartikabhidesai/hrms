<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Users;
use PDF;
use Config;
use File;

class Company extends Model
{
    protected $table = 'comapnies';

    public function addCompany($request) 
    {
        //Find unique company/user
        $findCompany = Company::where('email', $request->input('email'))->first();
        $findUser = Users::where('email', $request->input('email'))->first();
        
        if(!empty($findCompany || $findUser)) {
            return false;
        }
        $name = '';
        if($request->file()){
            $image = $request->file('company_image');
            $name = 'admin'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/admin/company');
            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, $mode = 0777, true, true);
            }
            $image->move($destinationPath, $name);    
        }
        

        /*create new user with email, pwd and type*/
        $newUser = new Users();
        $newUser->name = $request->input('company_name');
        $newUser->email = $request->input('email');
        $newUser->password = Hash::make($request->input('password'));
        $newUser->user_image = $name;
        $newUser->type = 'COMPANY';
        $newUser->created_at = date('Y-m-d H:i:s');
        $newUser->updated_at = date('Y-m-d H:i:s');
        $newUser->save();
        $userId = $newUser->id;

        $objCompany = new Company();
        $objCompany->company_name = $request->input('company_name');
        $objCompany->email = $request->input('email');
        $objCompany->user_id = $userId;
        $objCompany->password = Hash::make($request->input('password'));
        $objCompany->status = $request->input('status');
        $objCompany->subcription = $request->input('subcription');
        $objCompany->expiry_at = date('Y-m-d',strtotime($request->input('expiry_at')));
        $objCompany->company_image = $name;
        $objCompany->created_at = date('Y-m-d H:i:s');
        $objCompany->updated_at = date('Y-m-d H:i:s');
        $objCompany->save();

        return TRUE;
    }

    public function getCompanyData($request) 
    {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'ra.id',
            1 => 'ra.company_name',
            2 => 'ra.email',
            3 => 'ra.company_image',
            4=> 'ra.status',
            5=> 'ra.subcription',
            6=>'ra.expiry_at'
        );

        $query = Company::from('comapnies as ra');
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

       // print_r($requestData);exit;
        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                           ->take($requestData['length'])
                           ->select('ra.id', 'ra.company_name', 'ra.email', 'ra.company_image', 'ra.status','ra.subcription','ra.expiry_at')->get();
        $data = array();
        foreach ($resultArr as $row) {
           $actionHtml = '';
           $actionHtml .= '<a href="' . route('edit-company', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            $actionHtml .= '<a href="#deleteModel" data-toggle="modal" data-id="'.$row['id'].'" class="link-black text-sm CompanyDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';
            $nestedData = array();
            $nestedData[] = $row["id"];
            $nestedData[] = $row["company_name"];
            $nestedData[] = $row["email"];
            // $nestedData[] = '<img src="{{URL::asset("'.$row["company_image"].'")}}" alt="Company Pic" height="100" width="100">';
            $nestedData[] = $row["status"];
            $nestedData[] = $row["subcription"];
            $nestedData[] = date('d-m-Y',strtotime($row["expiry_at"]));
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
    
    public function editCompany($request)
    {
        //Find unique company/user
        $findCompany = Company::where('email', $request->input('email'))->first();
        $findUser = Users::where('email', $request->input('email'))->first();
        if($findCompany || $findUser) {
            $return['message'] = 'This email is already registerd!';
            return $return['message'];
        }
        $name = '';
        $objCompany = Company::find($request->input('edit_id'));
        /*find & update user with email, image*/
        $updateUser = Users::where('email', $objCompany->email)->first();
        $updateUser->name = $request->input('company_name');
        $updateUser->email = $request->input('email');
        if($request->input('password')) {
            $objCompany->password = Hash::make($request->input('password'));
        }
        $updateUser->user_image = $name;
        $updateUser->updated_at = date('Y-m-d H:i:s');
        $updateUser->save();

        if($request->file()) {
            $image = $request->file('company_image');
            $name = 'admin'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/admin/company');
            $image->move($destinationPath, $name);  

            $existImage = public_path('/uploads/admin/company/').$objCompany->company_image;
            if (File::exists($existImage)) { // unlink or remove previous company image from folder
                File::delete($existImage);
            }
        }
        
        $objCompany->company_name = $request->input('company_name');
        $objCompany->email = $request->input('email');
        if($request->input('password')) {
            $objCompany->password = Hash::make($request->input('password'));
        }
        $objCompany->status = $request->input('status');
        $objCompany->subcription = $request->input('subcription');
        $objCompany->expiry_at = date('Y-m-d',strtotime($request->input('expiry_at')));
        $objCompany->company_image = $name;
        $objCompany->updated_at = date('Y-m-d H:i:s');
        $objCompany->save();
        return TRUE;
    }
    
}
