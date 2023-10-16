<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function __construct()
    {

    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $field = filter_var($validated['login'], FILTER_VALIDATE_EMAIL) ? 'email' : (is_numeric($validated['login']) ? 'phone' : 'username');
        if (Auth::attempt([$field => $validated['login'], 'password' => $validated['password']], true))
        {
              $user   = User::where('email', $validated['login'])
                        ->orWhere('username',$validated['login'])
                        ->orWhere('phone', $validated['login'])
                        ->first();
              return response()->json([
                          'user' => $user,
                          'authorization' => [
                                                  'token' => $user->createToken('api_token')->plainTextToken,
                                                  'type' => 'Bearer',
                                             ]
                        ]);
        }
        return response()->json([
                        'message' => 'Invalid credentials',
                    ], 401);

    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);
        $user = User::create($validated);

        return response()->json([
            'user' => $user,
            'message' => 'User created successfully',
            'authorization' => [
                'token' => $user->createToken('api_token')->plainTextToken,
                'type' => 'Bearer',
            ],
        ], 201);
    }

    public function logout()
    {
        // $user = Auth::user();
        // $user->currentAccessToken()->delete();
        // return Response(['data' => 'User Logout successfully.'],200);


        // Auth::user()->tokens()->delete();
        // return response()->json([
        //     'message' => 'Successfully logged out',
        // ]);
    }

    public function refresh()
    {
        // return response()->json([
        //     'user' => Auth::user(),
        //     'authorisation' => [
        //         'token' => Auth::refresh(),
        //         'type' => 'bearer',
        //     ]
        // ]);
    }
}
