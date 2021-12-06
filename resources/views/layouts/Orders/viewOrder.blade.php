@extends('layouts.admin.inc.app')

@section('content')
{{-- {{dd($data)}} --}}
<div class="content-wrapper">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Show Order Products</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                    </button>
                </div>
                </div>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
                    {{-- @foreach($orders as $order) --}}
                    {{-- {{dd($order->products)}} --}}
                        @foreach($orders as $item)
                            <tr>
                                <th scope="row">{{$id++}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->pricediscount}}</td>
                                <td>{{$item->pivot->quantity}}</td>
                            </tr>
                        @endforeach
                    {{-- @endforeach  --}}
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

</div>


@endsection

@section('jsScript')

    <script>
        $(".deleteitem").on("submit" , function(e){
            e.preventDefault();
            var action = $(this).attr("action");
            var data = $(this).serialize();
            $row = $(this);
            $.ajax({
                "url":action,
                "type":"DELETE",
                "data":data,
                success:function(data){
                    if(data.status === 'success'){
                        toastr.success(data.Message);
                        $($row).parents('tr').remove();
                    };
                },
                error: function( data ){
                if ( data.status === 422 ) {
                toastr.error('Cannot delete This Order');
                    }
                }
            });
        });

    </script>
@endsection    