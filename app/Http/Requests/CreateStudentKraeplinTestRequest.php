<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateStudentKraeplinTestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_student' => 'required|integer|exists:students,id',
            'id_kreaplin_schedule' => 'required|integer|exists:kraeplin_schedules,id',
            'start' => 'required|date_format:Y-m-d H:i:s|after_or_equal:' . date(DATE_ATOM),
            'finish' => 'required|date_format:Y-m-d H:i:s|after_or_equal:start',
            'right_count' => 'required|integer',
            'false_count' => 'required|integer',
            'duration' => 'required|integer',
            'status' => 'required|in:running,finished',
        ];
    }

    protected function failedValidation($validator): void
    {
        throw new HttpResponseException(
            response()->api(false, 'Validation failed', [
                'errors' => $validator->errors()
            ], 200)
        );
    }
}
