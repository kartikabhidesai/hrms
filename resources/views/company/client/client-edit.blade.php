@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Client</h5>
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
                            {{ Form::text('name', $client_detail->name, array('placeholder'=>'Name', 'class' => 'form-control' ,'required')) }}
                        </div>
                        <div class="col-lg-5">
                            <span><strong>Contact Info</strong></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label">National Id</label>
                        <div class="col-lg-5">
                            {{ Form::text('national_id', $client_detail->national_id, array('placeholder'=>'National_id', 'class' => 'form-control' ,'required')) }}
                        </div>
                        <label class="col-lg-1 control-label">Phone Number</label>
                        <div class="col-lg-5">
                            {{ Form::text('phone_number', $client_detail->phone_number, array('placeholder'=>'Phone Number', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label">Work</label>
                        <div class="col-lg-5">
                            {{ Form::text('work', $client_detail->work, array('placeholder'=>'Work', 'class' => 'form-control' ,'required')) }}
                        </div>
                        <label class="col-lg-1 control-label">Mobile Number</label>
                        <div class="col-lg-5">
                            {{ Form::text('mobile_number', $client_detail->mobile_number, array('placeholder'=>'Mobile Number', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label">Company</label>
                        <div class="col-lg-5">
                            {{ Form::text('comapany', $client_detail->company, array('placeholder'=>'Comapany', 'class' => 'form-control' ,'required')) }}
                        </div>
                        <label class="col-lg-1 control-label">Email</label>
                        <div class="col-lg-5">
                            {{ Form::text('email', $client_detail->email, array('placeholder'=>'Email', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="form-group" id="data_2">
                            <label class="col-sm-1 control-label">DOJ</label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value="{{$client_detail->date_of_joining}}"name="date_of_joining" id="date_of_joining"  class="form-control date_of_joining" placeholder="Expiry Date" autocomplete="off">
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
                            {{ Form::text('street', $client_detail->street, array('placeholder'=>'Street', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label">Bank</label>
                        <div class="col-lg-5">
                            {{ Form::text('bank', $client_detail->bank, array('placeholder'=>'Bank', 'class' => 'form-control' ,'required')) }}
                        </div>
                        <label class="col-lg-1 control-label">City</label>
                        <div class="col-lg-5">
                            {{ Form::text('city', $client_detail->city, array('placeholder'=>'City', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label">IBAN</label>
                        <div class="col-lg-5">
                            {{ Form::text('iban', $client_detail->iban, array('placeholder'=>'IBAN', 'class' => 'form-control' ,'required')) }}
                        </div>
                        <label class="col-lg-1 control-label">State</label>
                        <div class="col-lg-5">
                            {{ Form::text('state', $client_detail->state, array('placeholder'=>'State', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label">Account Number</label>
                        <div class="col-lg-5">
                            {{ Form::text('account_number', $client_detail->account_number, array('placeholder'=>'Account Number', 'class' => 'form-control' ,'required')) }}
                        </div>
                        <label class="col-lg-1 control-label">Zip Code</label>
                        <div class="col-lg-5">
                            {{ Form::text('zipcode', $client_detail->zipcode, array('placeholder'=>'Zip COde', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label"></label>
                        <div class="col-lg-5">
                        </div>
                        <label class="col-lg-1 control-label">Country</label>
                        <div class="col-lg-5">
                            {{ Form::text('country', $client_detail->country, array('placeholder'=>'Country', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        
                        <div class="col-lg-5 pull-right">
                            <button class="btn btn-sm btn-primary" type="submit"> Edit Client</button>
                        </div>
                    </div>



                    {{ Form::close() }}
                </div>
            </div>
        </div>  

    </div>
</div>

@endsection