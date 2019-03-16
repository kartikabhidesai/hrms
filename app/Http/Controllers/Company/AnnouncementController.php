<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Announcement;
use App\Model\Company;
use Auth;

class AnnouncementController extends Controller {

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
        $data['js'] = array('company/announcement.js', 'jquery.form.min.js', 'jquery.timepicker.js');
        $data['funinit'] = array('Announcement.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Announcement List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Announcemnet' => 'Announcement'));

        return view('company.announcement.announcement-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function anounment_add(Request $request) {

        if ($request->isMethod('post')) {

            $objAnnoucement = new Announcement();
            $userData = Auth::guard('company')->user();
            $getAuthCompanyId = Company::where('email', $userData->email)->first();
            $logedcompanyId = $getAuthCompanyId->id;
            $result = $objAnnoucement->addAnnouncementData($request,$logedcompanyId);

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Annoucement Add Successfully.';
                $return['redirect'] = route('announcement');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something went wrong!';
            }
            echo json_encode($return);
            exit;
        }

        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/announcement.js', 'jquery.form.min.js', 'jquery.timepicker.js');
        $data['funinit'] = array('Announcement.add()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css', 'jquery.timepicker.css');
        $data['status'] = array('1' => 'one', '2' => 'two', '3' => 'three');
        $data['header'] = array(
            'title' => 'Announcement List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Announcemnet' => 'Announcement'));

        return view('company.announcement.announcement-add', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                
                $userID = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userID)->first();
                $announmntObj = new Announcement;
                $AnnounmntList = $announmntObj->getAnnouncementList($request, $companyId->id);
                echo json_encode($AnnounmntList);
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
