<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Company;
use App\Model\Employee;
use App\Model\Client;
use Auth;

class ClientController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        parent::__construct();
        $this->middleware('company');
    }

    public function index() {
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/client.js', 'jquery.form.min.js', 'jquery.timepicker.js');
        $data['funinit'] = array('Client.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Client List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Client' => 'Client'));

        return view('company.client.client-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addClient(Request $request) {

        if ($request->isMethod('post')) {

            $objClient = new Client();
            $userData = Auth::guard('company')->user();
            $getAuthCompanyId = Company::where('email', $userData->email)->first();
            $logedcompanyId = $getAuthCompanyId->id;
            $result = $objClient->addClientData($request, $logedcompanyId);

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Client Add Successfully.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('client');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something went wrong!';
            }
            echo json_encode($return);
            exit;
        }

        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('ajaxfileupload.js',
                            'jquery.form.min.js',
                            'jquery.timepicker.js',
                            'company/client.js',
                        );
        $data['funinit'] = array('Client.add()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css', 'jquery.timepicker.css');
        $data['header'] = array(
            'title' => 'Client List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Client List' => route("client"),
                'Client Add' => 'Client-add'));

        return view('company.client.client-add', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $userData = Auth::guard('company')->user();
                $getAuthCompanyId = Company::where('email', $userData->email)->first();
                $logedcompanyId = $getAuthCompanyId->id;
                $clientObj = new Client;
                $ClientList = $clientObj->getClientList($request, $logedcompanyId);
                echo json_encode($ClientList);
                break;
            case'deleteClient':
                $result = $this->deleteclient($request->input('data'));
                break;
        }
    }

    public function deleteclient($postData) {
        if ($postData) {
            $findclient = Client::where('id', $postData['id'])->first();
            $result = $findclient->delete();

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Record deleted successfully.';
                $return['jscode'] = "setTimeout(function(){
                        $('#deleteModel').modal('hide');
                        $('#ClientDatatables').DataTable().ajax.reload();
                    },1000)";
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
    }

    public function client_edit(Request $request, $id) {
        
        
        if ($request->isMethod('post')) {
            $objClient = new Client();
            $ret = $objClient->editClient($request,$id);

            if ($ret) {
                $return['status'] = 'success';
                $return['message'] = 'Record Edited successfully.';
                $return['redirect'] = route('client');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Please add any one designation!';
            }

            echo json_encode($return);
            exit;
        }
        $data['client_detail'] = Client::where('id', $id)->first();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/client.js', 'jquery.form.min.js', 'jquery.timepicker.js');
        $data['funinit'] = array('Client.add()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Award List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Client List' => route("client"),
                'Client Edit' => 'Client Edit'));

        return view('company.client.client-edit', $data);
    }

}
