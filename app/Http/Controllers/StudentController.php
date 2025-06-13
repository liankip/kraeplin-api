<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function collectionStudent(Request $request)
    {
        $student = Student::filter($request, ['name', 'nisn'])
            ->paginateRequest($request);

        return new JsonResource($student);
    }

    public function documentStudent($id)
    {
        $student = Student::find($id);

        return new JsonResource($student);
    }

    public function createStudent(CreateStudentRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $student = Student::create($data);

        return new JsonResource($student);
    }

    public function updateStudent(UpdateStudentRequest $request, $id)
    {


        return new JsonResource();
    }
}
