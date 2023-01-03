<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Order;

class DashboardController extends Controller
{
    public function read(Request $request){

       $Orders = Order::count(); 
       $Clients = Client::count(); 
       $Pending = Order::where('status','new')->count(); 
       $Completed = Order::where('status','pending')->count(); 
       

        return response()->json([
            'orders' => $Orders,
            'clients' => $Clients,
            'pending' => $Pending,
            'completed' => $Completed,
            ]
        );
    }
}