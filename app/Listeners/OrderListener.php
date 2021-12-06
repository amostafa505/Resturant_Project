<?php

namespace App\Listeners;

use App\Mail\OrderPlaced;
use App\Events\OrderEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderEvent  $event
     * @return void
     */
    public function handle($order)
    {
        Mail::to($order->order->billing_email)->send(new OrderPlaced($order));
    }
}


