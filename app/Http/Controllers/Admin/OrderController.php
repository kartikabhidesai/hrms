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
    
    public function approved_list(Request $request){
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/order.js');
        $data['funinit'] = array('Order.approved()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Approved Order List',
            'breadcrumb' => array(
                'Home' => route("order"),
                'Approved Order List' => 'order'));
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
            
            case 'getdatatableApproved':
                $objorder = new Order();
                $OrderList = $objorder->getOrderDataApproved();
                echo json_encode($OrderList);
                break;
            
            
            case 'approveRequest':
                $id=$request->input('data')['id'];
                $objorder = new Order();
                $approveRequest=$objorder->approveRequest($request->input('data'));
                    if ($approveRequest) {
                        $return['status'] = 'success';
                        $return['message'] = 'Order request approved';
                        $return['redirect'] = route('order-list');
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'Something goes to wrong';
                    }
                    echo json_encode($return);
                    exit;
                 break;
             
            case 'disapproveRequest':
                $id=$request->input('data')['id'];
                    $objorder = new Order();
                    $disapproveRequest=$objorder->disapproveRequest($id);
                    if ($disapproveRequest) {
                        $return['status'] = 'success';
                        $return['message'] = 'Order request rejected';
                        $return['redirect'] = route('order-list');
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'Something goes to wrong';
                    }
                    echo json_encode($return);
                    exit;
                    
                 break;
             case 'deleteCompany':
                $id=$request->input('data')['id'];
                $result = $this->deleteOrder($id);
                break;
            
        }
    }
   
    public function deleteOrder($id) {
        if ($id) {
            $objCompany = Order::where('id', $id)->delete();
            if ($objCompany) {
                $return['status'] = 'success';
                $return['message'] = 'Record delete successfully.';
                $return['redirect'] = route('order-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
    }
 
}