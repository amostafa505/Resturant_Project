@extends('layouts.admin.inc.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Chef Section</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add New Chef</li>
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
                <h3 class="card-title">Add New Chef</h3>
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
              <form class="p-4 m-3 border bg-gradient-info" action="{{url('chefs')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="cat">Chef Name</label>
                    <input type="text" name="name" class="form-control" id="cat" >
                </div>
                <div class="form-group">
                  <label>Chef Brief</label>
                  <textarea class="form-control" name="brief" rows="3" placeholder="Enter The Product description here"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Image</label>
                    <input type="file" name="img" class="form-control-file" id="image">
                </div>
                <div class="col-md-12">
                  <div class="mt-1 text-center">
                    <div class="images-preview-div">
                    </div>
                  </div>  
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

@section('jsScript')
<script >
  // View the images that user choose directly
  $(function() {
  var previewImages = function(input, imgPreviewPlaceholder) {
    if (input.files) {
      //here remove the old imgs from the view to show the new selected ones
        $('#oldimg').remove();
        //here checking if this div has Images or not if has an image it removes it and but the new one 
        //if not it append the image 
        if($(".images-preview-div:has(img)").length > 0){
              $('.img-thumbnail').remove();
        }//end if
            var filesAmount = input.files.length;
            for(i = 0; i < filesAmount; i++){
              var reader = new FileReader();
              reader.onload = function(event) { 
                $($.parseHTML('<img class="img-thumbnail w-25 h-25 m-2">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
          }//end function onload
        reader.readAsDataURL(input.files[i]);
      }//end for
    }//end IF
    };
    $('#image').on('change', function() {
      previewImages(this, 'div.images-preview-div');
    });
  });
  </script>
@endsection