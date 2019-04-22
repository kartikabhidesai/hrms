<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\UserHasPermission;
use Config;
use Auth;
use DB;

class PlanFeature extends Model
{
    protected $table = 'plan_features';
    protected $fillable  = ['display_name','name'];

   
    public function addPlanFeature($request)
    {
        $pfObj = new PlanFeature();
        $pfObj->display_name = $request->display_name;
        $pfObj->name = $request->name;
        $pfObj->created_at = date('Y-m-d H:i:s');
        $pfObj->updated_at = date('Y-m-d H:i:s');
        $pfObj->save();
        return TRUE;
    }
    public function getPlanFeatures($id='')
    {
        if($id!=''){

        }else{
            $result = PlanFeature::select('plan_features.*')->get();
        }
        return $result;
    }

}
