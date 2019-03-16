<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        //$data['js'] = array('company/task.js');
        //$data['funinit'] = array('Task.init()');
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
    public function anounment_add() {
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/announcement.js','jquery.form.min.js','jquery.timepicker.js');
        $data['funinit'] = array('Announcement.add()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css','jquery.timepicker.css');
        $data['status']=array('1'=>'one','2'=>'two','3'=>'three');
        $data['header'] = array(
            'title' => 'Announcement List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Announcemnet' => 'Announcement'));

        return view('company.announcement.announcement-add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
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
