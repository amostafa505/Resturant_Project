@extends('layouts.admin.inc.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Chefs Section</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Chef</li>
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
                <h3 class="card-title">Edit Chef</h3>
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
              <form class="p-4 m-3 border bg-gradient-info" action="/chefs/update" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="cat">Chef Name</label>
                    <input type="text" name="name" value="{{$chef->name}}" class="form-control" id="cat" >
                    <input type="hidden" name="id" value="{{$chef->id}}">
                </div>
                <div class="form-group">
                  <label>Chef Brief</label>
                  <textarea class="form-control" name="brief" rows="3" value="{{$chef->brief}}" placeholder="Enter The Product description here"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Image</label>
                    <input type="file" name="img" class="form-control-file" id="exampleFormControlFile1">
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-reply-all-fill"></i> Submit
                 </button>
            </form>
            <div class="form text-center">
                <img src="{{Storage::disk('s3')->url($chef->img)}}" width="250" class="rounded">
            </div>
          </div>
        </div>
    </div>
</div>
@endsection