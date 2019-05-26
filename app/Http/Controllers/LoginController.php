<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use Redirect;
use App\Model\AdminUserHasPermission;
use App\Model\Users;
use App\Model\Chat;
use App\Model\Notification;

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
                                
                $objNotification = new Notification();
                $notificationList = $objNotification->getNotificationList(Auth::guard('web')->user()->id);
                $notificationCount = $objNotification->getNotificationCount(Auth::guard('web')->user()->id);

                $loginData = array(
                    'name' => Auth::guard('web')->user()->name,
                    'email' => Auth::guard('web')->user()->email,
                    'type' => Auth::guard('web')->user()->type,
                    'user_image' => Auth::guard('web')->user()->user_image,
                    'id' => Auth::guard('web')->user()->id
                );
                Session::push('logindata', $loginData);

                $notificationData=array(
                    'notification_count' => $notificationCount,
                    'notification_list' => $notificationList);

                Session::push('notificationdata', $notificationData);
                $this->insertLoginTime(Auth::guard('web')->user()->id);
                $request->session()->flash('session_success', 'User Login successfully.');
                return redirect()->route('user-dashboard');
            } else if (Auth::guard('employee')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'type' => 'EMPLOYEE'])) {

                $objNotification = new Notification();
                $notificationList = $objNotification->getNotificationList(Auth::guard('employee')->user()->id);
                $notificationCount = $objNotification->getNotificationCount(Auth::guard('employee')->user()->id);

                $loginData = array(
                    'name' => Auth::guard('employee')->user()->name,
                    'email' => Auth::guard('employee')->user()->email,
                    'type' => Auth::guard('employee')->user()->type,
                    'id' => Auth::guard('employee')->user()->id,
                    'user_image' => Auth::guard('employee')->user()->user_image
                );
                Session::push('logindata', $loginData);

                    $notificationData=array(
                    'notification_count' => $notificationCount,
                    'notification_list' => $notificationList);

                Session::push('notificationdata', $notificationData);
                $this->insertLoginTime(Auth::guard('employee')->user()->id);
                $request->session()->flash('session_success', 'Customer Login successfully.');
                return redirect()->route('employee-dashboard');
            } else if (Auth::guard('company')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'type' => 'COMPANY'])) {
                
                
                $this->getUserRoleList(Auth::guard('company')->user()->id,$request);
                $roles =  Session::get('userRole');
                
                $loginData = array(
                    'name' => Auth::guard('company')->user()->name,
                    'email' => Auth::guard('company')->user()->email,
                    'type' => Auth::guard('company')->user()->type,
                    'id' => Auth::guard('company')->user()->id,
                    'user_image' => Auth::guard('company')->user()->user_image
                );
                Session::push('logindata', $loginData);

                $objNotification = new Notification();
                $notificationList = $objNotification->getNotificationList(Auth::guard('company')->user()->id);
                $notificationCount = $objNotification->getNotificationCount(Auth::guard('company')->user()->id);
                

                $notificationData=array(
                    'notification_count' => $notificationCount,
                    'notification_list' => $notificationList);

                Session::push('notificationdata', $notificationData);
                // print_r($request->session());exit;
                $this->insertLoginTime(Auth::guard('company')->user()->id);
                $request->session()->flash('session_success', 'Company Login successfully.');
                return redirect()->route('company-dashboard');
            } else if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'type' => 'ADMIN'])) {
                
                $objNotification = new Notification();
                $notificationList = $objNotification->getNotificationList(Auth::guard('admin')->user()->id);
                $notificationCount = $objNotification->getNotificationCount(Auth::guard('admin')->user()->id);
                
                $this->getUserRoleList(Auth::guard('admin')->user()->id,$request);

                $roles =  Session::get('userRole');
                
                $loginData = array(
                    'name' => Auth::guard('admin')->user()->name,
                    'email' => Auth::guard('admin')->user()->email,
                    'type' => Auth::guard('admin')->user()->type,
                    'user_image' => Auth::guard('admin')->user()->user_image,
                    'id' => Auth::guard('admin')->user()->id
                );
                Session::push('logindata', $loginData);

                $notificationData=array(
                    'notification_count' => $notificationCount,
                    'notification_list' => $notificationList);

                Session::push('notificationdata', $notificationData);
                $this->insertLoginTime(Auth::guard('admin')->user()->id);
                // print_r();
                // exit;
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

        $last_active=date('Y-m-d H:i:s');
        DB::insert('insert into login_details (user_id,last_active) values(?,?)', [$user_id,$last_active]);
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
        Session::forget('notificationdata');
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

    public function zeroNotificationCount(Request $request) {

        if ($request->isMethod('post')) {
            // print_r($request->input());exit;
            $objNotification = new Notification();
            $getNotification = $objNotification->zeroNotificationCount($request->input('user_id'),$request->input('notification_id'));
            if ($getNotification) {
                $countNotification = $objNotification->getNotificationCount($request->input('user_id'));
                $notificationList = $objNotification->getNotificationList($request->input('user_id'));
                $items = Session::get('logindata');
                // print_r($notificationList);
                foreach ($items as &$item) {
                    // if ($items[0]['notification_count'] != 0) {
                        $items[0]['notification_count']--;
                    // }
                }
                $items[0]['notification_list']=$notificationList;
                // $items[0]['notification_count']=$countNotification;
                // print_r($items[0]['notification_list']);

                Session::put('logindata', $items);
                return  $items[0]['notification_count'];
                exit;
            }
            return 0; 
            exit;
        }
    }

    
    public function zeroNotificationCount_old(Request $request) {

        if ($request->isMethod('post')) {
            // print_r($request->input());exit;
            $objNotification = new Notification();
            $getNotification = $objNotification->zeroNotificationCount($request->input('user_id'),$request->input('notification_id'));
            if ($getNotification) {
                $countNotification = $objNotification->getNotificationCount($request->input('user_id'));
                // $loginData = array('notification_count' => $countNotification);
                // print_r($request->session());
                // $request->session()->flash(logindata[0]['notification_count']);
                // foreach(session::get('logindata') as $rr)
                // {
                //     $request->session()->put(['logindata'][0]['notification_count'], $countNotification);
                // }

                $items = Session::get('logindata');

                foreach ($items as &$item) {
                    if ($item['notification_count'] != 0) {
                        $item['notification_count']--;
                    }
                }

                Session::put('logindata', $items);
                return $item['notification_count'];
                // print_r($request->session());
                // return $session['logindata'][0]['notification_count']=$countNotification;
                // exit;
            }
            // return 0; 
            exit;
        }
    }
    
    public function getUserRoleList($id,Request $request){
        $objAdminPermission = new AdminUserHasPermission();
        $roleList = $objAdminPermission->permissionListAdmin($id);
        $request->session()->put('userRole', $roleList);
    }

}
