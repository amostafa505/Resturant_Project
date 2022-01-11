<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ِAdmin Board</title>
  {{-- Icon --}}
  <link rel="icon" href="{{asset('img/apple-touch-icon.png')}}">
  @production
  <link rel="icon" href="{{secure_asset('img/apple-touch-icon.png')}}">
  @endproduction
  {{-- Toastr Css --}}
  @toastr_css
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('vendors/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('vendors/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  {{-- Top Menu  --}}
@include('layouts.admin.inc.TopMenu')

  {{-- Left Sidebar --}}
@include('layouts.admin.inc.LeftMenu')

  {{-- Main Content --}}
@yield('content')

  {{-- Right Sidebar --}}
@include('layouts.admin.inc.RightMenu')
</div>

  {{-- Footer --}}
@include('layouts.admin.inc.Footer')  


<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('vendors/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('vendors/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('vendors/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('vendors/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('vendors/dist/js/demo.js')}}"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
@jquery
@toastr_js
@toastr_render
@yield('jsScript')
</body>
</html>
