<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function loginUsers(LoginRequest $request)
    {
        $user = User::where('username', $request['username'])->first()
            ?? Student::where('username', $request['username'])->first();

        if (!$user || !Hash::check($request['password'], $user->password)) {
            return new JsonResource(['message' => 'Wrong credentials']);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        $userPermissions = $user->getAllPermissions()->pluck('name');

        $permissionRoutesMap = [];

        foreach ($userPermissions as $permissionName) {
            $permissionRoutesMap[] = $permissionName;
        }

        return Response::json([
            'username' => $user->username,
            'permissions' => $permissionRoutesMap,
            'token' =>  $token,
        ]);
    }

    public function me(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());

        if (!$token) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        $user = $token->tokenable;

        $userPermissions = $user->getAllPermissions()->pluck('name');

        $permissionRoutesMap = [];

        foreach ($userPermissions as $permissionName) {
            $permissionRoutesMap[] = $permissionName;
        }

        return new JsonResource([
            'username' => $user->username,
            'permissions' => $permissionRoutesMap,
        ]);
    }

    public function logout(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());

        if (!$token) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        $user = $token->tokenable;

        if ($user) {
            $user->tokens()->where('id', $token->id)->delete();
        }

        return new JsonResource([
            'message' => 'Successfully logged out',
        ]);
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
