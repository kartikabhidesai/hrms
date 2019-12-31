<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

class AdminController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    public function dashboard() {
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Dashboard',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Dashboard' => "dashboard")
        );
        return view('admin.dashboard', $data);
    }

}
