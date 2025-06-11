<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginUsers(LoginRequest $request)
    {
        $user = User::where('username', $request['username'])->first();

        if (!$user || !Hash::check($request['password'], $user->password)) {
            return response()->api(false, 'Wrong credentials', [], 200);
        }

        $token = $user->createToken('admin-token')->plainTextToken;

        return response()->api(true, 'Login admin successful', [
            'token' => $token,
        ], 200);
    }

    public function registerUsers(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'admin';

        User::create($data);

        return response()->api(true, 'Register admin successful', [], 201);
    }
}
