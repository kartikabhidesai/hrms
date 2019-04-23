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

class SocialMediaController extends Controller {

    public function __construct() {
        // parent::__construct();
        $this->middleware('admin');
    }

    public function index(Request $request) {
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/socialmedia.js');
        $data['funinit'] = array('Socialmedia.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Social Media',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Social Media' => 'Social Media'));
        return view('admin.socialmedia.list', $data);
    }
    
    
    public function manageAccount(Request $request){
       $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/socialmedia.js');
        $data['funinit'] = array('Socialmedia.manageAccounts()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Manage Accounts',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Manage Accounts' => 'Manage Accounts'));
        return view('admin.socialmedia.mangeAccounts', $data);
    }
    
    public function newPost(Request $request){
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/socialmedia.js');
        $data['funinit'] = array('Socialmedia.newPost()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'New Post',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'New Post' => 'New Post'));
        return view('admin.socialmedia.newPost', $data);
    }

}