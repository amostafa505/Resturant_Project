@extends('layouts.main.home.app')
@section('style')
<style>
    .thumbnail {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);
        transition: 0.3s;
        min-width: 40%;
        border-radius: 5px;
    }
    
    .thumbnail-description {
        min-height: 40px;
    }
    
    .thumbnail:hover {
        cursor: pointer;
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 1);
    }
</style>
@endsection
{{-- <div class="row">
    <div class="col-md-2">&nbsp;</div>
    <div class="col-md-8">
        <div class="row space-16">&nbsp;</div>
        <div class="row">
            <div class="col-sm-4">
            <div class="thumbnail">
                <div class="caption text-center" onclick="location.href='https://flow.microsoft.com/en-us/connectors/shared_slack/slack/'">
                <div class="position-relative">
                    <img src="https://az818438.vo.msecnd.net/icons/slack.png" style="width:72px;height:72px;" />
                </div>
                <h4 id="thumbnail-label">{{ $product['name'] }}</h4>
                <p><i class="glyphicon glyphicon-user light-red lighter bigger-120"></i>&nbsp;Auditor</p>
                <div class="thumbnail-description smaller">Slack is a team communication tool, that brings together all of your team communications in one place, instantly searchable and available wherever you go.</div>
                </div>
                <div class="caption card-footer text-center">
                <ul class="list-inline">
                    <li><i class="people lighter"></i>&nbsp;7 Active Users</li>
                    <li></li>
                    <li><i class="glyphicon glyphicon-envelope lighter"></i><a href="#">&nbsp;Help</a></li>
                </ul>
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-2">&nbsp;</div>
    </div>
</div> --}}
@section('content')
<div id="restaurant-menu">
    <div class="section-title text-center center">
        <div class="overlay">
            <h2>Shopping Cart</h2>
            <hr>
            <p>Happy to Serve You</p>
        </div>
    </div>    
    <div class="container">
        <div class="row">
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if($cart)
            <div class="col-md-8">
                    @foreach( $cart->items as $product)
                            <div class="panel panel-default mb-2">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        {{ $product['name'] }}
                                    </h5>
                                </div>
                                    <div class="panel-body">
                                        ${{ $product['price'] }}
                                        <form action="{{route('cart.update',$product['id'])}}" method="Post" class="updateitem ml-2" style="display:inline">
                                            @csrf 
                                            @method('Put')
                                            <input type="text" name="qty" id="qty" value={{ $product['qty']}}>
                                            <button type="submit" class="btn btn-info btn-sm ml-4">Change</i></button>
                                        </form> 
                                        <form action="{{route('cart.remove',$product['id'])}}" method="Post" class="deleteitem ml-2" style="display:inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm ml-4">Remove</i></button>
                                        </form>  
                                        {{-- <a href="#" class="btn btn-danger btn-sm ml-4">Remove</a> --}}
                                    </div>
                            </div>
                    @endforeach
                    <div class="panel-footer">
                        <p><strong>Total : ${{$cart->totalPrice}}</strong></p>
                    </div>

            </div>

            <div class="col-md-4">
                <div class="Panel panel-default bg-primary text-white text-center">
                    <div class="panel-Heading">
                        <h3 class="panel-title text-center">
                            Your Cart
                        </h3>
                        {{-- <hr>     --}}
                        <div class="panel-body">
                            <p>
                            Total Amount is : <strong>${{$cart->totalPrice}}</strong>
                            </p>
                            <p>
                            Total Quantities is : <strong>{{$cart->totalQty}}</strong>
                            </p>
                        </div>
                        <a href="{{route('cart.checkout',$cart->totalPrice)}}" class="btn btn-info">Checkout</a>
                    </div>
                </div>
            </div>
            
            @else
            <p>There are no items in the cart</p>
            @endif
        </div>
    </div>
</div>
</div>
</div>

@endsection
