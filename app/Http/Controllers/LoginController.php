<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    // login method
    public function login(LoginRequest $request)
    {
        $data = $request->all();

        // check email
        $user = User::where('email', $data['email'])->first();

        // check password
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'message' => 'Credentials not matched!'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken('private')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response);
    }
}
