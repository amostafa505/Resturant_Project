@extends('layouts.admin.inc.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dish Section</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Dish</li>
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
                <h3 class="card-title">Edit Dish</h3>
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
                    <label for="cat">Dish Name</label>
                    <input type="text" name="name" value="{{$product->name}}" class="form-control" id="cat" >
                    <input type="hidden" name="id" value="{{$product->id}}">
                </div>
                <div class="form-group">
                    <label for="cat">Dish Price</label>
                    <input type="text" name="price" value="{{$product->price}}" class="form-control" id="cat" >
                </div>
                <div class="form-group">
                    <label for="cat">Dish Quantity</label>
                    <input type="text" name="qty" value="{{$product->qty}}" class="form-control" id="cat" >
                </div>
                <div class="form-group">
                  <label for="cat">Dish Discount %</label>
                  <input type="text" name="discount" value="{{$product->discount}}" class="form-control" id="cat" >
              </div>
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status">
                    <option value="active" @if(@$product->status == "active") selected @endif>Active</option>
                    <option value="notactive" @if(@$product->status == "notactive") selected @endif>Not-Active</option>
                    <option value="pending"@if(@$product->status == "pending") selected @endif>Pending</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Select Menu</label>
                  <select class="form-control" name="menu_id" id="exampleFormControlSelect1">
                    @foreach($menu as $row)
                    <option value="{{$row->id}}" {{$row->id === $product->menu_id ?'selected':''}}>{{$row->menu_name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Image</label>
                    <input type="file" name="image_id[]" multiple class="form-control-file" id="exampleFormControlFile1">
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-reply-all-fill"></i> Submit
                 </button>
            </form>
            <div class="form text-center">
                {{-- <img src="{{asset('images/products/'.$product->img)}}" width="500" class="rounded"> --}}
                <div class="container">
                  <div class="row">
                      @foreach ($product->productimages as $image)  
                      {{-- <div class="product-image-thumb active"><img src="{{Storage::url('/images/products/'.$image->name)}}" alt="Product Image"></div> --}}
                              <div class="col-xs-6"><img src="{{'https://restaurant-project.s3.amazonaws.com/'.$image->name}}" width="250px" class="img-thumbnail" alt="Dish Image"></div>
                      @endforeach
                  </div>  
                </div>   
            </div>
          </div>
        </div>
    </div>
</div>
@endsection