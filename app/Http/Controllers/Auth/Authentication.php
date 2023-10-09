<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class Authentication extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if (! Auth::attempt($data)) {
            return response([
                'message' => 'Incorect Credentials',
            ], 401);
        }
        $token = auth()->user()->createToken('token')->plainTextToken;

        return response([
            'Token' => $token,
        ], 200);

    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response([
            'message' => 'Logoueted',
        ], 200);
    }
}
