<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginSiswaRequest;
use App\Models\Student;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class AuthStudentController extends Controller
{
    public function login(LoginSiswaRequest $request)
    {
        $user = Student::where('username', $request['username'])->first();

        if (!$user || !Hash::check($request['password'], $user->password)) {
            return response([
                'message' => 'Wrong credentials'
            ]);
        }

        $token = $user->createToken('my-token')->plainTextToken;

        return response()->api(true, 'Login siswa successful', [
            'token' => $token,
        ], 200);
    }
}
