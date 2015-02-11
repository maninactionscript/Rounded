<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('')}}/favicon.ico">
        <title>
            @section('title')
            BASR
            @show
        </title>
        @section('css')
        <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>-->
        <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/foundation/css/foundation.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/nanoscroller/nanoscroller.css')}}">
        <link rel="stylesheet" href="{{asset('assets/datepicker/css/datepicker3.css')}}">
        <link rel="stylesheet" href="{{asset('assets/jquery.niftymodals/css/component.css')}}">

            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="{{asset('assets/css/colpick.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
        <script src="{{asset('assets/foundation/js/vendor/modernizr.js')}}"></script>
        @show
        @section('jscode')
        <script type="text/javascript">
            window.baseurl = function(){
                var url = "{{ URL::to('') }}";
                return url;
            }
            window._token = function(){
                var token = "{{ csrf_token() }}";
                return token;
            }
            function number_format(number, decimals, dec_point, thousands_sep) {
                number = (number + '')
                .replace(/[^0-9+\-Ee.]/g, '');
                var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + (Math.round(n * k) / k)
                    .toFixed(prec);
                };
                // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
                .split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '')
                    .length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1)
                    .join('0');
                }
                return s.join(dec);
            }
        </script>
        @show 
        <!--<script type="text/javascript" src="//use.typekit.net/ncl2hfe.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>-->
    </head>
    @if(Request::is('user/*')) 
    {{--*/ $class = 'texture' /*--}}
    @else
    {{--*/ $class = 'animated cbp-spmenu-push' /*--}}
    @endif
    <body class="{{$class}}" spellcheck="false">
        @yield('content')

        @include('include/modal/default')
        <!--<script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>-->
        <script src="{{asset('assets/foundation/js/vendor/jquery.js')}}"></script>
        <script src="{{asset('assets/foundation/js/foundation.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/jquery.cookie.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/jquery-ui.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/jPushMenu.js')}}" ></script>
        <script type="text/javascript" src="{{asset('assets/nanoscroller/jquery.nanoscroller.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/jquery.niftymodals/js/jquery.modalEffects.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/datepicker/js/bootstrap-datepicker.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/jquery.confirm.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/core.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/Chart.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/scrolltofixed.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/jquery.mousewheel.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/colpick.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/main.js')}}"></script>
        <script>
            $(document).foundation();
        </script>
        @yield('scripts')
	</body>
</html>
