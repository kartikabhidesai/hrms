@extends('layouts.login_layout')
@section('content')
<div class="o-page__card o-page--center">
    <div class="c-card u-mb-xsmall">
        <header class="c-card__header u-pt-large">
            <a class="c-card__icon" href="#!">
                <img src="{{ asset('img/logo-login.svg') }}" alt="Dashboard UI Kit">
            </a>
            <h1 class="u-h3 u-text-center u-mb-zero">{{ trans('forgot.forgot_your_password') }}</h1>
            <p class="u-h6 u-text-mute"> {{ trans('forgot.receive_password') }} </p>
        </header>

        <form class="form-horizontal c-card__body" id="forgot-password" method="POST" action="{{ route('forgot-password') }}">
            {{ csrf_field() }}
            <div class="c-field u-mb-small ">
                <label class="c-field__label" for="input1">{{ trans('forgot.e-mail') }}</label> 
                <input class="c-input" type="email" name="email" value="" id="input1" placeholder="clark@dashboard.com"> 
            </div>
            <button class="c-btn c-btn--info c-btn--fullwidth" type="submit">{{ trans('forgot.forgot_password') }}</button>
        </form>
    </div>
    <div class="o-line">
        <a class="u-text-mute u-text-small" href="{{ route('login') }}"> {{ trans('forgot.go_login') }}</a>
    </div>
</div>
@endsection
