<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\UserHasPermission;
use App\Model\Communication;
use Config;
use Auth;
use DB;

class Communication extends Model
{
    protected $table = 'communication';

    protected $fillable = ['id', 'employee_id', 'company_id', 'message', 'is_read'];

    public function addNewCommunication($request, $companyId)
    {
        $file = '';
        $newCommnucation = new Communication();
        $newCommnucation->employee_id = $request->emp_id;
        $newCommnucation->company_id = $companyId;
        $newCommnucation->message = trim($request->summernote, '');
        if ($request->file('file')) {
            $image = $request->file('file');
            $file = 'communication' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/communication/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image->move($destinationPath, $file);
            $newCommnucation->file = '/uploads/communication/'.$file;
        }
        $newCommnucation->is_read = 0;
        $newCommnucation->created_at = date('Y-m-d H:i:s');
        $newCommnucation->created_at = date('Y-m-d H:i:s');
        $newCommnucation->save();
        return TRUE;
    }

    public function employeeEmailsForCommunication($empId)
    {
        $getListOfEmailOfEmp = Communication::select('comapnies.company_name', 'communication.id', 'communication.employee_id', 'communication.message', 'communication.file', 'communication.is_read', 'communication.created_at')
                                        ->join('comapnies', 'communication.company_id', '=', 'comapnies.id')
                                        ->where('communication.employee_id', $empId)
                                        ->get();

        if(count($getListOfEmailOfEmp) > 0) {
            return $getListOfEmailOfEmp;
        } else {
            return null;
        }
    }
}
