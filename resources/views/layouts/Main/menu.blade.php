@extends('layouts.main.home.app')
@section('content')

   <!-- Restaurant Menu Section -->
   <div id="restaurant-menu">
    <div class="section-title text-center center">
        <div class="overlay">
            <h2>Menu</h2>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed.</p>
        </div>
    </div>
    <div class="container">
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
        </div>
    </div>
</div>

@endsection