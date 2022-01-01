@extends('layouts.Main.home.app')
@section('style')
<style>
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
        border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
@endsection
@section('content')
<div id="restaurant-menu">
    <div class="section-title text-center center">
        <div class="overlay">
            <h2>Shopping Cart</h2>
            <hr>
            <p>Happy to Serve You</p>
        </div>
    </div> 
    <div class="container">
        
        <form action="/charge" method="post" id="payment-form" style="margin: 2em 1em;">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email" value="{{auth()->user()->email}}">
            </div>
            <div class="form-group">
                <label for="exampleInputaddress1">Address</label>
                <input type="text" class="form-control" name="address" id="exampleInputaddress1" placeholder="Your Address" value="{{auth()->user()->address}}">
            </div>   
            <div class="form-group">
                <label for="exampleInputphone1">Phone Number</label>
                <input type="text" class="form-control" name="phone" id="exampleInputphone1" placeholder="Your Phone" value="{{auth()->user()->phone}}">
            </div>   
            <div class="row">
                <div class="col-lg-12">
                    <h5>Total Amount For Your Cart Products is : <strong>${{$amount}}</strong></h5>
                </div>
            </div> 
            <div class="form-group">
                <label for="card-element">
                    Credit or debit card
                </label>
                <input type="hidden" name="amount" value="{{$amount}}">
              <div id="card-element" class="form-group">
                <!-- A Stripe Element will be inserted here. -->
              </div>
          
              <!-- Used to display Element errors. -->
              <div id="card-errors" role="alert"></div>
            </div>
            
            <button class="btn btn-primary margin-top-lg">Submit Payment</button>

                <p id="loading" class="margin-top-sm"style="display: none;">Please Wait Till Your Payment is confirmed...</p>
          </form>
    </div>
</div>
@endsection

@section('Jscript')
<script src="https://js.stripe.com/v3/"></script>
<script>
    window.onload = function() {
            var stripe = Stripe('pk_test_51K1G2XEzV4FHHKsgbmmkehIQ8zMSgZ3KGUIrRXia41SiKTciBHLIux143TMH6AJKh20Sv9WrXDTuWetnqFHptOOx00iRMWCdgd');
            var elements = stripe.elements();
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };
            var card = elements.create('card', {
                style: style
            });
            card.mount('#card-element');
            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                var loading = document.getElementById('loading')
                loading.style.display="block";
                // Submit the form
                form.submit();
            }
        }
</script>
@endsection