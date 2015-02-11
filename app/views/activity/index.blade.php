
@extends('layouts.master')
@section('title') 
@parent - Activity
@stop
@section('content') 
<div id="cl-wrapper" style="opacity: 1; margin-left: 0px;">
    @include('layouts.sidebar')
    <div id="activity" class="container-fluid">
        <div class="row" style="padding: 10px 50px 50px;">
            <div class="col-sm-3 col-md-3">
                <select class="form-control" id="year">
                    @foreach($years as $i => $year)
                    <option value="{{$year}}">{{$year}}</option>
                    @endforeach
                </select>                                    
            </div>
            <div class="col-sm-6 col-md-6">
                <select class="form-control" id="quarter">
                    <option value="">-- Select Quarter --</option>
                    @foreach($quarter as $key => $val)
                    <option value="{{$key}}">{{$val}}</option>
                    @endforeach
                </select>                                    
            </div>
        </div>  
        <div class="row">      
            <div class="tab-container">
                <ul class="nav nav-tabs">
                    <li><a data-toggle="tab" data-page="income" href="#">Income</a></li>
                    <li><a data-toggle="tab" data-page="purchase" href="#">Purchases</a></li>
                    <li><a data-toggle="tab" data-page="generatebas" href="#">Generate BAS</a></li>
                </ul>
                <div class="tab-content" id="tab-content">
                </div>
            </div>
        </div>                                       
    </div>    
</div> 
@stop