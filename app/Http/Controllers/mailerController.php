<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class mailerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        Mail::to("hafiz.bukhari@hotmail.com")->send(new Mailer());
    }
}
