<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;
use App\Events\contactformEvent;

class contactController extends Controller
{
    public function sendcontact(ContactFormRequest $request)
    {
        $validated = $request->validated();
        event(new contactformEvent($validated));
        toastr()->success('Done Send Your Contact To the Admin');
        return back();
    }
}
