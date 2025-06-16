<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateMultipleChoiceSchedulerRequest extends FormRequest
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
            'id_multiple_choice' => 'required|integer|exists:multiple_choices,id',
            'date' => 'required|date_format:Y-m-d H:i:s',
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
