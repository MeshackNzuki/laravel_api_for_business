<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\NewOrder;
use App\Mail\OrderConfirmation;
class MailController extends Controller
{
    public function index()
    {
        $mailData = [
            'title' => 'Mail from experteacademichelp',
            'body' => 'This is for testing email using smtp.'
        ];
         
        Mail::to('meshkaka1@gmail.com')->send(new NewOrder($mailData));
           
        return response("Email is sent successfully.");
    }
}
