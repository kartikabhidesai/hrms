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
        $performanceCount = Performance::select('id')
        ->where('employee_id', $request->employee_id)
        ->where('month', $request->months)
        ->where('year', $request->year)
        ->get();
        // echo $performanceCount . ' Hii ';exit();
        if (count($performanceCount) == 0) {
            $objper = new Performance();
            // print_r($request->file()); 
            // print_r($request->input()); exit;
            //$request->rating="1";
            $objper->company_id = $compnyid;
            $objper->employee_id = $request->employee_id;
            $objper->availability = (isset($request->availableVal) ? $request->availableVal : '0');
            $objper->dependability = (isset($request->depandiablity) ? $request->depandiablity : '0') ;
            $objper->job_knowledge = (isset($request->jobKnow) ? $request->jobKnow : '0') ;
            $objper->quality = (isset($request->qualityVal) ? $request->qualityVal : '0') ;
            $objper->working_relationship = (isset($request->productivityVal) ? $request->productivityVal : '0') ;
            $objper->productivity = (isset($request->workingVal) ? $request->workingVal : '0') ;
            $objper->honesty = (isset($request->honestyVal) ? $request->honestyVal : '0') ;
            $objper->notes_and_details =  $request->notes_and_details;
            $objper->month =  $request->months;
            $objper->year =  $request->year;
            $file = '';
            if ($request->file()) {
                $image = $request->file('attachment');
                $file = 'performance' . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/performance/');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $image->move($destinationPath, $file);
            }
            $objper->file_attachment =  $file;
            $objper->save();

            if ($objper) {
                return TRUE;
            } else {
                return false;
            }
        }else{
            return 'Exist';
        }
    }


    public function getEmployeePerformanceList($id) {

            $result = Performance::select('performances.*')
                    ->where('performances.employee_id', '=', $id)
                    ->get()->toArray();
       // print_r($result);exit;
        return $result;
    }

}
