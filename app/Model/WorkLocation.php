<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\WorkLocation;

class WorkLocation extends Model {

    protected $table = 'worklocation';

    public function createWorkLocation($request, $company_id) {

        $newworklocatin = new WorkLocation();
        $newworklocatin->work_location_name = $request->input('work_name');
        $newworklocatin->company_id = $company_id;
        $newworklocatin->created_at = date('Y-m-d H:i:s');
        $newworklocatin->updated_at = date('Y-m-d H:i:s');
        return $newworklocatin->save();
    }

    public function getWorkLocationCompanyList($company_id) {
        $objdata = WorkLocation::where('company_id', $company_id)->select('id', 'work_location_name')->get();
        return ($objdata);
    }

}
