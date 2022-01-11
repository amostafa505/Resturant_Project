@extends('layouts.admin.inc.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/profile.css')}}">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>User Profile Section</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
    <section class="section about-section gray-bg" id="about">
        <div class="container">
            <div class="row align-items-center justify-content-around flex-row-reverse">
                <div class="col-lg-6">
                    <div class="about-text">
                        <h3 class="dark-color">Name : {{$user->name}}</h3>
                        <h4 class="theme-color">Email : {{$user->email}}</h4>
                        <h4 class="theme-color">Address : {{$user->address}}</h4>
                        <h4 class="theme-color">Phone : {{$user->phone}}</h4>
                        {{-- <div class="btn-bar">
                            <a class="px-btn theme" href="#">View Works</a>
                            <a class="px-btn theme-t" href="#">Download CV</a>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-5 text-center">
                    <div class="about-img">
                        <img @if($user->img) ? src="{{Storage::disk('s3')->url($user->img)}}" @else src="{{asset('images/users/defaultUserProfile.png')}}" @endif width="400" height="400" class="rounded" alt="No Picture">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection