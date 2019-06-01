<?php

namespace App\Http\Controllers;

use App\Model\UserTokenModel;
use App\Model\SocialMedia;
use Carbon\Carbon;
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

    public function tokenCall($token_type)
    {

        if ($token_type == 'linkedin') {
            return Socialite::driver($token_type)->setScopes(['rw_company_admin', 'r_basicprofile', 'r_emailaddress', 'w_share'])->redirect();
        } elseif ($token_type == 'twitter') {
            return Socialite::driver($token_type)->redirect();
        } else {
            return Socialite::driver($token_type)->scopes(['manage_pages', 'publish_pages'])->redirect();
        }
    }

    public function facebook()
    {

        if (isset($_GET['error'])) {
            setcookie('facebook_user_page_error', 'The user cancelled facebook login.', time() + 30, "/");
            return redirect('admin/manage-account');
        } else {
            $auth_user = Socialite::driver('facebook')->user();
            setcookie('facebook_user_token', $auth_user->token, time() + 30, "/");
            setcookie('facebook_user_id', $auth_user->id, time() + 30, "/");
            return redirect()->to('/facebook-user-profile');
        }
    }

    public function twitter()
    {
        if (isset($_GET['denied'])) {
            setcookie('twittererror', 'The user cancelled twitter login', time() + 30, "/");
            return redirect('admin/manage-account');
        } else {
            $user = Socialite::driver('twitter')->user();
            if ($user->token) {
                $r['token'] = $user->token;
                $r['account_key'] = $user->id;
                $r['account_name'] = $user->nickname;
                $r['token_secret'] = $user->tokenSecret;
                $r['account_type'] = 'twitter';
                $smTokenObj = new SocialMediaToken();
                $smTokenObj->addSocialMediaToken($r);
                setcookie('twitterSuccess', 'success', time() + 30, "/");
                return redirect('admin/manage-account');
            } else {
                setcookie('twittererror', 'something wrong happen,please try again', time() + 30, "/");
                return redirect('admin/manage-account');
            }
        }
        //$this->token_responce('twitter');
    }

    function fbShare($user_id, $post_id)
    {
        //  $user_id=1;

        $smTokenObj = new SocialMediaToken();
        $users = $smTokenObj->getUserToken($user_id, 'facebook');

        if (!$users)
            return response()->json(['status' => 'failed', 'msg' => 'Facebook token not available.', 'data' => []]);

        $smPostObj = new SocialMedia();
        $smPost = $smPostObj->getPost($post_id, $user_id);

        foreach ($users as $user) {
            $facebook = new Facebook();
            //$facebook->setDefaultAccessToken($_COOKIE['facebook_user_token']);
            try {
                $data = ['message' => $smPost['message'],
                    'link' => 'www.google.com'];

                $this->responses = $facebook->post("/$user->account_id/feed",
                    $data,
                    $user->token);

            } catch (\Exception $e) {
                return response()->json(['status' => 'failed', 'msg' => "Graph returned an error :" . $e->getMessage(), 'data' => []]);
            }
        }
        $updateStatus = SocialMedia::where(['user_id' => $user_id, 'id' => $post_id])->update(['status' => 'posted']);
        if ($updateStatus)
            return true;
        else
            return false;
    }

    function twShare($user_id, $post_id)
    {

        $smTokenObj = new SocialMediaToken();
        $user = $smTokenObj->getUserToken(1, 'twitter');

        if (!$user)
            return response()->json(['status' => 'failed', 'msg' => 'Twitter token not available.', 'data' => []]);

        $smPostObj = new SocialMedia();
        $smPost = $smPostObj->getPost($post_id, $user_id);

        $connection = new TwitterOAuth(env('TWITTER_APP_ID'), env('TWITTER_APP_SECRET'), $user->token, $user->token_secret);
        $connection->setTimeouts(100, 150);
        $path = $_SERVER['DOCUMENT_ROOT'] . config('app.document_root');

        $image = $path . $smPost['file_name'];

        $status = $connection->upload('media/upload', ['media' => $image]);

        //$post = $article['data']->title . "\n\n" . $article['data']->description;
        $post = substr($smPost['message'], 0, 200);
//        $post = $request->input('title') . "\n\n" . $request->input('description') . "\n\n\n " . $request->input('link');
//$isTweet = $connection->post('statuses/update', array('status' => strip_tags($post)));

        if (isset($status->media_id)) {
            $isTweet = $connection->post('statuses/update', array('status' => strip_tags($post), 'media_ids' => $status->media_id));

            $error = (array)$isTweet;
            if ($isTweet) {
                if (isset($error['errors'])) {
                    return false;
                }
                $updateStatus = SocialMedia::where(['user_id' => $user_id, 'id' => $post_id])->update(['status' => 'posted']);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function autoShareArticleCron()
    {
        ini_set('max_execution_time', 0); //0=NOLIMIT
        set_time_limit(0);
        //   Storage::disk('local')->put('file.txt', date('Y-m-d h:i:s'));


            $socialMediaPosts = SocialMedia::join('social_media_files as smf', 'smf.social_media_id', '=', 'social_media.id')
                ->whereDate('deliver_date', '>=', Carbon::now())
                ->where(['deliver_to' => 'post_later','status'=>'pending'])
                ->get(['social_media.id as sm_id', 'user_id', 'accounts', 'message', 'smf.file_name']);

            foreach ($socialMediaPosts as $socialMediaPost) {
                $accounts = explode(',', $socialMediaPost->accounts);
                foreach ($accounts as $pst) {
                    if ($pst == 'facebook') {
                        $smTokenObj = new SocialMediaToken();
                        $users = $smTokenObj->getUserToken(1, 'facebook');
                        foreach ($users as $user) {
                            $facebook = new Facebook();
                            //$facebook->setDefaultAccessToken($_COOKIE['facebook_user_token']);
                            try {
                                $data = ['message' => $socialMediaPost['message'],
                                    'link' => 'www.google.com'];

                                $this->responses = $facebook->post("/$user->account_id/feed",
                                    $data,
                                    $user->token);

                            } catch (\Exception $e) {
                                //return response()->json(['status' => 'failed', 'msg' => "Graph returned an error :".$e->getMessage(),'data'=>[]]);
                            }
                        }
                      //  $updateStatus = SocialMedia::where(['user_id' => $user_token->user_id, 'id' => $socialMediaPost->sm_id])->update(['status' => 'posted']);
                    } elseif ($pst == 'twitter') {

                        $smTokenObj = new SocialMediaToken();
                        $user = $smTokenObj->getUserToken(1, 'twitter');
                        $connection = new TwitterOAuth(env('TWITTER_APP_ID'), env('TWITTER_APP_SECRET'), $user->token, $user->token_secret);
                        $connection->setTimeouts(100, 150);
                      //  $path = $_SERVER['DOCUMENT_ROOT'] . config('app.document_root');
                        $path =getcwd(). config('app.document_root');
                        $path= str_replace('\\', '/', $path);

                        $image = $path . $socialMediaPost['file_name'];

                        $status = $connection->upload('media/upload', ['media' => $image]);


                        $post = substr($socialMediaPost['message'], 0, 200);
                        if (isset($status->media_id)) {
                            $isTweet = $connection->post('statuses/update', array('status' => strip_tags($post), 'media_ids' => $status->media_id));
                            $error = (array)$isTweet;
                            if ($isTweet) {
                                if (isset($error['errors'])) {
                                    //  return false;
                                }
                            }
                        }
                    }
                }
                $updateStatus = SocialMedia::where(['user_id' => 1, 'id' => $socialMediaPost->sm_id])->update(['status' => 'posted']);
            }
        }
}
