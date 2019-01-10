<?php
namespace App\Http\Controllers\Employee;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

class DashboardController extends Controller {

    public function __construct() {
        $this->middleware('employee');
    }

    public function dashboard() {
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Employee',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Company' => 'Company'));
        return view('employee.dashboard', $data);
    }

}