<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterSiswaRequest;
use App\Models\Student;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function registerStudent(RegisterSiswaRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $siswa = Student::create($data);

        return new JsonResource([
            'success' =>  true,
            'message' => 'Registration siswa successful',
            'data' => $siswa,
        ]);
    }
}
