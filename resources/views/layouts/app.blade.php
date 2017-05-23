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
        <script> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- //For-Mobile-Apps-and-Meta-Tags -->

        <!-- Custom Theme files -->
        <link href="{{ asset('css/bootstrap.css') }}" type="text/css" rel="stylesheet" media="all">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style11.css') }}" />
        <!-- menu style sheet -->

        <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" media="all">
        <!-- //Custom Theme files -->

        <!-- font-awesome icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
        <!-- //font-awesome icons -->

        <!-- web-fonts -->
        <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
        <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <!-- //web-fonts -->
    </head>
    <body class="bg">
        @include('layouts.partials.menu')
        <!-- //menu -->

        <!-- modal -->
        @include('layouts.partials.modal')
        <!-- //modal -->

        <!-- banner -->

        <!-- //banner -->
        <!--Services-->
        <div class="options-wthree">
        <div class="container">
            @yield('content')
        </div>
        <!--//Services-->

        <!--social-icons-->
        @include('layouts.partials.social')
        <!--//social-icons-->

        <!-- footer -->
        @include('layouts.partials.footer')
        <!-- //footer -->

        <!-- js -->
        <script type='text/javascript' src='/js/jquery-2.2.3.min.js'></script>
        <!-- //js -->
        <script src="/js/jquery.nicescroll.js"></script>
        <script src="/js/scripts.js"></script>
        <!--responsiveslides js-->
        <script src="/js/responsiveslides.min.js"></script>
        <script>
            // You can also use "$(window).load(function() {"
            $(function () {
              // Slideshow 4
              $("#slider4").responsiveSlides({
            	auto: true,
            	pager:true,
            	nav:false,
            	speed: 500,
            	namespace: "callbacks",
            	before: function () {
            	  $('.events').append("<li>before event fired.</li>");
            	},
            	after: function () {
            	  $('.events').append("<li>after event fired.</li>");
            	}
              });

            });
        </script>
        <script>
            // You can also use "$(window).load(function() {"
            $(function () {
              // Slideshow 3
              $("#slider3").responsiveSlides({
            	auto: true,
            	pager:false,
            	nav: true,
            	speed: 500,
            	namespace: "callbacks",
            	before: function () {
            	  $('.events').append("<li>before event fired.</li>");
            	},
            	after: function () {
            	  $('.events').append("<li>after event fired.</li>");
            	}
              });

            });

        </script>
        <!--//responsiveslides js-->
        <script src="{{ asset('/js/SmoothScroll.min.js') }}"></script>

        <!--menu script-->
        <script type="text/javascript" src="{{ asset('/js/modernizr-2.6.2.min.js') }}"></script>
        <script src="{{ asset('/js/classie.js') }}"></script>
        <script src="{{ asset('/js/demo1.js') }}"></script>
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
            });
        </script>
        <!--js for bootstrap working-->
        <script src="{{ asset('/js/bootstrap.js') }}"></script>
        <!-- //for bootstrap working -->

        @stack('js')
    </body>
</html>
