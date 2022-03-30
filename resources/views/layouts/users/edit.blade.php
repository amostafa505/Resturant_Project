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
              <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputname1">Name</label>
                    <input type="name" name="name" class="form-control" value="{{$user->name}}" id="exampleInputname1" placeholder="Enter Your Name">
                    <input type="hidden" name="id" value="{{$user->id}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" value="{{$user->email}}" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputaddress1">Address</label>
                    <input type="address" name="address" class="form-control" value="{{$user->address}}" id="exampleInputaddress1" placeholder="Enter address">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPhone1">Phone Number</label>
                    <input type="phone" name="phone" class="form-control" value="{{$user->phone}}" id="exampleInputPhone1" placeholder="Enter Your Phone Number">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="customRadio1" name="is_admin" value="1" @if($user->is_admin == 1) checked @endif>
                      <label for="customRadio1" class="custom-control-label">Admin</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="customRadio2" name="is_admin" value="0" @if($user->is_admin == 0) checked @endif>
                      <label for="customRadio2" class="custom-control-label">User</label>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                          <div class="form-group">
                              <label for="exampleFormControlFile1">Image</label>
                              <input type="file" name="img" class="form-control-file" id="image">
                          </div>
                          <div class="col-md-12">
                            <div class="mt-1 text-center">
                            @if($user->img)
                              <img src="{{Storage::disk('s3')->url($user->img)}}" class="img-thumbnail w-25 h-25 m-2" id="oldimg">
                            @endif
                          </div>  
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="mt-1 text-center">
                        <div class="images-preview-div">
                        </div>
                      </div>  
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsScript')
    <script >
      // View the images that user choose directly
      $(function() {
      var previewImages = function(input, imgPreviewPlaceholder) {
        if (input.files) {
            $('#oldimg').remove();
          var filesAmount = input.files.length;
          for(i = 0; i < filesAmount; i++){
            var reader = new FileReader();
              reader.onload = function(event) {
                //here checking if this div has Images or not if has an image it removes it and but the new one 
                //if not it append the image  
                if($(".images-preview-div:has(img)").length > 0){
                  $('.img-thumbnail').remove();
                  $($.parseHTML('<img class="img-thumbnail w-25 h-25 m-2">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }else{
                  $($.parseHTML('<img class="img-thumbnail w-25 h-25 m-2">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }
              }
            reader.readAsDataURL(input.files[i]);
          }
        }
        };
        $('#image').on('change', function() {
          previewImages(this, 'div.images-preview-div');
        });
      });
      </script>
@endsection