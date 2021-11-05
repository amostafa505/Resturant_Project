@component('mail::message')
Please be Noticed That there is a new Contact Need to Keep in touch <br>
    Name  : {{$event->data['name']}}<br>
    Email  : {{$event->data['email']}}<br>
    Massage : {{$event->data['msg']}}<br>


Thanks,<br>
Restaurant Mangment System
@endcomponent
