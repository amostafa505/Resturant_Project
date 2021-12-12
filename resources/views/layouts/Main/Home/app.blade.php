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
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('img/apple-touch-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('img/apple-touch-icon-114x114.png')}}">

    {{-- Toastr Css --}}
    @toastr_css

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome/css/font-awesome.css')}}">

    <!-- Stylesheet
    ================================================== -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/nivo-lightbox/nivo-lightbox.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/nivo-lightbox/default.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet">
    @yield('style')

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    {{-- including the Navbar from TopMenu blade  --}}
    @include('layouts.main.home.topmenu')

    {{-- including the Navbar from Main Content blade  --}}
    @yield('content')
    
    {{-- including the Navbar from Footer + Contact Form blade  --}}
    @section('footer')
    @include('layouts.main.home.footer')
    @show 
    
    @jquery
    @toastr_js
    @toastr_render
    <script type="text/javascript" src="{{asset('js/jquery.1.11.1.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
    {{-- <script type="text/javascript" src="{{asset('js/SmoothScroll.jsx')}}"></script> --}}
    <script type="text/javascript" src="{{asset('js/nivo-lightbox.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.isotope.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jqBootstrapValidation.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/contact_me.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/main.js')}}"></script>
    @yield('Jscript')
</body>

</html>