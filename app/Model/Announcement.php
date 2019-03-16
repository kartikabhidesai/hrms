<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Users;
use App\Model\Announcement;
use Config;

class Announcement extends Model {

    protected $table = 'announcement';

    public function addAnnouncementData($request, $logedcompanyId) {
        $objAnnouncement = new Announcement();
        $objAnnouncement->title = $request->input('title');
        $objAnnouncement->company_id = $logedcompanyId;
        $objAnnouncement->date = date("Y-m-d", strtotime($request->input('start_date')));
        $objAnnouncement->status = $request->input('status');
        $objAnnouncement->time = $request->input('time');
        $objAnnouncement->content = $request->input('content');

        return ($objAnnouncement->save());
    }

    public function getAnnouncementList($request, $companyId) {
        $requestData = $_REQUEST;
        
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'title',
            2 => 'status',
            3 => 'content'
        );

        //$query = Announcement::;
        $query = Announcement::from('announcement');
                 
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
                ->select('id','company_id','title','status','content','date','time','updated_at')
                ->get();

        $data = array();

        foreach ($resultArr as $row) {
            $nestedData = array();
            //print_r($row);
            $nestedData[] = $row["title"];
            $nestedData[] = $row["status"];
            $nestedData[] = date("Y-m-d", strtotime($row["created_at"]));
            $nestedData[] = date("Y-m-d", strtotime($row["updated_at"]));
            $data[] = $nestedData;
        }
        //exit;
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        return $json_data;
    }

}
