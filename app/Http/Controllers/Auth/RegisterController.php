<?php
namespace  App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller 
{
    public function store(Request $request)
    {         
    $user = User::create((['username'=>$request->username, 'email'=>$request->email, 'password'=>Hash::make($request->password)]));
    return response()->json('success');
    }
}