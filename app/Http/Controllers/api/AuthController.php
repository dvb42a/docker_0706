<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $user=User::create([
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>\Hash::make($request->password)
        ]);
        $token=$user->createToken('Token')->accessToken;
        return response()->json(['message' => 'User created successfully'], 201);
    }

    public function login(Request $request)
    {
        $data=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if(auth()->attempt($data))
        {
/*             Auth::user()->tokens->each(function($token, $key) {
                $token->delete();
            }); */
            $token=auth()->user()->createToken('Token')->accessToken;
            return response()->json(['token'=>$token],200);
        }
        else
        {
            return response()->json(['error'=>'fail to login '],401);
        }
    }

    public function userInfo()
    {
        $user= auth()->user();
        $api= Auth::user()->token();
        $all_token=Auth::user()->token()->where('user_id',Auth()->user()->id)->get();
        return response()->json(['user'=>$user, 'api'=>$api,'all_token'=>$all_token],200);
    }

    public function logout()
    {

        $token= Auth::user()->token();
        $token->delete();
        return response()->json(['message'=>'Successfully logout']);

    }

}
