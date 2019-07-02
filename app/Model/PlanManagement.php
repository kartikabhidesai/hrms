<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PlanManagement extends Model
{
    protected $table = 'plan_managent';
    protected $fillable  = ['code','duration','plan_feature','charge','title','expiration'];

    public function getPlanManageDatatable() 
    {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'code',
            2 => 'title',
            3 => 'charge',
            4 => 'duration',
            5 => 'expiration'
        );

        $query = PlanManagement::from('plan_managent');

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

        $query->skip($requestData['start'])
                ->take($requestData['length']);

        $resultArr = $query->select('plan_managent.*')->get();

        $data = array();

        foreach ($resultArr as $row) {

            $actionHtml = '<a href="' . url('admin/plan_management-edit/'.$row['id']).'" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>';
            $actionHtml .= '<a href="deletePlan" data-toggle="modal" data-id="' . $row['id'] . '" class="link-black text-sm plan_managementDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>';

            $nestedData = array();
            $nestedData[] = $row["code"];
            $nestedData[] = $row["title"];
            $nestedData[] = $row["charge"];
            $nestedData[] = $row["expiration"];
            $nestedData[] = $row["duration"];
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

    public function addPlan_Management($request) {
        
        $final_arr = [];
        if(isset($request->plan_feature_name) && !empty($request->plan_feature_name)) 
        {
            foreach ($request->plan_feature_name as $key => $value) 
            {
                isset($request->{$value}) ? $final_arr[$value]='true' : $final_arr[$value]='false';
            }
        }

        $plan_features = json_encode($final_arr);

        $objplanManagement = new PlanManagement();
        $objplanManagement->code = $request->input('code');
        $objplanManagement->title = $request->input('title');
        $objplanManagement->charge = $request->input('charge');
        $objplanManagement->duration = $request->input('duration');
        $objplanManagement->expiration = date("Y-m-d", strtotime($request->input('expiry_at')));
        $objplanManagement->plan_feature = $plan_features;

        return ($objplanManagement->save());
    }

    public function updatePlan_Management($request,$id) {
        
        $final_arr = [];
        if(isset($request->plan_feature_name) && !empty($request->plan_feature_name)) 
        {
            foreach ($request->plan_feature_name as $key => $value) 
            {
                isset($request->{$value}) ? $final_arr[$value]='true' : $final_arr[$value]='false';
            }
        }

        $plan_features = json_encode($final_arr);

        $objplanManagement = PlanManagement::find($id);
        $objplanManagement->code = $request->input('code');
        $objplanManagement->title = $request->input('title');
        $objplanManagement->charge = $request->input('charge');
        $objplanManagement->duration = $request->input('duration');
        $objplanManagement->expiration = date("Y-m-d", strtotime($request->input('expiry_at')));
        $objplanManagement->plan_feature = $plan_features;

        return ($objplanManagement->save());
    }

    public function editPlan_Management($id)
    {
        $plan_management = PlanManagement::select('plan_managent.*')->where('id',$id)->first();
        return $plan_management;
    }
    
    public function getPlans() 
    {
        $query = PlanManagement::from('plan_managent')->get();
        return $query;
    }
}
