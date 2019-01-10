@extends('layouts.login_layout')
@section('content')
    <div class="passwordBox animated fadeInDown">
        <div class="row">
            <div class="col-md-12">
                <div id="errorSection" style="width:100% !important;">
                    @if (session('session_error'))
                        <div class="alert alert-danger">
                            {{ session('session_error') }}
                            <div class="pull-right closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
                        </div>
                    @endif

                    @if (session('session_success'))
                        <div class="alert alert-success">
                            {{ session('session_success') }}
                            <div class="pull-right closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
                        </div>
                    @endif

                    @if (session('session_alert'))
                        <div class="alert alert-warning">
                            {{ session('session_alert') }}
                            <div class="pull-right closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
                        </div>
                    @endif
                </div>

                <div class="ibox-content">
                    <h2 class="font-bold">Forgot password</h2>
                    <p>
                        Enter your email address and your password will be reset and emailed to you.
                    </p>
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="m-t" role="form" id="forgot-password" method="POST" action="{{ route('forgot-password') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email address" required="">
                                </div>
                                <button type="submit" class="btn btn-primary block full-width m-b">Send new password</button>
                            </form>
                            <a href="{{ route('login') }}"><small style="margin-left: 155px;">Back to Login</small></a>
                            <p class="m-t" style="text-align: center;"> <small>HRMS  &copy; {{ date('Y') }}</small> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

