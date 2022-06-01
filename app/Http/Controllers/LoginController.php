<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        $data = $request->only(['email','password']);
        $token = Auth::attempt($data);
        if(!$token){
         return response()->json([
             'message'=>"Invalid credentials"
         ],401);
        }
           return response()->json([
                'token'=>$token,
                'user'=>Auth::user(),
                'message'=>'Login successfully completed!'
            ]);
        
    }
    public function getMyProfile(){
        $user = Auth::user();
        return response()->json($user);
    }
}
