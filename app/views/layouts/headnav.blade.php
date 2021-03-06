{{-- */ $name = $user->businessDetail ? explode(' ',$user->businessDetail->name) : '' /*--}}
<div class="navbar navbar-default" id="head-nav">
    <div class="container-fluid">
        <div class="navbar-collapse">
            <ul class="nav navbar-nav navbar-right user-nav">
                @include('layouts.notification')
                <li class="dropdown profile_menu">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img src="{{ URL::to('assets/images/noavatar.jpg') }}" alt="Avatar">
                    <span id="fullname">{{ $user->businessDetail ? $user->businessDetail->name : ' '}}</span> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a data-page="accountSettings" href="#">My Account</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ URL::to('user/logout') }}">Sign Out</a></li>
                    </ul>
                </li>
            </ul>			
        </div><!--/.nav-collapse animate-collapse -->
    </div>
    <div class="row well-come text-center">
        <div class="large-12">
            <h5>{{ strtoupper(date('l, jS F Y')) }}</h5>
            <h2>Hi <span id="firstname">{{ isset($name[0]) ? $name[0] : '' }}</span>, Add something new...</h2>
        </div>
        <div class="large-12" style="margin-top: 1rem">
            <div class="medium-3 columns"><a class="button right-slider" data-form="income">INCOME</a></div>
            <div class="medium-3 columns"><a class="button right-slider" data-form="purchase">EXPENSE</a></div>
            <div class="medium-3 columns"><a data-page="invoice" data-client="0" class="button">INVOICE</a></div>
            <div class="medium-3 columns"><a class="button right-slider" data-form="client">NEW CLIENT</a></div>
        </div>
    </div>  
</div>
<script type="text/javascript">
    $(".nscroller").nanoScroller({ preventPageScrolling: true });
  </script>