<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Systemsetting extends Model {

    protected $table = 'system_settings';
    protected $fillable = ['system_name', 'system_title', 'address', 'phone_number', 'email', 'language', 'image', 'company_id'];

    public function getSystemSetting()
    {
        $data = Systemsetting::select("*")->first();
        if($data) {
            return $data;
        } else {
            return null;
        }
    }

    public function addSystemSetting($request, $Companyid)
    {
        
        $name = '';
        $objsys = Systemsetting::firstOrNew(array('company_id' => $Companyid));
        $objsys->system_name = $request->system_name;
        $objsys->system_title = $request->system_title;
        $objsys->address = $request->address;
        $objsys->phone_number = $request->phone_number;
        $objsys->email = $request->email;
        $objsys->language = $request->language;
        $objsys->company_id = $Companyid;
        $name = '';
        if ($request->file()) {
            $image = $request->file('image');
            $name = 'system_img' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/systems/');
            $image->move($destinationPath, $name);
             $objsys->image = $name;
        }

        
        $objsys->created_at = date('Y-m-d H:i:s');
        $objsys->updated_at = date('Y-m-d H:i:s');
        $objsys->save();
        if ($objsys) {
            return TRUE;
        } else {
            return false;
        }
    }
    
    public function deleteImage($request){
        $result = DB::table('system_settings')
                    ->where('company_id',$request['id'])
                    ->update(['image' => null,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
        
        if($result){
            if(file_exists(public_path('/uploads/systems/'.$request['image']))){
                unlink(public_path('/uploads/systems/'.$request['image']));
                return true;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
}
