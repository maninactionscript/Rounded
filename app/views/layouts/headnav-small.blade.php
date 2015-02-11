{{--*/ $name = $user->businessDetail ? explode(' ',$user->businessDetail->name) : '' /*--}}
<div class="navbar navbar-default nav-small" id="head-nav">
    <div class="container-fluid">
        <div class="navbar-collapse">
            <div class="large-12">
                <div class="large-4" style="float: left;">
                    @if(isset($setting) && $setting === true) 
                    <span class="jcon jcon-setting" style="display: inline-block; padding: 4px; margin-right: 0px;">&nbsp;</span>
                    @endif
                    
                    @if(isset($newInvoice) && $newInvoice === true) 
                    <a href="#" class="page_back" style="color: rgb(128, 128, 128); margin-right: 5px; font-size: 15px;"><i class="fa fa-chevron-left"></i></a>
                    <span class="jcon jcon-invoice" style="display: inline-block; padding: 4px; margin-right: 0px;">&nbsp;</span>
                    @endif
                    
                    <span id="jpage-title">{{ $title }} </span>
                    
                    @if(isset($invoiceNumber))
                    <span style="font-size:18px" id="invoice_number">{{ $invoiceNumber }}</span>
                    @endif
                    @if(isset($client) && $client === true)
                    <span><button class="button right-slider" data-form="client">add client</button></span>
                    @endif
                    @if(isset($setting) && $setting === true) 
                    <span><button class="button success btn-primary save_setting" style="margin-bottom: 0;">save details</button></span>
                    @endif
                    @if(isset($invoices) && $invoices === true) 
                    <span><a href="#" class="button btn-primary" data-client="0" data-page="invoice">new invoice</a></span>
                    @endif
                </div>
                <ul class="nav navbar-nav navbar-right user-nav">
                    @include('layouts.notification')
                    <li class="dropdown profile_menu">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><img src="{{ URL::to('assets/images/noavatar.jpg') }}" alt="Avatar"><span id="fullname">{{ $user->businessDetail ? $user->businessDetail->name : ' '}}</span><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a data-page="accountSettings" href="#">My Account</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ URL::to('user/logout') }}">Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>            
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".nscroller").nanoScroller({ preventPageScrolling: true });
  </script>