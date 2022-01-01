@extends('layouts.admin.inc.app')

@section('content')
<div class="content-wrapper">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Show Orders</h3>

            <div class="card-tools">
                <div class="dropdown ml-2">
                    {{-- <input type="hidden" name="id" class="id" value="{{$row->id}}"> --}}
                        <select class="form-control dropdown-toggle filter-select" id="statusfilter"  name="statusfilter">
                            <option value="pending">Pending</option>
                            <option value="shipped">Shipped</option>
                            <option value="accepted">Accepted</option>
                            <option value="rejected">Rejected</option>
                            <option value="canceled">Canceled</option>
                        </select>
                </div>
            </div>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap" id="datatable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Total Order Price</th>
                    <th>Order Status</th>
                    <th class="text-center">action</th>
                </tr>
                </thead>
                <tbody id="filterdata">
                    @foreach ($data as $row)
                        <tr class="order-user-row">
                            <th scope="row">{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</th>
                            <td>{{$row->user->name}}</td>
                            <td>{{$row->billing_address}}</td>
                            <td>{{$row->billing_email}}</td>
                            <td>{{$row->billing_phone}}</td>
                            <td>${{$row->totalPrice}}</td>
                            <td class="order-user-status">{{$row->orderstatus}}</td>
                            <td>
                                <div class="row">
                                <a href="{{route('orders.show',$row->id)}}" class="btn bg-gradient-primary">View <i class="bi bi-pencil-square"></i></a>
                                {{-- <form action="{{route('orders.update',$row->id)}}" method="POST" class="ordersts" >
                                    @csrf
                                    @method('PUT')
                                    onChange="this.form.submit()" --}}
                                    <div class="dropdown ml-2">
                                        <input type="hidden" name="id" class="id" value="{{$row->id}}">
                                        <select  class="form-control dropdown-toggle status"  name="status">
                                            <option value="pending"  @if(@$row->orderstatus == "pending") selected @endif>Pending</option>
                                            <option value="shipped"  @if(@$row->orderstatus == "shipped") selected @endif>Shipped</option>
                                            <option value="accepted" @if(@$row->orderstatus == "accepted") selected @endif>Accepted</option>
                                            <option value="rejected" @if(@$row->orderstatus == "rejected") selected @endif>Rejected</option>
                                            <option value="canceled" @if(@$row->orderstatus == "canceled") selected @endif>Canceled</option>
                                        </select>
                                    </div>
                                {{-- </form> --}}
                                <form action="{{route('orders.destroy',$row->id)}}" method="Post" class="deleteitem form-inline ml-2">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete <i class="bi bi-x-square-fill"></i></button>
                                </form>
                            </div>    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
            <div class="d-flex justify-content-center" id="pagination">
                {!! $data->links() !!}
            </div>
        </div>
        <!-- /.card -->
    </div>

</div>


@endsection

@section('jsScript')
    <script type="text/javascript">
        // delete item 
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
                        // $($row).parents('tbody').refresh();
                    };
                },
                error: function( data ){
                if ( data.status === 422 ) {
                toastr.error('Cannot delete This Order');
                    }
                }
            });
        });

             
        // });
        $(".status").on("change" , function(event){
            var id = $(".id").attr("value");
            var url = '{{url("orders")}}'+ '/' + id;
            var data = $(this).serialize();
            // var rowId = $('#id').val();
            $row = $(this).parent().parent().parent().siblings('.order-user-status');
            $.ajax({
                "url":url+'?_token=' + '{{ csrf_token() }}',
                "type":"PUT",
                "data":data,
                success:function(data){
                    if(data.status === 'success'){
                        $($row).html("");
                        $($row).html(`${data.data.orderstatus}`);
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

        // The Filter 
        $("#statusfilter").on("change" , function(){
            $status =  $("#statusfilter option:selected").val();
            $data = $(this).serialize();
            $url = '{{url("orders/filter")}}' + '/' + $status;
            // console.log($url);
            $.ajax({
                "url":$url+'?_token=' + '{{ csrf_token() }}',
                "type":"POST",
                "data":$data,
                success:function(data){
                    if(data.status === 'success'){
                        
                        $("#filterdata").html("");
                        $("#pagination").html("");
                        $.each(data.data , function(key,value){
                            $("#filterdata").append(`
                            <tr>
                            <th scope="row">${value.id}</th>
                            <td>${value.user.name}</td>
                            <td>${value.billing_address}</td>
                            <td>${value.billing_email}</td>
                            <td>${value.billing_phone}</td>
                            <td>$${value.totalPrice}</td>
                            <td>${value.orderstatus}</td>
                            <td>
                                <div class="row">
                                <a href="orders/${value.id}" class="btn bg-gradient-primary">View <i class="bi bi-pencil-square"></i></a>
                                <form action="orders/${value.id}" method="POST" class="ordersts">
                                    @csrf
                                    @method('PUT')
                                    <div class="dropdown ml-2">
                                        <input type="hidden" name="id" class="id" value="${value.id}">
                                        <select  class="form-control dropdown-toggle" onchange="this.form.submit()" name="status">
                                            <option value="pending" ${value.orderstatus == 'pending' ? 'selected' : ''}>Pending</option>
                                            <option value="shipped"  ${value.orderstatus == 'shipped' ? 'selected' : ''}>Shipped</option>
                                            <option value="accepted" ${value.orderstatus == 'accepted' ? 'selected' : ''}>Accepted</option>
                                            <option value="rejected" ${value.orderstatus == 'rejected' ? 'selected' : ''}>Rejected</option>
                                            <option value="canceled" ${value.orderstatus == 'canceled' ? 'selected' : ''}>Canceled</option>
                                        </select>
                                    </div>
                                </form>
                                <form action="orders/${value.id}" method="Post" class="deleteitem form-inline ml-2">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete <i class="bi bi-x-square-fill"></i></button>
                                </form>
                            </div>    
                            </td>
                        </tr>`)
                        });
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