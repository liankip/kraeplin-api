<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateMultipleChoiceRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'duration' => 'required|integer',
            'notes' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
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
