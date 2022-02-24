<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Libs CSS
		============================================ -->
{{--    <link rel="stylesheet" href="{{url('/front/css/bootstrap/css/bootstrap.min.css')}}">--}}
    <link rel="stylesheet" href="{{url('/front/css/font-awesome/css/font-awesome.min.css')}}">
{{--    <link href="{{url('/front/js/datetimepicker/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">--}}
{{--    <link href="{{url('/front/js/owl-carousel/owl.carousel.css')}}" rel="stylesheet">--}}
    <link href="{{url('/front/css/themecss/lib.css')}}" rel="stylesheet">
    <link href="{{url('/front/js/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet">
    <link href="{{url('/front/js/minicolors/miniColors.css')}}" rel="stylesheet">
{{--    <link href="{{url('/front/js/slick-slider/slick.css')}}" rel="stylesheet">--}}

    <!-- Theme CSS
            ============================================ -->
    <link href="{{url('/front/css/themecss/so_sociallogin.css')}}" rel="stylesheet">
    <link href="{{url('/front/css/themecss/so_searchpro.css')}}" rel="stylesheet">
    <link href="{{url('/front/css/themecss/so_megamenu.css')}}" rel="stylesheet">
    <link href="{{url('/front/css/themecss/so-categories.css')}}" rel="stylesheet">
    <link href="{{url('/front/css/themecss/so-listing-tabs.css')}}" rel="stylesheet">
    <link href="{{url('/front/css/themecss/so-category-slider.css')}}" rel="stylesheet">
    <link href="{{url('/front/css/themecss/so-newletter-popup.css')}}" rel="stylesheet">
    <link href="{{url('/front/css/footer/footer1.css')}}" rel="stylesheet">
    <link href="{{url('/front/css/header/header1.css')}}" rel="stylesheet">
    <link id="color_scheme" href="{{url('/front/css/theme.css')}}" rel="stylesheet">
{{--    <link href="{{url('/front/css/responsive.css')}}" rel="stylesheet">--}}
    <link href="{{url('/front/css/quickview/quickview.css')}}" rel="stylesheet">
    <!-- Google web fonts
        ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:400,500,600,700,800&display=swap" rel="stylesheet">
    <style type="text/css">
        body{font-family: 'Libre Franklin', sans-serif;}
    </style>


    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>
<body class="common-home res layout-1">
    <div id="app">
        <router-view></router-view>
    </div>

    <!-- End Color Scheme
		============================================ -->
    <!-- Include Libs & Plugins
    ============================================ -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="{{url('/front/js/jquery-2.2.4.min.js')}}"></script>
{{--    <script type="text/javascript" src="{{url('/front/js/bootstrap.min.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{url('/front/js/themejs/so_megamenu.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{url('/front/js/owl-carousel/owl.carousel.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{url('/front/js/slick-slider/slick.js')}}"></script>--}}
    <script type="text/javascript" src="{{url('/front/js/themejs/libs.js')}}"></script>
{{--    <script type="text/javascript" src="{{url('/front/js/unveil/jquery.unveil.js')}}"></script>--}}
    <script type="text/javascript" src="{{url('/front/js/countdown/jquery.countdown.min.js')}}"></script>
{{--    <script type="text/javascript" src="{{url('/front/js/dcjqaccordion/jquery.dcjqaccordion.2.8.min.js')}}"></script>--}}
    <script type="text/javascript" src="{{url('/front/js/datetimepicker/moment.js')}}"></script>
{{--    <script type="text/javascript" src="{{url('/front/js/datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{url('/front/js/jquery-ui/jquery-ui.min.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{url('/front/js/modernizr/modernizr-2.6.2.min.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{url('/front/js/minicolors/jquery.miniColors.min.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{url('/front/js/jquery.nav.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{url('/front/js/quickview/jquery.magnific-popup.min.js')}}"></script>--}}
{{--    <!-- Theme files--}}
{{--        ============================================ -->--}}
{{--    <script type="text/javascript" src="{{url('/front/js/themejs/application.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{url('/front/js/themejs/homepage.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{url('/front/js/themejs/custom_h1.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{url('/front/js/themejs/noui.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{url('/front/js/themejs/nouislider.js')}}"></script>--}}
    <script type="text/javascript" src="{{url('/front/js/themejs/addtostick.js')}}"></script>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
