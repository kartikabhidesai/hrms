<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\Users;
use App\Model\TicketAttahcments;
use PDF;
use Config;
use File;

class TicketAttachments extends Model
{
    protected $table = 'ticket_attachments';

    /*Relationship for deartment*/
    public function ticket()
    {
        return $this->belongsTo('App\Model\Ticket');
    }
    
    public function getDesignation()
    {
         $arrTicketAttachments = TicketAttahcments::
            // where('company_id', $company_id)
                pluck('file_attachment','id')
                ->toArray();
        return $arrTicketAttachments;
    }
}
