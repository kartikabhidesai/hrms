<?php

namespace App\Console\Commands;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Model\SocialMedia;
use App\Model\SocialMediaToken;
use Carbon\Carbon;
use Facebook\Facebook;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SocialMediaCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'socialMeida:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'AUTO SHARE POST';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('max_execution_time', 0); //0=NOLIMIT
        set_time_limit(0);



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
                    $path =getcwd() .config('app.document_root');
                    $path= str_replace('\\', '/', $path);

                    $image = $path . $socialMediaPost['file_name'];
                    Storage::disk('local')->put('file.txt', $image);
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
