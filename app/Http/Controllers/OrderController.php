<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;
use Redirect;
use App\Model\Order;
use App\Model\Calls;
use App\Model\Users;
use App\Model\OrderInfo;
use App\Model\OutgoingCalls;
use Config;
class OrderController extends Controller {

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

    public function index(Request $request){
        
        if($request->isMethod('post')){
            $objOrder= new Order();
            $result=$objOrder->createOrder($request);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Order Created Succeessfully.';
                $return['redirect'] = route('order');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Try again';
            }
            echo json_encode($return);
            exit;
        }
        
        $data['subcription']=Config::get('constants.subcription');
        $data['request_type']=Config::get('constants.request_type');
        print_r($data['request_type']);
        die();
        
        $data['payment_type']=Config::get('constants.payment_type');
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('order.js');
        $data['funinit'] = array('Order.init()');
        $data['css'] = array('');
        return view('front.order', $data);
    }
    
    
}