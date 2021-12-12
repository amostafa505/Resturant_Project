@extends('layouts.main.home.app')
@section('style')
<style>
body{
  background-color: #bdc3c7;
}
.table-fixed{
  width: 100%;
  background-color: #f3f3f3;
  tbody{
    height:200px;
    overflow-y:auto;
    width: 100%;
    }
  thead,tbody,tr,td,th{
    display:block;
  }
  tbody{
    td{
      float:left;
    }
  }
  thead {
    tr{
      th{
        float:left;
       background-color: #f39c12;
       border-color:#e67e22;
      }
    }
  }
}

</style>
@endsection
@section('content')
<div id="restaurant-menu">
    <div class="section-title text-center center">
        <div class="overlay">
            <h2>User Orders</h2>
            <hr>
            <p>Happy to Serve You</p>
        </div>
    </div>    
    <div class="container">
        <div class="row">
            <div class="container">
                <table class="table table-fixed">
                  <thead>
                    <tr>
                      <th class="col-xs-2">Order Email</th>
                      <th class="col-xs-3">Order Email</th>
                      <th class="col-xs-3">Total Order Amount</th>
                      <th class="col-xs-4">Order Products</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as $order)
                    <tr>
                      <td class="col-xs-2">{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</td>
                      <td class="col-xs-3">{{$order->billing_email}}</td>
                      <td class="col-xs-3">${{$order->totalPrice}}</td>
                      <td class="col-xs-4">
                        @foreach($order->products as $product)
                        <ul>
                          <li>{{$product->name}}</li>
                        </ul>
                        @endforeach
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="text-center">
                  {!! $orders->links() !!}
              </div>
              </div>

        </div>
    </div>
</div>

@endsection      
