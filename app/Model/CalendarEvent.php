<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    protected $table = 'calendar_events';

    protected $fillable = ['id', 'title', 'notes', 'event_date'];

    public function addNewEvent($request, $companyId)
    {
    	$newEvent = new CalendarEvent();
    	$newEvent->company_id = $companyId;
    	$newEvent->title = $request->title;
    	$newEvent->notes = $request->notes;
    	$newEvent->event_date = date('Y-m-d', strtotime($request->event_date));
    	$newEvent->save();

    	if($newEvent) {
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }
}
