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

    public function addAnnouncementData($request,$logedcompanyId) {
        $objAnnouncement = new Announcement();
        $objAnnouncement->title = $request->input('title');
        $objAnnouncement->company_id = $logedcompanyId;
        $objAnnouncement->date = date("Y-m-d", strtotime($request->input('start_date')));
        $objAnnouncement->status = $request->input('status');
        $objAnnouncement->time = $request->input('time');
        $objAnnouncement->content = $request->input('content');
       
        return ($objAnnouncement->save());
    }

}
