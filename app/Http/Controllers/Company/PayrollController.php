<?php

namespace App\Http\Controllers\Company;
use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

class PayrollController extends Controller {

    public function __construct() {
        $this->middleware('company');
    }

    public function list() {
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Payroll List',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard")));
        return view('company.payroll.payroll-list', $data);
    }
    public function payrollEmpList() {
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Payroll Employee List',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard")));
        return view('company.payroll.payroll-employee-list', $data);
    }
 public function add() {
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Payroll Employee List',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard")));
        return view('company.payroll.payroll-add', $data);
    }

}