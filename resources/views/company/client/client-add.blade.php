@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add New CLient</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'addClient' )) }}
                    <div class="form-group">
                        <label class="col-lg-1 control-label">Name</label>
                        <div class="col-lg-5">
                            {{ Form::text('name', null, array('placeholder'=>'Name', 'class' => 'form-control' ,'required')) }}
                        </div>
                        <div class="col-lg-5">
                            <span><strong>Contact Info</strong></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label">National Id</label>
                        <div class="col-lg-5">
                            {{ Form::text('national_id', null, array('placeholder'=>'National_id', 'class' => 'form-control' ,'required')) }}
                        </div>
                        <label class="col-lg-1 control-label">Phone Number</label>
                        <div class="col-lg-5">
                            {{ Form::text('phone_number', null, array('placeholder'=>'Phone Number', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label">Work</label>
                        <div class="col-lg-5">
                            {{ Form::text('work', null, array('placeholder'=>'Work', 'class' => 'form-control' ,'required')) }}
                        </div>
                        <label class="col-lg-1 control-label">Mobile Number</label>
                        <div class="col-lg-5">
                            {{ Form::text('mobile_number', null, array('placeholder'=>'Mobile Number', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label">Company</label>
                        <div class="col-lg-5">
                            {{ Form::text('comapany', null, array('placeholder'=>'Comapany', 'class' => 'form-control' ,'required')) }}
                        </div>
                        <label class="col-lg-1 control-label">Email</label>
                        <div class="col-lg-5">
                            {{ Form::text('email', null, array('placeholder'=>'Email', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="form-group" id="data_2">
                            <label class="col-sm-1 control-label">DOJ</label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="date_of_joining" id="date_of_joining"  class="form-control date_of_joining" placeholder="Expiry Date" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <span><strong>Address Info</strong></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-1 control-label"></label>

                        <div class="col-lg-5">
                            <label class="col-lg-5 control-label">Bank Info</label>

                        </div>
                        <label class="col-lg-1 control-label">Street</label>
                        <div class="col-lg-5">
                            {{ Form::text('street', null, array('placeholder'=>'Street', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label">Bank</label>
                        <div class="col-lg-5">
                            {{ Form::text('bank', null, array('placeholder'=>'Bank', 'class' => 'form-control' ,'required')) }}
                        </div>
                        <label class="col-lg-1 control-label">City</label>
                        <div class="col-lg-5">
                            {{ Form::text('city', null, array('placeholder'=>'City', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label">IBAN</label>
                        <div class="col-lg-5">
                            {{ Form::text('iban', null, array('placeholder'=>'IBAN', 'class' => 'form-control' ,'required')) }}
                        </div>
                        <label class="col-lg-1 control-label">State</label>
                        <div class="col-lg-5">
                            {{ Form::text('state', null, array('placeholder'=>'State', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label">Account Number</label>
                        <div class="col-lg-5">
                            {{ Form::text('account_number', null, array('placeholder'=>'Account Number', 'class' => 'form-control' ,'required')) }}
                        </div>
                        <label class="col-lg-1 control-label">Zip Code</label>
                        <div class="col-lg-5">
                            {{ Form::text('zipcode', null, array('placeholder'=>'Zip COde', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label"></label>
                        <div class="col-lg-5">
                        </div>
                        <label class="col-lg-1 control-label">Country</label>
                        <div class="col-lg-5">
                            {{ Form::text('country', null, array('placeholder'=>'Country', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        
                        <div class="col-lg-5 pull-right">
                            <button class="btn btn-sm btn-primary" type="submit">Add New Client</button>
                        </div>
                    </div>



                    {{ Form::close() }}
                </div>
            </div>
        </div>  

    </div>
</div>

@endsection