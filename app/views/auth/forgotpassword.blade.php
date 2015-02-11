@extends('layouts.master')
@section('title')
@parent - Login
@stop
@section('content')
<div id="cl-wrapper" class="login-container forgotpassword">
    <div class="middle-login">
        @include('auth.logo');
        <div class="block-flat row">
            <div class="header">                            
                <h4 class="text-center">FORGOT PASSWORD ?</h4>
            </div>
            <div>
                <form style="margin-bottom: 0px !important;" method="POST" action="{{ URL::to('user/forgotpassword') }}" accept-charset="UTF-8" parsley-validate novalidate>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="content">
                        <div class="row">
                            <div class="large-12 columns">
                                <label>EMAIL</label>
                                <input type="email" name="email" id="email" required="" parsley-error-container="#email-error" parsley-trigger="change" class="parsley-validated">
                                <div id="email-error"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <button class="button expand" type="submit">RESET PASSWORD</button>
                            </div>
                        </div>
                        <div class="row" style="text-align: center;">
                            <p style="font-style:italic;font-family: 'GeorgiaPro-Regular';"><a href="{{ URL::to('user/login') }}" type="button">Back to Login</a></p>
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

