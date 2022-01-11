<link rel="stylesheet" href="{{asset('vendors/dist/css/adminlte.min.1.css')}}">
@extends('layouts.Main.Home.app')
@section('content')
    
    <!-- Content Header (Page header) -->
    <div id="restaurant-menu">
      <div class="section-title text-center center">
        <div class="overlay">
            <h2>Product Preview</h2>
            <hr>
        </div>
      </div>
    </div>  
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12">
          <div class="menu-section">
            @if($product->productimages)
            <!-- Default box -->
            <div class="card card-solid">
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <h1 class="d-inline-block d-sm-none">{{$product->name}}</h1>
                    <div class="col-12">
                      <img src="{{'https://restaurant-project.s3.amazonaws.com/'.$product->productImages[0]->name}}" class="product-image" alt="Product Image">
                    </div>
                    <div class="col-12 product-image-thumbs">
                      @foreach ($product->productimages as $image)  
                        <div class="product-image-thumb active"><img src="{{'https://restaurant-project.s3.amazonaws.com/'.$image->name}}" alt="Product Image"></div>
                      @endforeach
                    </div>
                  </div>
                  @endif
                  <div class="col-12 col-sm-6">
                    <h3 class="my-3">{{$product->name}}</h3>
                    <p>{{$product->description}}</p>
                    
                    <hr>
      
      
                    <div class="bg-gray py-2 px-3 mt-4">
                      <h2 class="mb-0">
                        {{$product->price}}
                      </h2>
                      <h4 class="mt-0">
                        {{-- putting taxs as a static 
                        <small>Including Taxs: {{(($product->price + 5)/100  + $product->price)}} </small> --}}
                        {{-- putting Product After Discount as a static  --}}
                        @if($product->discount)
                          <small style="color: white">Discount: {{$product->discount}}% <br> </small>
                          <small style="color: white">Price After Discount: {{$product->price_discount}} </small>
                        @endif
                      </h4>
                    </div>
      
      
                  </div>
                </div>
                <div class="row mt-4">
                  <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                      <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                      {{-- <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Comments</a> --}}
                      {{-- <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a> --}}
                    </div>
                  </nav>
                  <div class="tab-content p-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">{{$product->description}}</div>
                    {{-- <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum. </div> --}}
                    {{-- <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at semper posuere. Integer finibus orci vitae vehicula placerat. </div> --}}
                  </div>
                </div>
              </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    
@endsection

          <script src="{{asset('vendors/plugins/jquery/jquery.min.js')}}"></script>
          <!-- Bootstrap 4 -->
          <script src="{{asset('vendors/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
          <!-- bs-custom-file-input -->
          <script src="{{asset('vendors/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
          <!-- AdminLTE App -->
          <script src="{{asset('vendors/dist/js/adminlte.min.js')}}"></script>
          <!-- AdminLTE for demo purposes -->
          <script src="{{asset('vendors/dist/js/demo.js')}}"></script>

<script>
  $(document).ready(function() {
    $('.product-image-thumb').on('click', function () {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
  })
</script>
