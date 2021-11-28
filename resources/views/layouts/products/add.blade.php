@extends('layouts.admin.inc.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Item Section</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add New item</li>
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
                <h3 class="card-title">Add New Item</h3>
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
              <form class="p-4 m-3 border bg-gradient-info" action="{{url('products')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="cat">Item Name</label>
                    <input type="text" name="name" class="form-control" id="cat" >
                </div>
                <div class="form-group">
                    <label for="cat">Item Price</label>
                    <input type="text" name="price" class="form-control" id="cat" >
                </div>
                <div class="form-group">
                    <label for="cat">Item Quantity</label>
                    <input type="text" name="qty" class="form-control" id="cat" >
                </div>
                <div class="form-group">
                  <label for="cat">Item Discount %</label>
                  <input type="text" name="discount" class="form-control" id="cat" >
              </div>
                {{-- <div class="input-group mb-3 justify-content-between">
                  <div class="form-check">
                        <input class="form-check-input" name="status" value="pending" type="radio" checked>
                        <label class="form-check-label" for="exampleRadios1">
                        Pending
                        </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" name="status" value="active" type="radio" >
                        <label class="form-check-label" for="exampleRadios2">
                        Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="status" value="notactive" type="radio">
                        <label class="form-check-label" for="exampleRadios3">
                          Not-Active
                        </label>
                      </div>
                    </div> --}}
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status">
                        <option value="active">Active</option>
                        <option value="notactive">Not-Active</option>
                        <option value="pending">Pending</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Product Description</label>
                      <textarea class="form-control" name="description" rows="3" placeholder="Enter The Product description here"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Select Menu</label>
                      <select class="form-control" name="menu_id" id="exampleFormControlSelect1">
                        @foreach($cat as $row)
                            <option value="{{$row->id}}">{{$row->menu_name}}</option>
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
            </div>
        </div>
    </div>
  </div>
@endsection