<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $success['token'] = $user->createToken('Lararest aut')->accessToken;

        return response()->json(['success'=> $success], 200);
    }

    public function login(){
        if(Auth::attempt([
            'email' => request('email'),
            'password' => request('password')
        ])){

            $user = Auth::user();
            $success['token'] = $user->createToken('Lararest aut')->accessToken;
            return response()->json(['success'=> $success], 200);

        }else{
            return response()->json(['error'=> 'User is Loh'], 401);
        }
    }
}
