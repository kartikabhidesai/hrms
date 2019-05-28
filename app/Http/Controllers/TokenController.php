<?php

namespace App\Http\Controllers;

use App\Model\UserTokenModel;
use Facebook\Facebook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SocialMediaToken;
use Session;
use Socialite;
use LinkedIn;
use App;
use Abraham\TwitterOAuth\TwitterOAuth;

class TokenController extends Controller
{
    
    public function tokenCall($token_type) {
		
        if ($token_type == 'linkedin') {
            return Socialite::driver($token_type)->setScopes(['rw_company_admin', 'r_basicprofile', 'r_emailaddress', 'w_share'])->redirect();
        } elseif ($token_type == 'twitter') {
            return Socialite::driver($token_type)->redirect();
        } else {
            return Socialite::driver($token_type)->scopes(['manage_pages','publish_pages'])->redirect();
        }
    }
  
   public function facebook(){
	   
       if(isset($_GET['error'])){
        setcookie('facebook_user_auth_error', 'The user cancelled facebook login.', time() + (86400 * 30), "/");
        $url = App::make('url')->to($_COOKIE['redirect']);
        echo '<script> location.href="' . $url . '"; </script>';
       }else{
        $auth_user = Socialite::driver('facebook')->user();
        setcookie('facebook_user_token',$auth_user->token, time() + (86400 * 30), "/");
        setcookie('facebook_user_id',$auth_user->id, time() + (86400 * 30), "/");
        return redirect()->to('/facebook-user-profile');
       }
    }
	
    public function twitter() {
        if(isset($_GET['denied'])){
            setcookie('twittererror', 'The user cancelled twitter login', time() + (60 * 10), "/");
        }else{
         $user = Socialite::driver('twitter')->user();
         if($user->token){
           				$r['token']=$user->token;
						$r['account_key']=$user->id;
						$r['account_name']=$user->nickname;
						$r['token_secret']=$user->tokenSecret;
						$r['account_type']='twitter';
						$smTokenObj=new SocialMediaToken();
						$smTokenObj->addSocialMediaToken($r);
	
         } else {
             setcookie('twittererror', 'something wrong happen,please try again', time() + (60 * 10), "/");
         }
        }
        //$this->token_responce('twitter');
    }
	
	  function fbShare(Request $r){

        	$smTokenObj=new SocialMediaToken();
			$users= $smTokenObj->getUserToken(1,'facebook');
        
        if(!$users)
            return response()->json(['status'=>'failed','msg'=>'Facebook token not available.','data'=>[]]);
            
            foreach($users as $user){
                $facebook = new Facebook();
                //$facebook->setDefaultAccessToken($_COOKIE['facebook_user_token']);

                try{
                    $data=['message' => "TEST MESSAGE",
                        'link'=>'www.google.com'];

                    $this->responses = $facebook->post("/$user->account_id/feed",
                        $data,
                    $user->token);

                }catch(\Exception $e){
                    return response()->json(['status' => 'failed', 'msg' => "Graph returned an error :".$e->getMessage(),'data'=>[]]);
                }
            }
    }

    function twShare(Request $r){

      $smTokenObj=new SocialMediaToken();
	  $user= $smTokenObj->getUserToken(1,'twitter');
        
        if(!$user)
            return response()->json(['status'=>'failed','msg'=>'Twitter token not available.','data'=>[]]);

        $connection = new TwitterOAuth(env('TWITTER_APP_ID'), env('TWITTER_APP_SECRET'), $user->token, $user->token_secret);

        /* $path = $_SERVER['DOCUMENT_ROOT'].config('app.document_root');

        $r->id=$r->article_id;
        $article=$this->articleObj->viewArticle($r);

        unset($r->id);
        $image =$path . $article['data']->image;

        $status = $connection->upload('media/upload', ['media' => $image]);
 */
        //$post = $article['data']->title . "\n\n" . $article['data']->description;
        $post = "KISHAN TEST TWEET" ."\n\n" . substr("TEST DESCRIPTION", 0, 200);
//        $post = $request->input('title') . "\n\n" . $request->input('description') . "\n\n\n " . $request->input('link');
$isTweet = $connection->post('statuses/update', array('status' => strip_tags($post)));
exit;
        if (isset($status->media_id)) {
            $isTweet = $connection->post('statuses/update', array('status' => strip_tags($post), 'media_ids' => $status->media_id));

             $error = (array) $isTweet;
            if ($isTweet) {
                if (isset($error['errors'])) {
                    $errormessage = (array) $error['errors'][0];
                    return response()->json(['status' => 'failed', 'msg' => 'Error: ' . $errormessage['message'],'data'=>[]]);
                }
                $point_obj = new PointModel();
                $userPoint_obj = new UserPointModel();
                $user = Users::where('id', $r->user_id)->first(['id', 'membership_id']);
                $point = $point_obj->viewPoint('share_content_non_video', $user->membership_id);

                //ADD SM ACCOUNT POINT
                $point->activity_id = 'share_content_non_video';
                $point->membership_id = $user->membership_id;
                $point->user_id = $r->user_id;
                $userPoint = $userPoint_obj->addUserPoint($point);

                if ($userPoint == false)
                    return $this->reply = ['status' => 'failed', 'msg' => 'User point not added', 'data' => []];

                $r->share_type='twitter';
                $userShareArticle= new UserArticleShare();
                $userShareArticle->addUserArticleShare($r);

                return response()->json(['status' => 'success', 'msg' => 'The article was share successfully on twitter.','data'=>[]]);
            } else {
                return response()->json(['status' => 'failed', 'msg' => 'Graph returned an error','data'=>[]]);
            }
        } else {
            return response()->json(['status' => 'failed', 'msg' => 'Graph returned an error','data'=>[]]);
        }
    }


  
}
