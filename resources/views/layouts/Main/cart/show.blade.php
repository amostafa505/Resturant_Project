@extends('layouts.Main.home.app')
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
    <div class="container" id="mycontainer">
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

            <div class="container">
                <div class="row">
                    <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3" id="alldata">
                        {{-- <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <address>
                                    <strong>Elf Cafe</strong>
                                    <br>
                                    2135 Sunset Blvd
                                    <br>
                                    Los Angeles, CA 90026
                                    <br>
                                    <abbr title="Phone">P:</abbr> (213) 484-6829
                                </address>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                <p>
                                    <em>Date: 1st November, 2013</em>
                                </p>
                                <p>
                                    <em>Receipt #: 34522677W</em>
                                </p>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="text-center">
                                <h1>Receipt</h1>
                            </div>
                            </span>
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-center">Price</th>
                                        <th>Quantity</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $cart->items as $product)
                                    <tr data-id="{{$product['id']}}">
                                        <td class="col-md-8"><em>{{ $product['name'] }}</em></h4></td>
                                        <td class="col-md-1 text-center">${{ $product['price'] }}</td>
                                        <td class="col-md-2" style="text-align: center">
                                            <form action="{{route('cart.update',$product['id'])}}" method="Post" class="updateitem" style="display:inline">
                                                @csrf 
                                                <div class="input-group">
                                                    <input type="hidden" name="id" id="id" value="{{$product['id']}}">
                                                <input type="text" name="qty" id="qty" value={{ $product['qty']}}>
                                                <div class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary btn-sm ml-4">Change</button>
                                                </div>
                                                </div>
                                            </form> 
                                         </td>
                                        <td class="col-md-1 text-center">
                                        <form action="{{route('cart.remove',$product['id'])}}" method="Post" class="deleteitem ml-2" style="display:inline">
                                            @csrf 
                                            @method('DELETE')
                                            <input type="hidden" name="id" id="id" value="{{$product['id']}}">
                                            <button type="submit" class="btn btn-danger btn-sm ml-4 " ><i class="fa fa-trash-o"></i></button>
                                        </form> 
                                        {{-- <button type="submit" data-route = "{{route('cart.remove',$product['id'])}}"class="delete btn btn-danger btn-sm ml-4 " data-id="{{$product['id']}}"><i class="fa fa-trash-o"></i></button> --}}
                                        </td>
                                    </tr>
                                    @endforeach
{{-- 
                                    <tr>
                                        <td>   </td>
                                        <td>   </td>
                                        <td class="text-right">
                                        <p>
                                            <strong>Subtotal: </strong>
                                        </p>
                                        <p>
                                            <strong>Tax: </strong>
                                        </p></td>
                                        <td class="text-center">
                                        <p>
                                            <strong>$6.94</strong>
                                        </p>
                                        <p>
                                            <strong>$6.94</strong>
                                        </p></td>
                                    </tr> --}}
                                    <tr>
                                        <td>   </td>
                                        <td>   </td>
                                        <td class="text-right"><h4><strong>Total: </strong></h4></td>
                                        <td class="text-center text-danger" id="totalPrice"><h4><strong>${{$cart->totalPrice}}</strong></h4></td>
                                    </tr>
                                </tbody>
                            </table>
                            <td>
                            <a href="{{route('cart.checkout')}}" class="btn btn-success btn-lg btn-block"> <span class="glyphicon glyphicon-chevron-right"></span>Pay Now</a>
                            </td>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@else
<p id="noitems">There are no items in the cart</p>
@endif

@endsection
@section('Jscript')
<script>
    // delete item 
    $(".deleteitem").on("submit" , function(e){
            e.preventDefault();
            var action = $(this).attr("action");
            var data = $(this).serialize();
            $row = $(this);
            $rowCount = $('#myTable tr').length;
            // console.log($rowCount);
            $.ajax({
                "url":action,
                "type":"DELETE",
                "data":data,
                success:function(data){
                    if(data.status === 'success'){
                        toastr.success(data.Message);
                        $($row).parents('tr').remove();
                        if($rowCount>3){
                            $totalprice = parseInt(data.totalPrice);
                            $("#totalPrice").html("");
                            $("#totalPrice").html(`<h4><strong>${$totalprice}</h4></strong>`);
                            $('#cartqty').html("");
                            $('#cartqty').html(`My Cart (${data.totalQuantity})`);
                        }else{
                            $("#mycontainer").html("");
                            $("#mycontainer").html(`<p>There are no items in the cart</p>`);
                            $('#cartqty').html("");
                            $('#cartqty').html(`My Cart (0)`);
                            // $("#mycontainer").html("#noitems");
                        }        
                    };
                },
                error: function( data ){
                    if ( data.status === 422 ) {
                        toastr.error('Cannot delete This Order');
                    }
                }
            });
        });
    // Change the Status with Ajax
    $(".updateitem").on("submit" , function(e){
        e.preventDefault();
        var action = $(this).attr("action");
        var data = $(this).serialize();
        var rowId = $('#id').val();
        $row = $(this);
        $.ajax({
            "url":action,
            "type":"POST",
            "data":data,
            success:function(data){
                if(data.status === 'success'){
                    $totalprice = parseInt(data.totalPrice);
                    $("#totalPrice").html("");
                    $("#totalPrice").html(`<h4><strong>${$totalprice}</h4></strong>`);
                    $('#cartqty').html("");
                    $('#cartqty').html(`My Cart (${data.totalQuantity})`);
                    toastr.success(data.Message);
                };
            },
            error: function( data ){
            if ( data.status === 422 ) {
            toastr.error('Cannot Update This Order Status');
                }
            }
        });
    });
</script>    
@endsection