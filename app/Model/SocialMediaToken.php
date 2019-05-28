<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SocialMediaToken extends Model
{
    protected $table='social_media_token';
	
	function addSocialMediaToken($r){
		$obj=new SocialMediaToken();
		$obj->user_id=1;
		$obj->account_name=$r['account_name'];
		$obj->account_key=$r['account_key'];
		$obj->token=$r['token'];
		$obj->account_type=$r['account_type'];
		$obj->token_secret=(isset($r['token_secret'])?$r['token_secret']:'');
				
		if($obj->save())
			return true;
		else
			return false;
	}
	function getUserToken($user_id,$sm_type){
		if($sm_type=='facebook')
			$user_sm_token=SocialMediaToken::where(['user_id'=>$user_id,'account_type'=>'facebook'])->get();
		else
			$user_sm_token=SocialMediaToken::where(['user_id'=>$user_id,'account_type'=>'twitter'])->first();
	
	return $user_sm_token;
	}
	
	
		
}
