<?php

namespace App\Http\Controllers\Company;
use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

class CompanyController extends Controller {

    public function __construct() {
        $this->middleware('company');
    }

    public function dashboard() {
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Companyies',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Company' => 'Company'));
        return view('company.dashboard', $data);
    }

}