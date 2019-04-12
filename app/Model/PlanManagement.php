<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PlanManagement extends Model
{
    protected $table = 'plan_managent';

    public function addPlan_Management($request) {
        
        $plane_features="explodeval";
        $objplanManagement = new PlanManagement();
        $objplanManagement->code = $request->input('code');
        $objplanManagement->duration = date("Y-m-d", strtotime($request->input('duration')));
        $objplanManagement->plan_feature = $plane_features;
        $objplanManagement->charge = $request->input('charge');
        $objplanManagement->title = $request->input('title');
        $objplanManagement->expiration = $request->input('expiry_at');

        return ($objplanManagement->save());
    }
}
