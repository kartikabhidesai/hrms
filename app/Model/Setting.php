<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Users;
use App\Model\Setting;
use PDF;
use Config;

class Setting extends Model {
    protected $table = 'setting';
    protected $fillable = ['id', 'site_title', 'site_tagline', 'email', 'timezone', 'dateformate','weekstart','language', 'created_at', 'updated_at'];
    public function saveSetting($request){
//        print_r($request->input());exit;
        $saveSetting=Setting::firstOrNew(array('id'=>'1'));
        $saveSetting->site_title=$request->input('site_title');
        $saveSetting->site_tagline=$request->input('site_tagline');
        $saveSetting->email=$request->input('email');
        $saveSetting->timezone=$request->input('timezone');
        
        $saveSetting->dateformate=$request->input('dateformate');

        if($request->input('dateformate') == '4'){
            $saveSetting->customdate=$request->input('customdate');
        }else{
            $saveSetting->customdate='';
        }
        
        $saveSetting->timeformate=$request->input('timeformate');

        if($request->input('timeformate') == '3'){
            $saveSetting->customtime=$request->input('custometime');
        }  else{
            $saveSetting->customtime='';
        } 

        $saveSetting->weekstart=$request->input('startweek');
        $saveSetting->language=$request->input('language');
        $saveSetting->siteurl=$request->input('site_address');
        return($saveSetting->save());
    }
    
    public function getSetting(){
        return Setting::select("*")
                ->where('id','1')->get();
    }
}
