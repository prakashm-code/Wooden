<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // dd($request);
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json(['message'=>'Invalid credentials'],401);
        }

        $user = Auth::user();

        $token = $user->createToken('API Token')->accessToken;

        return response()->json([
            'status'=>1,
            'token'=>$token,
            'data'=>$user,
            'message'=>"Login in successfully"
        ]);
    }


    public function changePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'password'=>'required|min:6'
        ]);

        $user->update([
            'password'=>Hash::make($request->password)
        ]);

        return response()->json(['message'=>'Password changed']);
    }
        public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();

        if ($user && $user->token()) {
            $user->token()->revoke(); // revoke current token
        }

        return response()->json([
            'status' => 1,
            'message' => 'Logged out successfully'
        ]);
    }
}
