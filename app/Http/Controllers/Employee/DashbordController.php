<?php
namespace App\Http\Controllers\Employee;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

class DashbordController extends Controller {

    public function __construct() {
        $this->middleware('employee');
    }

    public function dashboard() {
        $data['detail'] = $this->loginUser;
        return view('employee.dashboard', $data);
    }

}