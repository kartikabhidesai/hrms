<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use Config;

class Performance extends Model {

    protected $table = 'performances';

    public function addEmployeeperformance($request,$compnyid) {
        
        $objper = new Performance();
        //print_r($request->input()); exit;
        //$request->rating="1";
        $objper->company_id = $compnyid;
        $objper->employee_id = $request->employee_id;
        $objper->department_id = $request->department;
        $objper->availability = $request->rating;
        $objper->joining_of_date =  $request->date_of_joining;
        if ($request->file()) {
            $image = $request->file('attachment');
            $file = 'performance' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/performance/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image->move($destinationPath, $file);
            $objper->attachment = '/uploads/performance/' . $file;
        }
        $objper->save();

        if ($objper) {
            return TRUE;
        } else {
            return false;
        }
    }

}
