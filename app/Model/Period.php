<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Period;

class Period extends Model
{
    //
    protected $table = 'period';
    

    public function createNewPeriod($request, $company_id) {

        $period = new Period();
        $period->period = $request->input('period');
        $period->company_id = $company_id;
        $period->created_at = date('Y-m-d H:i:s');
        $period->updated_at = date('Y-m-d H:i:s');
        return $period->save();
    }

    public function getPeriodCompanyList($company_id) {
        $objdata = Period::where('company_id', $company_id)->select('id', 'period')->get();
        return ($objdata);
    }
}
