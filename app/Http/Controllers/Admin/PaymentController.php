<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Model\Payment;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

class PaymentController extends Controller {

    public function __construct() {
        // parent::__construct();
        $this->middleware('admin');
    }
    
    public function index(Request $request){
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/payment.js');
        $data['funinit'] = array('Payment.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Payment',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Payment' => 'payment'));
        return view('admin.payment.payment-list', $data);
    }
    
    public function enabled_list(Request $request){
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/payment.js');
        $data['funinit'] = array('Payment.enabled()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Approved Payment List',
            'breadcrumb' => array(
                'Home' => route("payment"),
                'Approved Payment List' => 'payment'));
        return view('admin.payment.list', $data);
    }

        public function ajaxAction(Request $request){
        $action=$request->input('action');
        switch ($action) {
            
            case 'getdatatable':
                $objpayment = new Payment();
                $PaymentList = $objpayment->getPaymentData();
                echo json_encode($PaymentList);
                break;
            
            case 'getdatatableApproved':
                $objpayment = new Payment();
                $PaymentList = $objpayment->getPaymentDataApproved();
                echo json_encode($PaymentList);
                break;
            
            
            case 'enableRequest':
                $id=$request->input('data')['id'];
                $objpayment = new Payment();
                $enableRequest=$objpayment->enableRequest($id);
                    if ($enableRequest) {
                        $return['status'] = 'success';
                        $return['message'] = 'Payment request enabled';
                        $return['redirect'] = route('payment-list');
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'Something goes to wrong';
                    }
                    echo json_encode($return);
                    exit;
                 break;
             
            case 'disableRequest':
                $id=$request->input('data')['id'];
                    $objpayment = new Payment();
                    $disableRequest=$objpayment->disableRequest($id);
                    if ($disableRequest) {
                        $return['status'] = 'success';
                        $return['message'] = 'Payment request disable';
                        $return['redirect'] = route('payment-list');
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'Something goes to wrong';
                    }
                    echo json_encode($return);
                    exit;
                    
                 break;
             case 'deleteCompany':
                $id=$request->input('data')['id'];
                $result = $this->deletePayment($id);
                break;
            
        }
    }
   
    public function deletePayment($id) {
        if ($id) {
            $objCompany = Payment::where('id', $id)->delete();
            if ($objCompany) {
                $return['status'] = 'success';
                $return['message'] = 'Record delete successfully.';
                $return['redirect'] = route('payment-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
    }
 
}