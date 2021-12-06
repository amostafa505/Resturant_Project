@component('mail::message')
Thanks For Trusting Us <br>
    Your Order Details is : <br>
        Email  : {{$order->order['billing_email']}}<br>
        Phone Number : {{$order->order['billing_phone']}}<br>
        Address : {{$order->order['billing_address']}}<br>


Thanks,<br>
Restaurant Mangment System
@endcomponent
