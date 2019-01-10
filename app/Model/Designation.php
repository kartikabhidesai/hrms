<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Users;
use App\Model\Department;
use App\Model\Designation;
use PDF;
use Config;
use File;

class Designation extends Model
{
    protected $table = 'designation';

    
    
}
