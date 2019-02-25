<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Model\Order;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

class OrderController extends Controller {

    public function __construct() {
        // parent::__construct();
        $this->middleware('admin');
    }
    
    public function index(Request $request){
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/order.js');
        $data['funinit'] = array('Order.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Order',
            'breadcrumb' => array(
                'Home' => route("order"),
                'Order' => 'order'));
        return view('admin.order.list', $data);
    }
    
    public function ajaxAction(Request $request){
        $action=$request->input('action');
        switch ($action) {
            
            case 'getdatatable':
                $objorder = new Order();
                $OrderList = $objorder->getOrderData();
                echo json_encode($OrderList);
                break;
            
        }
    }
    
}