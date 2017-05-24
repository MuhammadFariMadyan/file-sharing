<!--
    Author: W3layouts
    Author URL: http://w3layouts.com
    License: Creative Commons Attribution 3.0 Unported
    License URL: http://creativecommons.org/licenses/by/3.0/
    -->
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <title>{{ $title or config('app.name') }}</title>

        <!-- For-Mobile-Apps-and-Meta-Tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="csrf-token" value="{{ csrf_token() }}">
        <!-- //For-Mobile-Apps-and-Meta-Tags -->

        <!-- Custom Theme files -->
        <link href="{{ mix('css/bootstrap.css') }}" type="text/css" rel="stylesheet" media="all">
        <link href="{{ asset('css/style11.css') }}" rel="stylesheet" type="text/css" />
        <!-- menu style sheet -->

        <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" media="all">
        <!-- //Custom Theme files -->

        <!-- font-awesome icons -->
        <link href="{{ mix('css/font-awesome.css') }}" rel="stylesheet">
        <!-- //font-awesome icons -->

        <!-- web-fonts -->
        <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
        <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <!-- //web-fonts -->

        @stack('css')
    </head>
    <body class="bg">
        <div id="app">
            @include('layouts.partials.menu')
            <!-- //menu -->

            <!-- modal -->
            @include('layouts.partials.modal')

            <div class="container" style="margin-top: 20px;">
                @yield('content')
            </div>

            <!--social-icons-->
            @include('layouts.partials.social')
            <!--//social-icons-->

            <!-- footer -->
            @include('layouts.partials.footer')
            <!-- //footer -->
        </div>

        <!-- js -->
        <script src="{{ mix('js/app.js') }}"></script>
        <!-- //js -->

        <!--js for bootstrap working-->
        <script src="{{ mix('js/bootstrap.js') }}"></script>
        <!-- //for bootstrap working -->


        <script src="{{ asset('js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>

        <script src="{{ asset('js/SmoothScroll.min.js') }}"></script>

        <!--menu script-->
        <script type="text/javascript" src="{{ asset('js/modernizr-2.6.2.min.js') }}"></script>
        <script src="{{ asset('js/classie.js') }}"></script>
        <script src="{{ asset('js/demo1.js') }}"></script>
        <!--//menu script-->

        <!-- banner -->
        <script type='text/javascript' src='{{ asset('js/jquery.easing.1.3.js') }}'></script>
        <!-- //banner -->

        <script type="text/javascript">
            jQuery(document).ready(function($) {
            	$(".scroll").click(function(event){
            		event.preventDefault();
            		$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            	});

                $('[data-toggle="popover"]').popover();
            });
        </script>

        @stack('js')
    </body>
</html>
