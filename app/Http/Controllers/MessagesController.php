<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages as Msg;
use App\Mail\NewMessage;
use Mail;

class MessagesController extends Controller
{
    public function store(Request $request){           
         Msg::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message
         ]);
              
        $mailData = [
            'order_number' => 'none',
            'total_amount' => 'none'
        ];
     
        $emails = ['lehanneessays@gmail.com', 'ewrites215@gmail.com'];
        Mail::to($emails)->send(new NewMessage($mailData));

       return  response()->json('success');
    }
    
    public function read(Request $request)
    {
        return response()->json(Msg::paginate(20));
    }
    public function readView(Request $request)
    {
        return response()->json(Msg::where("id",$request->id)->first());
    }
    public function destroy(Request $request)
    {
        return response()->json(Msg::where("id",$request->id)->delete());
    }
    
}
