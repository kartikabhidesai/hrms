<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;


class ChatController extends Controller{
    
    public function index(){
        
        $data['header'] = array(
            'title' => 'Chat',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Chat view' => 'Chat view'));
        
        return view('company.chat.chat',$data);
    }
    
}

