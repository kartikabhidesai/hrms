<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\UserHasPermission;
use App\Model\Employee;
use Config;
use Auth;
use DB;

class Tax extends Model
{
    protected $table = 'tax';
    protected $primaryKey = 'company_id';
    protected $fillable  = ['amount'];

   
    public function editTax($request, $companyId)
    {
        $taxObj = new Tax();
        $taxObj = Tax::firstOrNew(['company_id' => $companyId]);
        $taxObj->company_id = $companyId;
        $taxObj->tax_amount = $request->input('amount');
        $taxObj->created_at = date('Y-m-d H:i:s');
        $taxObj->updated_at = date('Y-m-d H:i:s');
        $taxObj->save();
        return TRUE;
    }
    public function getTax($companyId)
    {
        $result = Tax::select('tax_amount')->where('company_id', $companyId)->first();
        return $result;
    }

}
