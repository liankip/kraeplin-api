<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginUsers(LoginRequest $request)
    {
        $user = User::where('username', $request['username'])->first();

        if (!$user) {
            $user = Student::where('username', $request['username'])->first();
        }

        if (!$user || !Hash::check($request['password'], $user->password)) {
            return new JsonResource(['message' => 'Wrong credentials']);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return new JsonResource(['token' => $token]);
    }

    public function createUser(CreateUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'admin';

        $user = User::create($data);

        return new JsonResource($user);
    }
}
