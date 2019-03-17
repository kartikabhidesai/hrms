<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;
use Redirect;
use App\Model\Calls;
use App\Model\Users;
use App\Model\OrderInfo;
use App\Model\OutgoingCalls;
 use Excel;
class ExcelController extends Controller {

    use AuthenticatesUsers;

    
    public function __construct() {
        //$this->middleware('guest', ['except' => 'logout']);
    }

    public function exportxls(Request $request) {
        Excel::create('Filename', function($excel) {

    $excel->sheet('Sheetname', function($sheet) {

        $sheet->fromArray(array(
            array('data1', 'data2'),
            array('data3', 'data4')
        ));

    });

})->export('xls');
    }


}