<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NonWorkingDate extends Model
{
    protected $table = 'non_working_date';

    // protected $fillable = ['id', 'title', 'notes', 'event_date'];

    public function addNonWorkingDate($request, $companyId)
    {
        
        $newNonWorkingDate = new NonWorkingDate();
        $newNonWorkingDate->company_id = $companyId;
        $newNonWorkingDate->date = date('Y-m-d', strtotime($request->date));
        $newNonWorkingDate->created_at = date('Y-m-d H:i:s');
        $newNonWorkingDate->updated_at = date('Y-m-d H:i:s');
    	$newNonWorkingDate->save();

    	if($newNonWorkingDate) {
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }

    public function getCompanyNonWorkingDateList($companyId)
    {
        return $workingDaySettingDetails = NonWorkingDate::select('non_working_date.id','non_working_date.date')
                            ->where('company_id', $companyId)->get()->toArray();
        
    }

    
}
