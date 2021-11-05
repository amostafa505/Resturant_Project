@extends('layouts.admin.inc.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Section</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach($errors->all() as $error)
                          <li>{{$error}}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
              <form class="p-4 m-3 border bg-gradient-info" action="/products/update" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="cat">Product Name</label>
                    <input type="text" name="name" value="{{$product->name}}" class="form-control" id="cat" >
                    <input type="hidden" name="id" value="{{$product->id}}">
                </div>
                <div class="form-group">
                    <label for="cat">Product Price</label>
                    <input type="text" name="price" value="{{$product->price}}" class="form-control" id="cat" >
                </div>
                <div class="form-group">
                    <label for="cat">Product Quantity</label>
                    <input type="text" name="qty" value="{{$product->qty}}" class="form-control" id="cat" >
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Image</label>
                    <input type="file" name="img" class="form-control-file" id="exampleFormControlFile1">
                </div>
                <div class="input-group mb-3 justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" name="status" value="pending" type="radio" @if(@$product->status == "pending") checked @endif>
                        <label class="form-check-label" for="exampleRadios1">
                        Pending
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="status" value="active" type="radio" @if(@$product->status == "active") checked @endif>
                        <label class="form-check-label" for="exampleRadios2">
                        Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="status" value="notactive" type="radio" @if(@$product->status == "notactive") checked @endif>
                        <label class="form-check-label" for="exampleRadios3">
                        Not-Active
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Menu</label>
                    <select class="form-control" name="menu_id" id="exampleFormControlSelect1">
                        @foreach($menu as $row)
                            <option value="{{$row->id}}" {{$row->id === $product->menu_id ?'selected':''}}>{{$row->menu_name}}</option>
                        @endforeach
                    </select>
                  </div>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-reply-all-fill"></i> Submit
                 </button>
            </form>
            <div class="form text-center">
                <img src="{{asset('images/products/'.$product->img)}}" width="500" class="rounded">
            </div>
          </div>
        </div>
    </div>
</div>
@endsection