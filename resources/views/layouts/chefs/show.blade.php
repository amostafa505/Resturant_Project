@extends('layouts.admin.inc.app')

@section('content')
<div class="content-wrapper">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Show User</h3>

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
                    <th>Name</th>
                    <th>Brief</th>
                    <th>Image</th>
                    <th scope="col">action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr>
                            <th scope="row">{{$id++}}</th>
                            <td>{{$row->name}}</td>
                            <td>{{$row->brief}}</td>
                            <td><img src="{{asset('images/chefs/'.$row->img)}}" width="75" class="rounded"></td>
                            <td>
                                <div class="row">
                                <a href="{{route('chefs.edit',$row->id)}}" class="btn btn-info">Edit <i class="bi bi-pencil-square"></i></a>
                                <form action="{{route('chefs.destroy',$row->id)}}" method="Post" class="deleteitem form-inline ml-2">
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
                toastr.error('Cannot delete This Product');
                    }
                }
            });
        });

    </script>
@endsection    