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
                    @foreach($menu->products as $product)
                    @if($product->foodmenu->menu_name === $menu->menu_name)
                    <div class="menu-item row" >
                        <div class="menu-item-image col-xs-3">
                            <img src="{{Storage::url('/images/products/'.$product->productImages[0]->name)}}" class="" alt="">
                        </div>
                        <div class="menu-item-text col-xs-7">
                            <div class="menu-item-name">{{$product->name}}</div>
                            @if($product->discount)<div class="menu-item-price"><strong>{{$product->price_discount}}</strong></div>
                            @else <div class="menu-item-price">{{$product->price}}</div>@endif
                            <div class="menu-item-description"> {{$product->description}} </div>
                            @if($product->discount)<div class="menu-item-discount"><s>{{$product->price}}</s></div><br>
                            <div class="menu-item-discount"><small>Disccount {{$product->discount}}%</small></div>
                           @endif
                            
                        </div>    
                        <div class="menu-item-links col-xs-2">
                            <a href="{{Route('productpreview', $product->id)}}" class="btn btn-default">View</a>
                            <a href="{{Route('add.cart' , $product->id)}}" class="btn btn-default add-to-cart" style="margin-top:5px">Add To Cart</a>
                        </div>
                        
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

@endsection

@section('Jscript')
    <script>
        $(".add-to-cart").on("click",function(event){
            event.preventDefault();
            $url = $(this).attr("href");
            var data = $(this).serialize();
            $.ajax({
                "url":$url,
                "type":"get",
                "data":data,
                success:function(data){
                    if(data.status === 'success'){
                        toastr.success(data.Message);
                        $('#cartqty').html("");
                        $('#cartqty').html(`My Cart (${data.totalQuantity})`);       
                    };
                },
                error: function( data ){
                    if ( data.status === 422 ) {
                        toastr.error('Cannot Add This Product into the Cart');
                    }
                }
            });
        });
    </script>    
@endsection