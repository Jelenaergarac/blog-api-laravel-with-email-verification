<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class LogoutController extends Controller
{
    public function logout(){
        Auth::logout();
        return response()->noContent();
    }
    public function refreshToken(){
        try{
            $token = Auth::refresh();
            return [
                'token'=>$token
            ];
        }catch(TokenBlacklistedException $exception){
            return response()->json([
                'message'=>'Invalid token'
            ],401);
        }
    }
}
