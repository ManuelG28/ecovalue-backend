<?php

/**
 * Authentication based on https://www.twilio.com/blog/build-restful-api-php-laravel-sanctum
 * @author: Santiago Gil
 * @email: sgilz@eafit.edu.co
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //Asks User class for validating input data
        $validator = User::validateRegister($request);
        if ($validator->fails()){
            return response()->json([
                "message" => "Invalid data",
                "errors" => $validator->errors()->all(),
            ],400);
        }

        //creating a user directly saved to DB
        $validatedData = $validator->validated();
        $user = User::create([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'job' => $validatedData['job'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
        ]);
        
        //Token got from User
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
        ]);
    }

    public function userInfo(Request $request)
    {
        return $request->user();
    }

}