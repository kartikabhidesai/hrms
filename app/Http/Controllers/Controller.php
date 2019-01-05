<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use App;
use Session;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     public $loginUser;

    public function __construct() {

        $this->middleware(function ($request, $next) {
            if (!empty(Auth()->guard('admin')->user())) {
                $this->loginUser = Auth()->guard('admin')->user();
            }
            if (!empty(Auth()->guard('company')->user())) {
                $this->loginUser = Auth()->guard('company')->user();
            }
            if (!empty(Auth()->guard('employee')->user())) {
                $this->loginUser = Auth()->guard('employee')->user();
            }
            if (!empty(Auth::user())) {
                $this->loginUser = Auth::user();
            }

            return $next($request);
        });
        
        
    }
}
