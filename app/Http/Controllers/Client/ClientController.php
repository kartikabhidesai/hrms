<?php

namespace App\Http\Controllers\Client;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

class ClientController extends Controller {

    public function __construct() {
        // parent::__construct();
        $this->middleware('client');
    }

    public function dashboard() {
        $data['detail'] = $this->loginUser;
        return view('client.dashboard', $data);
    }

}