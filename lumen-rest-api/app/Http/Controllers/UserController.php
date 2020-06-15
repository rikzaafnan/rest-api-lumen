<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\User;

// use hash
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register (Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $hashPassword = Hash::make($password);

        $user = User::create([
            'email' => $email,
            'password' => $hashPassword,
        ]);

        $response = [
            'message' => [
                'text' => "User Created",
            ],
            'code' => 200,
            'data' => [
                'data' => $user
            ]
        ];

        return response()->json($response, $response['code']);
    }

    public function login (Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();
        
        if(!$user) {
            $response =[
                'messages' => [
                    'text' => "Login Failed",
                ],
                'code' => 401
            ];

            return response()->json($response, $response['code']);
        }

        $validPassword = Hash::check($password, $user->password);
        
        if(!$validPassword) {
            $response =[
                'messages' => [
                    'text' => "Login Failed",
                ],
                'code' => 401
            ];

            return response()->json($response, $response['code']);
        }


        // generate token dengan random_byte
        $generateToken = bin2hex(random_bytes(40));

        $user->update([
            'token' => $generateToken
        ]);

        $response =[
            'messages' => [
                'text' => "Login Failed",
            ],
            'code' => 401,
            'data' => [
                'data' => $user
            ]
        ];

        return response()->json($response, $response['code']);

    }
}
