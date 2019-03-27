<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use auth;
use App\Model\UserHasPermission;
use App\Model\Users;
use App\Model\Client;

class Client extends Model {

    protected $table = 'client';

    public function addClientData($request, $logedcompanyId) {

       
        $objClient = new Client();
        $objClient->company_id = $logedcompanyId;
        $objClient->name = $request->input('name');
        $objClient->national_id = $request->input('national_id');
        $objClient->work = $request->input('work');
        $objClient->company = $request->input('comapany');
        $objClient->email = $request->input('email');
        $objClient->street = $request->input('street');
        $objClient->bank = $request->input('bank');
        $objClient->city = $request->input('city');
        $objClient->iban = $request->input('iban');
        $objClient->phone_number = $request->input('phone_number');
        $objClient->mobile_number = $request->input('mobile_number');
        $objClient->state = $request->input('state');
        $objClient->account_number = $request->input('account_number');
        $objClient->zipcode = $request->input('zipcode');
        $objClient->country = $request->input('country');
        $objClient->date_of_joining = date("Y-m-d", strtotime($request->input('date_of_joining')));

        return ($objClient->save());
    }

}
