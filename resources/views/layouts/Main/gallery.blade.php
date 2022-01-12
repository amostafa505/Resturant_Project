@extends('layouts.Main.Home.app')
@section('content')
    

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
                @foreach($products as $product)
                    @if($product->status==='active')
                        <div class="col-sm-6 col-md-4 col-lg-4 {{$product->foodmenu->menu_name}}">
                            <div class="portfolio-item">
                                <div class="hover-bg">
                                    <a href="{{Storage::disk('s3')->url($product->productImages[0]->name)}}" title="{{$product->name}}" data-lightbox-gallery="gallery1">
                                    {{-- <a href="{{Storage::url('/images/products/'.$product->productImages[0]->name)}}" title="{{$product->name}}" data-lightbox-gallery="gallery1"> --}}
                                        {{-- <a href="{{asset('/images/products/'.$product->productImages[0]->name)}}" title="{{$product->name}}" data-lightbox-gallery="gallery1"> --}}
                                        <div class="hover-text">
                                            <h4>{{$product->name}}</h4>
                                        </div>
                                        <img src="{{Storage::disk('s3')->url($product->productImages[0]->name)}}"  class="img-responsive" title="{{$product->name}}" alt="Dish Name"></a>
                                        {{-- <img src="{{Storage::url('/images/products/'.$product->productImages[0]->name)}}" class="img-responsive" title="{{$product->name}} alt="Dish Name"> </a> --}}
                                        {{-- <img src="{{asset('/images/products/'.$product->productImages[0]->name)}}" class="img-responsive" title="{{$product->name}} alt="Dish Name"> </a> --}}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>            
            
  
@endsection
            
    