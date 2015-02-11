@extends('layouts.master')
@section('title')
@parent - Register
@stop
@section('content')
<div id="cl-wrapper" class="login-container sign-up">
    <div class="middle-login">
        @include('auth.logo');
        <div class="block-flat">
            <div class="header">                            
                <h4 class="text-center">SIGN UP</h4>
            </div>
            <div>
                <form id="form" style="margin-bottom: 0px !important;" class="form-horizontal" method="POST" action="{{ URL::to('user/register') }}" accept-charset="UTF-8"  parsley-validate novalidate>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="content">
                        <div class="row text-center" style="font-style: italic;">
                            <p>Enjoy the most simple way to manage your business,
 with no commitments and bank grade security.</p>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <label>EMAIL</label>
                                <input type="email" name="email" id="email" required="" parsley-error-container="#email-error" parsley-trigger="change" class="parsley-validated">
                                <div id="email-error"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <label class="large-8 columns">PASSWORD</label>
                                <label class="large-4 columns show-password" data-show="password">Show password</label>
                                <input type="password" name="password" id="password" required="" parsley-error-container="#password-error" parsley-trigger="change" class="parsley-validated">
                                <div id="password-error"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <button class="button expand" type="submit">SIGN UP</button>
                            </div>
                        </div>
                        <div class="row" style="text-align: center;">
                            <p style="font-style:italic;font-family: 'GeorgiaPro-Regular';">Already have an account ? <a href="{{ URL::to('user/login') }}" type="button">Login!</a></p>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="text-center out-links"><a href="{{ URL::to('/'); }}">&copy; 2014 rounded.com.au</a></div>
    </div> 
</div>

@if(count($errors->all()) > 0 )
{{--*/ $msg = $errors->all() /*--}}
@include('include.message.default', array('message' => $msg)) 
@endif
@stop