<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WorkingDaySetting extends Model
{
    protected $table = 'working_day_setting';

    // protected $fillable = ['id', 'title', 'notes', 'event_date'];

    public function addWorkingDaySetting($request, $companyId)
    {
        // echo $request->monday_status == 1 ? '1' : '0';
        // echo $request->monday_work."**";
        // echo $request->monday_from;
        // echo $request->monday_to;
        // exit;
        if(!empty($request->workingdaysettingid))
        {
            $newWorkingDaySetting = WorkingDaySetting::find($request->workingdaysettingid);
        }else{
            $newWorkingDaySetting = new WorkingDaySetting();
        }
        // exit;
        $newWorkingDaySetting->company_id = $companyId;
        $newWorkingDaySetting->region = $request->region;
        $newWorkingDaySetting->time_zone = $request->time_zone;

        $newWorkingDaySetting->monday_status = $request->monday_status == 1 ? '1' : '0';
        if($request->monday_status==1){
            $newWorkingDaySetting->monday_work = $request->monday_work;
            $newWorkingDaySetting->monday_from = empty($request->monday_from) ? '' : $request->monday_from;
            $newWorkingDaySetting->monday_to = empty($request->monday_to) ? '' : $request->monday_to;
        }else{
            $newWorkingDaySetting->monday_work = 0;
            $newWorkingDaySetting->monday_from =  '';
            $newWorkingDaySetting->monday_to = '';
        }

        $newWorkingDaySetting->tuesday_status = $request->tuesday_status == 1 ? '1' : '0';
        if($request->tuesday_status==1){
            $newWorkingDaySetting->tuesday_work = $request->tuesday_work;
            $newWorkingDaySetting->tuesday_from = empty($request->tuesday_from) ? '' : $request->tuesday_from;
            $newWorkingDaySetting->tuesday_to = empty($request->tuesday_to) ? '' : $request->tuesday_to;
        }else{
            $newWorkingDaySetting->tuesday_work = 0;
            $newWorkingDaySetting->tuesday_from = '';
            $newWorkingDaySetting->tuesday_to = '';
        }

        $newWorkingDaySetting->wednesday_status = $request->wednesday_status == 1 ? '1' : '0';
        if($request->wednesday_status==1){
            $newWorkingDaySetting->wednesday_work = $request->wednesday_work;
            $newWorkingDaySetting->wednesday_from = empty($request->wednesday_from) ? '' : $request->wednesday_from;
            $newWorkingDaySetting->wednesday_to = empty($request->wednesday_to) ? '' : $request->wednesday_to;
        }else{
            $newWorkingDaySetting->wednesday_work = 0;
            $newWorkingDaySetting->wednesday_from = '';
            $newWorkingDaySetting->wednesday_to = '';
        }

        $newWorkingDaySetting->thursday_status = $request->thursday_status == 1 ? '1' : '0';
        if($request->thursday_status==1){
            $newWorkingDaySetting->thursday_work = $request->thursday_work;
            $newWorkingDaySetting->thursday_from = empty($request->thursday_from) ? '' : $request->thursday_from;
            $newWorkingDaySetting->thursday_to = empty($request->thursday_to) ? '' : $request->thursday_to;
        }else{
            $newWorkingDaySetting->thursday_work = 0;
            $newWorkingDaySetting->thursday_from = '';
            $newWorkingDaySetting->thursday_to = '';
        }

        $newWorkingDaySetting->friday_status = $request->friday_status == 1 ? '1' : '0';
        if($request->friday_status==1){
            $newWorkingDaySetting->friday_work = $request->friday_work;
            $newWorkingDaySetting->friday_from = empty($request->friday_from) ? '' : $request->friday_from;
            $newWorkingDaySetting->friday_to = empty($request->friday_to) ? '' : $request->friday_to;
        }else{
            $newWorkingDaySetting->friday_work = 0;
            $newWorkingDaySetting->friday_from = '';
            $newWorkingDaySetting->friday_to = '';
        }

        $newWorkingDaySetting->saturday_status = $request->saturday_status == 1 ? '1' : '0';
        if($request->saturday_status==1){
            $newWorkingDaySetting->saturday_work = $request->saturday_work;
            $newWorkingDaySetting->saturday_from = empty($request->saturday_from) ? '' : $request->saturday_from;
            $newWorkingDaySetting->saturday_to = empty($request->saturday_to) ? '' : $request->saturday_to;
        }else{
            $newWorkingDaySetting->saturday_work = 0;
            $newWorkingDaySetting->saturday_from = '';
            $newWorkingDaySetting->saturday_to = '';
        }

        $newWorkingDaySetting->sunday_status = $request->sunday_status == 1 ? '1' : '0';
        if($request->sunday_status==1){
            $newWorkingDaySetting->sunday_work = $request->sunday_work;
            $newWorkingDaySetting->sunday_from = empty($request->sunday_from) ? '' : $request->sunday_from;
            $newWorkingDaySetting->sunday_to = empty($request->sunday_to) ? '' : $request->sunday_to;
        }else{
            $newWorkingDaySetting->sunday_work = 0;
            $newWorkingDaySetting->sunday_from = '';
            $newWorkingDaySetting->sunday_to = '';
        }

        $newWorkingDaySetting->created_at = date('Y-m-d H:i:s');
        $newWorkingDaySetting->updated_at = date('Y-m-d H:i:s');
    	$newWorkingDaySetting->save();

    	if($newWorkingDaySetting) {
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }

    
}
