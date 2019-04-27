<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Model\Order;
use App\Model\SocialMedia;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

class SocialMediaController extends Controller {

    public function __construct() {
        // parent::__construct();
        $this->middleware('admin');
    }

    public function index(Request $request) {



        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/socialmedia.js', 'ajaxfileupload.js', 'jquery.form.min.js','jquery.timepicker.js');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css','jquery.timepicker.css');
        $data['funinit'] = array('Socialmedia.init()');
        $data['header'] = array(
            'title' => 'Social Media',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Social Media' => 'Social Media'));
        return view('admin.socialmedia.list', $data);
    }

    public function ajaxAction(Request $request) {

        $action = $request->input('action');

        switch ($action) {
            case 'getdatatable':
                $obj = new SocialMedia();
                $DataList = $obj->getdatatable($request);
                echo json_encode($DataList);
                break;
            case 'deleteSocialMedia':
                $result = $this->deleteSocialMedia($request->input('data'));
                break;
        }
    }

    public function deleteSocialMedia($postData) {
        if ($postData) {
            $obj = SocialMedia::find($postData['id']);
            $obj->status = 'removed';
            $result = $obj->save();
            // $existImage = public_path('/uploads/admin/company/').$objCompany->company_image;

            // if (File::exists($existImage)) { // unlink or remove previous company image from folder
            //     File::delete($existImage);
            // }

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Record delete successfully.';
                //$return['redirect'] = route('calls');
                $return['jscode'] = "setTimeout(function(){
                        $('#deleteModel').modal('hide');
                        $('#dataTables-social-media').DataTable().ajax.reload();
                    },1000)";
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
    }
    
    
    public function editPost(Request $request){
        
        $post_to_data = [1,2,3];        

        if($request->isMethod('post')) {
            $obj = new SocialMedia();
            $res = $obj->addSocialMedia($request);

            if ($res) {
                $return['status'] = 'success';
                $return['message'] = 'Record created successfully.';
                $return['redirect'] = url('admin/social-media');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something went wrong!';
            }
            echo json_encode($return);
            exit;
        }

        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/socialmedia.js', 'ajaxfileupload.js', 'jquery.form.min.js','jquery.timepicker.js');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css','jquery.timepicker.css');
        $data['funinit'] = array('Socialmedia.init()');

        $data['post_to_data'] = $post_to_data;
        $data['header'] = array(
            'title' => 'New Post',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'New Post' => 'New Post'));
        return view('admin.socialmedia.newPost', $data);
    }
    
    public function newPost(Request $request){

        $post_to_data = [1,2,3];        

        if($request->isMethod('post')) {

            // echo "<pre>"; print_r($request->toArray()); exit();

            $obj = new SocialMedia();
            $res = $obj->addSocialMedia($request);

            if ($res) {
                $return['status'] = 'success';
                $return['message'] = 'Record created successfully.';
                $return['redirect'] = url('admin/social-media');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something went wrong!';
            }
            echo json_encode($return);
            exit;
        }

        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/socialmedia.js', 'ajaxfileupload.js', 'jquery.form.min.js','jquery.timepicker.js');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css','jquery.timepicker.css');
        $data['funinit'] = array('Socialmedia.init()');

        $data['post_to_data'] = $post_to_data;
        $data['header'] = array(
            'title' => 'New Post',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'New Post' => 'New Post'));
        return view('admin.socialmedia.newPost', $data);
    }

}