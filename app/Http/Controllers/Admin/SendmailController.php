<?php

/**
 * Controller Name: UpdateProfileController
 * Descripation: Use to manage user profile 
 * Created date: 17 AUG 2017
 */

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;
use Route;
use Illuminate\Http\Request;
use Config;
use Mail;

class SendmailController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function sendmail(Request $request) {
        
        $mailData['subject'] = 'Test';
        $mailData['template'] = 'emails.test-mail';
        
        $mailData['attachment'] = array();
$pathToFile = '';
        $mailData['mailto'] = ['kartikdesai123@gmail.com','shaileshvanaliya91@gmail.com'];
        $mailData['data'] = 'ddd';
        $mailsend = Mail::send($mailData['template'], ['data' => $mailData['data']], function ($m) use ($mailData, $pathToFile) {
                    $m->from('smtp@prasadexpo.co.in', 'Office Park');

                    $m->to($mailData['mailto'], "HRMS")->subject($mailData['subject']);
                    if ($pathToFile != "") {
                        // $m->attach($pathToFile);
                    }

                    //  $m->cc($mailData['bcc']);
                });
        var_dump($mailsend);
        if ($mailsend) {
            echo 'done';
        } else {
            echo 'not done';
        }
    }

}
