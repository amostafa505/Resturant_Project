@extends('layouts.admin.inc.app')

@section('content')
<div class="content-wrapper">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Show FoodMenus</h3>

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
                    <th>Menu Name</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach($FoodMenus as $menu)
                    <tr>
                        <th scope="row">{{$id++}}</th>
                        <td>{{$menu->menu_name}}</td>
                        <td>
                            <a href="{{route('menus.edit',$menu->id)}}" class="btn btn-info">Edit <i class="bi bi-pencil-square"></i></a>
                            <form action="{{route('menus.destroy',$menu->id)}}" method="Post" class="deleteitem form-inline d-inline">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete <i class="bi bi-x-square-fill"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tr>

                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
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
                toastr.error('Cannot delete the category');
                    }
                }
            });
        });

    </script>
@endsection    