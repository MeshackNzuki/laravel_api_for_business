<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function store(Request $request){
     $client = Client::create((['first_name'=>$request->first_name, 'second_name'=>$request->second_name,'phone'=>$request->phone,'email'=>$request->email]));
  
    }
    public function read(Request $request){
        $client = Client::paginate(20);  
        return response()->json($client); 
       }
    
}
