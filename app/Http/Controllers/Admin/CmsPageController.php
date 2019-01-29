<?php

namespace App\Http\Controllers\Admin;
use App\Model\Users;
use App\Model\Cmspage;
use App\Http\Controllers\Controller;
use App\Model\Sendmail;
use Illuminate\Http\Request;
use Config;

class CmsPageController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    public function index(Request $request) {
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/cms_page.js');
        $data['funinit'] = array('Cms_page.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Cms page',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Cmspage' => 'Cms page'));
        return view('admin.cms_page.list', $data);
        
    }   

   
    public function edit(Request $request,$id) {
        $data['testarray'] = Config::get('constants.testarray');
        $data['detail'] = Cmspage::find($id);

        if ($request->isMethod('post')) {
            $objCmspage = new Cmspage();
            $ret = $objCmspage->editCmspage($request);
            if ($ret) {
                $return['status'] = 'success';
                $return['message'] = 'Record Edited successfully.';
                $return['redirect'] = route('list-cmspage');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/cms_page.js', 'ajaxfileupload.js', 'jquery.form.min.js', 'plugins/summernote/summernote.min.js');
        $data['funinit'] = array('Cms_page.init()','Cms_page.init1()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css', 'plugins/summernote/summernote.css', 'plugins/summernote/summernote-bs3.css');
         $data['header'] = array(
            'title' => 'Cms Pages',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Cmspage' => route("list-cmspage"),
                'Cms Page Edit' => 'Cms Page Edit'));
        return view('admin.cms_page.edit', $data);
    }


    public function deleteCmspage($postData) {
        if ($postData) {
            $result = Cmspage::where('id', $postData['id'])->delete();
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Record delete successfully.';
//                $return['redirect'] = route('calls');
                $return['jscode'] = "setTimeout(function(){
                        $('#deleteModel').modal('hide');
                        $('#dataTables-example').refresh();
                    },1000)";
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
    }

    public function getCmsDetails($postData) {
            $return = Cmspage::find($postData);
            echo json_encode($return);
            exit;
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objCmspage = new Cmspage();
                $CmspageList = $objCmspage->getSMSpageData($request);
                echo json_encode($CmspageList);
                break;
            case 'deleteCmspage':
                $result = $this->deleteCmspage($request->input('data'));
                break;
                case 'getCmsDetails':
                $result = $this->getCmsDetails($request->input('data'));
                break;
        }
    }


    public function sendMail(){
        $mailData['subject'] = 'Calls - Sent Email';
        $mailData['attachment'] = array();
        $mailData['mailto'] = 'shaileshvanaliya91@gmail.com';
        // $mailData['mailto'] = $request->input('caller_email');
        $sendMail = new Sendmail;
        $mailData['data']['caller_note'] = 'dsad';
        $mailData['template'] = 'emails.test-mail';
        $result = $sendMail->sendSMTPMail($mailData);
        dump($result);exit;
    }
  
}
