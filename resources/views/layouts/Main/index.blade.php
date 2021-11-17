@extends('layouts.main.home.app')

@section('content')
<!-- Header -->
    <header id="header">
        <div class="intro">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="intro-text">
                            <h1>Touché</h1>
                            <p>Restaurant / Coffee / Pub</p>
                            <a href="#about" class="btn btn-custom btn-lg page-scroll">Discover Story</a> </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
<!-- About Section -->
    <div id="about">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6 ">
                    <div class="about-img"><img src="img/about.jpg" class="img-responsive" alt=""></div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="about-text">
                        <h2>Our Restaurant</h2>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam. Sed commodo nibh ante facilisis bibendum dolor feugiat at. Duis sed dapibus leo nec ornare diam commodo nibh.</p>
                        <h3>Awarded Chefs</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam. Sed commodo nibh ante facilisis bibendum dolor feugiat at. Duis sed dapibus leo nec ornare.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <!-- Restaurant Menu Section -->
   <div id="restaurant-menu">
    <div class="section-title text-center center">
        <div class="overlay">
            <h2>Menu</h2>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed.</p>
        </div>
    </div>
        {{-- <div class="container">
            <div class="row">
                @foreach($menus as $menu)
                <div class="col-xs-12 col-sm-6">
                    <div class="menu-section">
                        <h2 class="menu-section-title">{{$menu->menu_name}}</h2>
                        <hr>
                        @foreach($productslimit as $key=>$value)
                            @foreach ($value as $product)
                                @if($product->menu_id === $menu->id)
                                    <div class="menu-item">
                                        <div class="menu-item-name"> {{$product->name}} </div>
                                        <div class="menu-item-price"> {{$product->price}} </div>
                                        <div class="menu-item-description"> {{$product->description}} </div>
                                    </div>
                                @endif
                                
                            @endforeach
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div> --}}
        <div class="container">
            <div class="row">
                @foreach($menus as $menu)
                <div class="col-xs-12 col-sm-6">
                    <div class="menu-section">
                        <h2 class="menu-section-title">{{$menu->menu_name}}</h2>
                        <hr>
                        @foreach($menu->products as $product)
                        @if($product->foodmenu->menu_name === $menu->menu_name)
                            <div class="menu-item">
                                <div class="menu-item-name"> {{$product->name}} </div>
                                <div class="menu-item-price"> {{$product->price}} </div>
                                <div class="menu-item-description"> {{$product->description}} </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    </div>
</div>

    <!-- Portfolio Section -->
    <div id="portfolio">
        <div class="section-title text-center center">
            <div class="overlay">
                <h2>Gallery</h2>
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed.</p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="categories">
                    <ul class="cat">
                        <li>
                            <ol class="type">
                                <li><a href="#" data-filter="*" class="active">All</a></li>
                                @foreach($menus as $menu)
                                <li><a href="#" data-filter=".{{$menu->menu_name}}">{{$menu->menu_name}}</a></li>
                                @endforeach
                            </ol>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="row">
                <div class="portfolio-items">
                    @foreach($products_data as $product)
                        <div class="col-sm-6 col-md-4 col-lg-4 {{$product->foodmenu->menu_name}}">
                            <div class="portfolio-item">
                                <div class="hover-bg">
                                    <a href="{{asset('images/products/'. $product->img)}}" title="Dish Name" data-lightbox-gallery="gallery1">
                                        <div class="hover-text">
                                            <h4>{{$product->name}}</h4>
                                        </div>
                                        <img src="{{asset('images/products/'. $product->img)}}" class="img-responsive" alt="Project Title"> </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Team Section -->
    <div id="team" class="text-center">
        <div class="overlay">
            <div class="container">
                <div class="col-md-10 col-md-offset-1 section-title">
                    <h2>Meet Our Chefs</h2>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed dapibus leonec.</p>
                </div>
                <div id="row">
                    @foreach($chefs as $chef)
                        <div class="col-md-4 team">
                            <div class="thumbnail">
                                <div class="team-img"><img src="{{asset('images/chefs/'.$chef->img)}}" alt="..."></div>
                                <div class="caption">
                                    <h3>{{$chef->name}}</h3>
                                    <p>{{$chef->brief}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Call Reservation Section -->
    <div id="call-reservation" class="text-center">
        <div class="container">
            <h2>Want to make a reservation? Call <strong>1-887-654-3210</strong></h2>
        </div>
    </div>
@endsection    