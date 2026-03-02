<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name'=>'require|string|max:255',
            'email'=>'require|string|email|unique:users',
            'password'=>'require|min:6'

        ]);

        $user = User.create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->$password),
        ]);

        $token = $user->createToken('token')->plainTextToken;

        return response()->json(['user'=>$user, 'token'=>$token], 201);
    }
    
    public function login(){}

    public function logout(){}
}
