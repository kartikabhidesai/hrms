@extends('layouts.login_layout')
@section('content')
<div class="o-page__card o-page--center">
    <div class="c-card u-mb-xsmall">
        <header class="c-card__header u-pt-large">
            <a class="c-card__icon" href="#!">
                <img src="{{ asset('img/logo-login.svg') }}" alt="Dashboard UI Kit">
            </a>
            <h1 class="u-h3 u-text-center u-mb-zero">Welcome back! Please register.</h1>
        </header>
        
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

        <form class="form-horizontal c-card__body register" id="register" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="first_name">First Name</label> 
                        <input class="c-input" type="text" name="first_name" id="first_name" placeholder="First Name"> 
                    </div>
                    
                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="last_name">Last Name</label> 
                        <input class="c-input" type="text" name="last_name" id="last_name" placeholder="Last Name"> 
                    </div>
                    
                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input1">E-mail address</label> 
                        <input class="c-input" type="email" name="email" id="input1" placeholder="clark@dashboard.com"> 
                    </div>
                    
                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="password">Password</label> 
                        <input class="c-input" type="password" name="password" id="password" placeholder="Numbers, Letters..."> 
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="cpassword">Confirm Password</label> 
                        <input class="c-input" type="password" name="cpassword" id="cpassword" placeholder="Confirm Password"> 
                    </div>
                    <button class="c-btn c-btn--info c-btn--fullwidth" type="submit">Sign Up</button>
        </form>
    </div>

    <div class="o-line">
        <a class="u-text-mute u-text-small" href="{{ route('login') }}">Goto Login</a>
    </div>
</div>

<style>
    .alert {
    margin: 0px 10px;
    }
    .alert-danger{
       background-color: #fc9680; 
    }
    .alert-success{
       background-color: #8ddd72; 
    }
    .alert-warning{
       background-color: #f2ec89; 
    }
</style>
@endsection
