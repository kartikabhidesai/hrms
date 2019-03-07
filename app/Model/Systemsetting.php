<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Systemsetting extends Model {

    protected $table = 'system_settings';
    protected $fillable = ['company_id'];

    public function addSystemSetting($request, $Companyid) {
        
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
        $objsys->save();
        if ($objsys) {
            return TRUE;
        } else {
            return false;
        }
    }

}
