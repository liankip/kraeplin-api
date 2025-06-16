<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Cookie;


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
            $routes = collect(Route::getRoutes())
                ->filter(function ($route) use ($permissionName) {
                    return in_array("permission:$permissionName", $route->gatherMiddleware());
                })
                ->map(function ($route) {
                    return '/' . ltrim($route->uri(), '/');
                })
                ->filter()
                ->values();

            $permissionRoutesMap[] = [
                'permission' => $permissionName,
                'routes' => $routes,
            ];
        }

         return Response::json([
             'permissions' => $permissionRoutesMap,
         ])->withCookie(Cookie::make('token', $token, 60, null, false, true, true, '', 'Strict'));
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
