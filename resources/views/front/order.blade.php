@extends('layouts.login_layout')
@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
          
            <h3>Welcome to HRMS SAAS</h3>
            <p>Make your Order</p>
            <div id="errorSection" style="width:100% !important;">

        </div>
            <form class="m-t" role="form" id="order" method="POST" action="{{ route('order') }}">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Company Name" name="company_name" autofocus>
                </div>
                
                <div class="form-group">
                    <select name="subcription" class="form-control" >
                        @foreach($subcription as $key=>$val)
                        <option value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                    <!--{{ Form::select('subcription', $subcription, null, array('class' => 'form-control m-b', 'id' => 'status','required')) }}-->
                </div>
                
                <div class="form-group">
                    <select name="request_type" class="form-control" >
                        @foreach($request_type as $key=>$val)
                        <option value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                    
                    <!--{{ Form::select('request_type', $request_type, null, array('class' => 'form-control m-b', 'id' => 'status','required')) }}-->
                </div>
                
                
                
                <div class="form-group">
                    <select name="payment_type" class="form-control" >
                        @foreach($payment_type as $key=>$val)
                        <option value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                    <!--{{ Form::select('payment_type', $payment_type, null, array('class' => 'form-control m-b', 'id' => 'status','required')) }}-->
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            </form>
            <p class="m-t"> <small>HRMS  &copy; {{ date('Y') }}</small> </p>
        </div>
    </div>
@endsection
