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

class Cmspage extends Model {
    protected $table = 'cms_page';
   
   
    public function editCmspage($request) {
        $objCmspage = Cmspage::find($request->input('edit_id'));
        $objCmspage->description = $request->input('cms_content');
        $objCmspage->updated_at = date('Y-m-d H:i:s');
        $objCmspage->save();
        return TRUE;
    }

    public function getSMSpageData($request) {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'ra.id',
            1 => 'ra.name',
            2 => 'ra.description'

        );

        $query = Cmspage::from('cms_page as ra');

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
                ->select('ra.id', 'ra.name', 'ra.description', 'ra.created_at', 'ra.updated_at')->get();
        $data = array();
        foreach ($resultArr as $row) {
           $actionHtml = '';
           $actionHtml .= '<a href="' . route('edit-cmspage', array('id' => $row['id'])) . '" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-edit"></i></a>'.
                '<a href="#cmsModel" data-toggle="modal" data-id="'. $row['id'] .'" class="link-black text-sm cmsModel" data-toggle="tooltip" data-original-title="Preview" > <i class="fa fa-eye"></i></a>';

            
            $nestedData = array();
            $nestedData[] = $row["id"];
            $nestedData[] = $row["name"];
            $nestedData[] = date('d-m-Y',strtotime($row["created_at"]));
            $nestedData[] = date('d-m-Y',strtotime($row["updated_at"]));
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
