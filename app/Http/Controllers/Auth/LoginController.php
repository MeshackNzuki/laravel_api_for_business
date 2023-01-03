<?php

namespace App\Http\Controllers\auth;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPassword;
use Mail;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => "required",
            'password' => "required",
        ]);    
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->username;
   
            return response()->json($success);
        } 
        else{ 
            return response('Bad credentials.');
        } 
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reset(Request $request, $arg)
    {     

         $user = User::where('email', $arg)->first('username');
         $pass = uniqid();
                 User::where('email',$arg)->update(['password'=>Hash::make($pass)]);

            $mailData = [
                'username' => $user->username,
                'password' => $pass
            ];  
            
            return response($mailData);
           $emails = ['lehanneessays@gmail.com', 'ewrites215@gmail.com'];
           Mail::to($emails)->send(new ResetPassword($mailData));
        
           try {   } catch (\Throwable $th) {
     
          return response()->json('Not Allowed');
        }



    }
    public function change(Request $request)
    { 
        $resp= User::where('username',$request->username)->update(['password'=>Hash::make($request->password)]);

          return response()->json($resp);
     }



    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->user()->currentAccessToken()->delete();

        return response()->json("success");
    }
    public function read(Request $request)
    {    

        return response()->json(User::where('username',$request->name)->get());
    }
}
