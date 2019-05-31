@extends('layouts.app')
@section('content')

<style type="text/css">
    .my-read-only-class 
    {   
       cursor: not-allowed;
    }
</style>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <div class="space-25"></div>
                        <h5>Folders</h5>
                        <ul class="folder-list m-b-md" style="padding: 0">
                            <li><a href="{{ route('emp-communication') }}"> <i class="fa fa-inbox "></i> Inbox <span class="label label-warning pull-right">16</span> </a></li>
                            <!-- <li><a href="mailbox.html"> <i class="fa fa-envelope-o"></i> Send Mail</a></li>
                            <li><a href="mailbox.html"> <i class="fa fa-certificate"></i> Important</a></li>
                            <li><a href="mailbox.html"> <i class="fa fa-file-text-o"></i> Drafts <span class="label label-danger pull-right">2</span></a></li> -->
                            <li><a href="#"> <i class="fa fa-trash-o"></i> Trash</a></li>
                            <li><a href="{{ route('emp-send-mail') }}"> <i class="fa fa-reply"></i> Send</a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <!-- <div class="pull-right tooltip-demo">
                    <a href="#" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a>
                    <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Discard email"><i class="fa fa-times"></i> Discard</a>
                </div> -->
                <h2>
                    Compose mail
                </h2>
            </div>
            {{ Form::open(array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'new_communication')) }} 

                @if(isset($communication_id) && $communication_id != '')
                    <input type="hidden" name="communication_id" value="{{$communication_id}}">
                @endif

                <div class="mail-box">
                    <div class="mail-body">
                        <form class="form-horizontal" method="get">
                            <div class="form-group"><label class="col-sm-2 control-label">To :</label>
                                <div class="col-sm-5">
                                    @if(isset($CommunicationData))
                                        <input type="hidden" name="mail_to" value="{{$CommunicationData->send_by}}">
                                    @endif
                                    <select class="form-control" required="required" name="mail_to" id="mail_to" {{isset($CommunicationData)?'disabled="disabled"':''}}>
                                        <option value="">Select</option>
                                        <option value="company" {{$CommunicationData->send_by=='COMPANY'?'selected':''}}>Company</option>
                                        <option value="employee" {{$CommunicationData->send_by=='EMPLOYEE'?'selected':''}}>Employee</option>
                                    </select>
                                </div>
                            </div>


                            @if(isset($CommunicationData))

                                @if($CommunicationData->send_emp_id != '' && $CommunicationData->send_emp_id != 0 && $CommunicationData->send_by == 'EMPLOYEE')

                                    <div class="form-group" id="emp_div"><label class="col-sm-2 control-label">Employees :</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="emp_id" value="{{$CommunicationData->send_emp_id}}">
                                            <select class="form-control" required="required" name="emp_id" id="emp_id" disabled="disabled">
                                                <option value="">Select</option>
                                                @if(isset($companyEmployees) && !empty($companyEmployees))
                                                    @foreach($companyEmployees as $key => $val)
                                                        @if($CommunicationData->send_emp_id == $val->id)
                                                            <option value="{{$val->id}}" selected="selected">{{$val->name}}</option>
                                                        @else
                                                            <option value="{{$val->id}}">{{$val->name}}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <option value="">No data found.</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                @else

                                @endif

                            @else

                                <div class="form-group" id="emp_div"><label class="col-sm-2 control-label">Employees :</label>
                                    <div class="col-sm-5">
                                        <select class="form-control" required="required" name="emp_id" id="emp_id">
                                            <option value="">Select</option>
                                            @if(isset($companyEmployees) && !empty($companyEmployees))
                                                @foreach($companyEmployees as $key => $val)
                                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                                @endforeach
                                            @else
                                                <option value="">No data found.</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                            @endif

                            <div class="form-group"><label class="col-sm-2 control-label">Subject:</label>
                                <div class="col-sm-10">
                                    @if(isset($communication_id) && $communication_id != '')
                                        <input type="text" class="form-control subject" name="subject" value="{{ $CommunicationData->subject ? $CommunicationData->subject : 'N.A.' }}" readonly>
                                    @else
                                        <input type="text" class="form-control subject" name="subject" value="">
                                    @endif
                                </div>
                            </div>

                            <div class="form-group"><label class="col-sm-2 control-label">File:</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control file" name="file">
                                </div>
                            </div>
                        </form>
                    </div>

                     <div class="mail-text h-200">
                        <!-- <div class="summernote"> -->
                            <textarea rows="5" cols="125" name="summernote" class="summernote"></textarea>
                            <!-- <br><br><br><br><br><br><br> -->
                        <!-- </div> -->
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="mail-body text-right tooltip-demo">
                        <!-- <a href="#" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Send"><i class="fa fa-reply"></i> Send</a> -->
                        <button class="btn btn-sm btn-primary sendMail" type="submit" data-toggle="tooltip" data-placement="top" title="Send"><i class="fa fa-reply"></i>Send</button>

                        <!-- <a href="#" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
                        <a href="#" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a> -->
                    </div>
                    <div class="clearfix"></div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<style>
    .note-editor.note-frame {
        border: 0px solid #a9a9a9; 
    }
    </style>
@endsection
