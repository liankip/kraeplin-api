<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateMultipleChoiceScheduleGroupRequest extends FormRequest
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
            'id_group' => 'required|integer|exists:groups,id',
            'id_multiple_choice_schedule' => 'required|integer|exists:multiple_choice_schedulers,id',
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
