<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SocialMediaToken;
use Facebook\Facebook;
use App;

class FacebookController extends Controller
{


    private $api;
    public function __construct(Facebook $fb)
    {
        $this->middleware(function ($request, $next) use ($fb) {
            $fb->setDefaultAccessToken($_COOKIE['facebook_user_token']);
            $this->api = $fb;
            return $next($request);
        });
    }

    public function facebookUser(){
        try {

            $user = $this->api->get('/me/accounts')->getBody();

            $data = json_decode($user);

            if(empty($data->data)){
                 setcookie('facebook_user_page_error','Facebook user page not avalibale', time() + 30, "/");
                return redirect('admin/manage-account');
            }else {					
					foreach($data->data as $fbdata){
						$r['token']=$fbdata->access_token;
						$r['account_key']=$fbdata->id;
						$r['account_name']=$fbdata->name;
						$r['account_type']='facebook';
						$smTokenObj=new SocialMediaToken();
						$smTokenObj->addSocialMediaToken($r);
					}
	            setcookie('facebooksuccess', "Facebook authentication successfully done.", time() + 30, "/");
                return redirect('admin/manage-account');
            //    $url = App::make('url')->to($_COOKIE['redirect']);
              //  echo '<script> location.href="' . $url . '"; </script>';
            }   
        } catch (FacebookSDKException $e) {

        }

    }

    function createFacebookPage(Request $r){
        try {
            //$facebook = new Facebook();
            $fb_user_id=$_COOKIE['facebook_user_id'];
            $response = $this->api->post("$fb_user_id/accounts",
                ['name' => 'TEST Kishan Dharajiya Page',
                    'category_enum' => 'PERSONAL_BLOG',
                    'about' => 'Just trying the API',
                    'picture' => 'https://images.pexels.com/photos/257840/pexels-photo-257840.jpeg',
                    'cover_photo' => '{"url":"https://images.pexels.com/photos/257840/pexels-photo-257840.jpeg"}']);

            $user = $this->api->get('/me/accounts')->getBody();

            $data = json_decode($user);

            if(empty($data->data)){
                setcookie('facebook_user_page_error','Facebook user page not available', time() + 5, "/");
                /*$url = App::make('url')->to($_COOKIE['redirect']);
                echo '<script> location.href="' . $url . '"; </script>';*/
            }else {
                setcookie('facebooksuccess', "Facebook authentication successfully done.", time() + 5, "/");
                setcookie('facebook_user_page_token',$user, time() + (60 * 10), "/");
                $url = App::make('url')->to($_COOKIE['redirect']);
                echo '<script> location.href="' . $url . '"; </script>';
            }

        } catch(FacebookExceptionsFacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookExceptionsFacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
    }
}
