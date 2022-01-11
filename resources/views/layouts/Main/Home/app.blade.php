<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Touché</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicons
    ================================================== -->
    {{-- <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon"> --}}
    <link rel="icon" sizes="114x114" href="{{asset('img/apple-touch-icon.png')}}">
    @production
    <link rel="icon" href="{{secure_asset('img/apple-touch-icon.png')}}">
    @endproduction

    {{-- Toastr Css --}}
    @toastr_css

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    @production
    <link rel="stylesheet" href="{{secure_asset('css/bootstrap.css')}}">
    @endproduction
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome/css/font-awesome.css')}}">
    @production
    <link rel="stylesheet" href="{{secure_asset('fonts/font-awesome/css/font-awesome.css')}}">
    @endproduction
    <!-- Stylesheet
    ================================================== -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    @production
    <link rel="stylesheet" href="{{ secure_asset('css/style.css')}}">
    @endproduction
    <link rel="stylesheet" type="text/css" href="{{asset('css/nivo-lightbox/nivo-lightbox.css')}}">
    @production
    <link rel="stylesheet" href="{{ secure_asset('css/nivo-lightbox/nivo-lightbox.css')}}">
    @endproduction
    <link rel="stylesheet" type="text/css" href="{{asset('css/nivo-lightbox/default.css')}}">
    @production
    <link rel="stylesheet" href="{{ secure_asset('css/nivo-lightbox/nivo-lightbox.css')}}">
    @endproduction
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet">
    @yield('style')

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    {{-- including the Navbar from TopMenu blade  --}}
    @include('layouts.Main.Home.Topmenu')

    {{-- including the Navbar from Main Content blade  --}}
    @yield('content')
    
    {{-- including the Navbar from Footer + Contact Form blade  --}}
    @section('footer')
    @include('layouts.Main.Home.footer')
    @show 
    
    @jquery
    @toastr_js
    @toastr_render
    <script type="text/javascript" src="{{asset('js/jquery.1.11.1.js')}}"></script>
    @production
    <link rel="text/javascript" href="{{ secure_asset('js/jquery.1.11.1.js')}}">
    @endproduction
    <script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
    @production
    <link rel="text/javascript" href="{{ secure_asset('js/bootstrap.js')}}">
    @endproduction
    {{-- <script type="text/javascript" src="{{asset('js/SmoothScroll.jsx')}}"></script> --}}
    <script type="text/javascript" src="{{asset('js/nivo-lightbox.js')}}"></script>
    @production
    <link rel="text/javascript" href="{{ secure_asset('js/nivo-lightbox.js')}}">
    @endproduction
    <script type="text/javascript" src="{{asset('js/jquery.isotope.js')}}"></script>
    @production
    <link rel="text/javascript" href="{{ secure_asset('js/jquery.isotope.js')}}">
    @endproduction
    <script type="text/javascript" src="{{asset('js/jqBootstrapValidation.js')}}"></script>
    @production
    <link rel="text/javascript" href="{{ secure_asset('js/jqBootstrapValidation.js')}}">
    @endproduction
    <script type="text/javascript" src="{{asset('js/contact_me.js')}}"></script>
    @production
    <link rel="text/javascript" href="{{ secure_asset('js/contact_me.js')}}">
    @endproduction
    <script type="text/javascript" src="{{asset('js/main.js')}}"></script>
    @production
    <link rel="text/javascript" href="{{ secure_asset('js/main.js')}}">
    @endproduction
    @yield('Jscript')
</body>

</html>