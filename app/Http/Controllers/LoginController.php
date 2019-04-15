<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use Redirect;
use App\Model\Calls;
use App\Model\Users;
use App\Model\OrderInfo;
use App\Model\OutgoingCalls;
use App\Model\Chat;

class LoginController extends Controller {

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('guest', ['except' => 'logout']);
    }

    public function checkAuth(Request $request) {
        if (auth()->guard('admin')->user()) {
            return redirect()->route('admin-dashboard');
        } else if (auth()->guard('company')->user()) {
            return redirect()->route('company-dashboard');
        } else if (auth()->guard('employee')->user()) {
            return redirect()->route('employee-dashboard');
        } else {
            return view('auth.login');
        }
    }

    public function auth(Request $request) {

        // $this->resetGuard();
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'type' => 'USER'])) {
                $loginData = array(
                    'name' => Auth::guard('web')->user()->name,
                    'email' => Auth::guard('web')->user()->email,
                    'type' => Auth::guard('web')->user()->type,
                    'user_image' => Auth::guard('web')->user()->user_image,
                    'id' => Auth::guard('web')->user()->id
                );
                Session::push('logindata', $loginData);
                $this->insertLoginTime(Auth::guard('web')->user()->id);
                $request->session()->flash('session_success', 'User Login successfully.');
                return redirect()->route('user-dashboard');
            } else if (Auth::guard('employee')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'type' => 'EMPLOYEE'])) {
                $loginData = array(
                    'name' => Auth::guard('employee')->user()->name,
                    'email' => Auth::guard('employee')->user()->email,
                    'type' => Auth::guard('employee')->user()->type,
                    'id' => Auth::guard('employee')->user()->id,
                    'user_image' => Auth::guard('employee')->user()->user_image
                );
                Session::push('logindata', $loginData);
                $this->insertLoginTime(Auth::guard('employee')->user()->id);
                $request->session()->flash('session_success', 'Customer Login successfully.');
                return redirect()->route('employee-dashboard');
            } else if (Auth::guard('company')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'type' => 'COMPANY'])) {
                $loginData = array(
                    'name' => Auth::guard('company')->user()->name,
                    'email' => Auth::guard('company')->user()->email,
                    'type' => Auth::guard('company')->user()->type,
                    'id' => Auth::guard('company')->user()->id,
                    'user_image' => Auth::guard('company')->user()->user_image
                );
                Session::push('logindata', $loginData);
                $this->insertLoginTime(Auth::guard('company')->user()->id);
                $request->session()->flash('session_success', 'Company Login successfully.');
                return redirect()->route('company-dashboard');
            } else if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'type' => 'ADMIN'])) {
                $loginData = array(
                    'name' => Auth::guard('admin')->user()->name,
                    'email' => Auth::guard('admin')->user()->email,
                    'type' => Auth::guard('admin')->user()->type,
                    'user_image' => Auth::guard('admin')->user()->user_image,
                    'id' => Auth::guard('admin')->user()->id,
                );
                Session::push('logindata', $loginData);
                $this->insertLoginTime(Auth::guard('admin')->user()->id);
                $request->session()->flash('session_success', 'Admin Login successfully.');
                return redirect()->route('admin-dashboard');
            } else {
                $request->session()->flash('session_error', 'Your username and password are wrong. Please login with correct credential...!!');
                return redirect()->route('login');
            }
        }

        return view('auth.login');
    }

    public function insertLoginTime($user_id) {
        DB::insert('insert into login_details (user_id) values(?)', [$user_id]);
    }

    public function getLogout() {
        $this->resetGuard();
        return redirect()->route('login');
    }

    public function resetGuard() {
        Auth::logout();
        Auth::guard('admin')->logout();
        Auth::guard('company')->logout();
        Auth::guard('employee')->logout();
        Session::forget('logindata');
        Session::forget('userRole');
    }

    public function forgotpassword(Request $request) {

        if ($request->isMethod('post')) {
            // print_r($request->input());exit;
            $objUser = new Users();
            $getCustomer = $objUser->passwordReset($request->input('email'));
            if ($getCustomer) {
                /* $return['status'] = 'success';
                  $return['message'] = 'Password sent to your e-mail, check and login with it';
                  $return['redirect'] = route('login'); */
                $request->session()->flash('session_success', 'Password sent to your e-mail, check and login with it');
                return redirect()->route('login');
            } else {
                $return['status'] = 'error';
                $return['message'] = "E-mail doesn't exists!";
                $request->session()->flash('session_error', "E-mail doesn't exists!");
                return redirect()->route('forgot-password');
            }
            echo json_encode($return);
            exit;
        }

        $data['plugincss'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/user.js');
        $data['funinit'] = array('Customer.forgotInit()');
        $data['css'] = array('');
        return view('auth.passwords.forgot-password', $data);
    }

}
