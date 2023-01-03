<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\NewOrder;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Models\Media;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;
class OrderController extends Controller
{
    public function store(Request $request) 
    {
        //Generating order number
        $max = Order::max('order_number');
        if(!$max){
        $order_number = 100000;
        }
        else{
            $order_number = $max+1;
        }  
        //inserting to db  
        $client_id=Client::where('email',$request->email)->first()->id;
        $client = Order::create((['type_of_work'=>$request->type_of_work, 'academic_level'=>$request->academic_level, 'pages'=>$request->pages,'deadline'=>$request->deadline,'total_amount'=>$request->total, 'client_id'=>$client_id,'order_number'=>$order_number]));
    
        //sending mails
     
        $mailData = [
            'order_number' => $order_number,
            'total_amount' => $request->total
        ];
        $mailDataAdmin = [
            'order_number' => $order_number,
        ];        
/*
        Mail::to($request->email)->send(new OrderConfirmation($mailData));
        $emails = ['lehanneessays@gmail.com', 'ewrites215@gmail.com'];
        Mail::to( $emails)->send(new NewOrder($mailDataAdmin));
 */ 
        //Question file handling 
            $order_id = Order::where('order_number',$order_number)->first()->id;
            $file = $request->file('file');
            $name = $file->hashName(); 
            if (Media::where('name', $name)->exists()) {
                $name = $file->hashName(); 
            }
            Media::create(
                [
                'order_id'=> $order_id,                  
                'name' => "{$name}",
                'file_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getClientMimeType(),
                'path' => "orderFiles/{$name}",
                'collection' => $request->get('collection'),
                'size' => $file->getSize(),
                ],
        );      

            Storage::disk('local')->put('orderFiles/'.$file->hashName(),$file);                
    
        
        return response()->json('order success');

 }

    public function read(Request $request, $query = '')
    {
        if($query != ''){
        $Orders = Order::Where('order_number', 'like',"%{$query}%")->with('client')->paginate(20);     
        }
        else{
            $Orders = Order::with('client')->paginate(20); 
        }
        return response()->json($Orders);
    }


    public function download(Request $request)
    {
        $var = Media::where('order_id',$request->id)->first('name');
        $name =$var->name;
        $dbpath = Media::where('order_id',$request->id)->get('path');
        $path = storage_path("app/orderFiles/{$name}/{$name}");

        $headers = [

        ];
        return response()->download($path);
    }

    public function tracker(Request $request)
    {
        $var = Order::where('order_number',$request->order_number)->with('client')->first();
        return response()->json($var);
    }
    public function start(Request $request)
    {    
       $order = Order::find($request->id,'id');
       
        $order->status = 'process';
        
        $order->save();
    }
    public function complete(Request $request)
    {
        $order = Order::find($request->id,'id');
       
        $order->status = 'complete';
        $order->save();
    }
    public function cancel(Request $request)
    {
        $order = Order::find($request->id,'id');
       
        $order->status = 'cancelled';
        
        $order->save();
    }


    public function completed(Request $request, $query = '')
    {
        if($query != ''){
        $Orders = Order::Where('order_number', 'like',"%{$query}%")->with('client')->where('status','complete')->paginate(20);     
        }
        else{
            $Orders = Order::with('client')->where('status','complete')->paginate(20); 
        }
        return response()->json($Orders);
    }

    public function pending(Request $request, $query = '')
    {
        if($query != ''){
        $Orders = Order::Where('order_number', 'like',"%{$query}%")->with('client')->where('status','pending')->paginate(20);     
        }
        else{
            $Orders = Order::with('client')->where('status','new')->paginate(20); 
        }
        return response()->json($Orders);
    }

    public function cancelled(Request $request, $query = '')
    {
        if($query != ''){
        $Orders = Order::Where('order_number', 'like',"%{$query}%")->with('client')->where('status','cancelled')->paginate(20);     
        }
        else{
            $Orders = Order::with('client')->where('status','cancelled')->paginate(20); 
        }
        return response()->json($Orders);
    }





    public function destroy(Request $request)
    {
       
        return response()->json( Order::where('id',$request->id)->delete());
    }
}
