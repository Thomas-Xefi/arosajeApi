<?php

namespace App\Http\Requests\Plant;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePlantRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'max:150'],
            'description' => ['nullable', 'max:500'],
            'price' => ['nullable', 'numeric'],
            'guardian_id' => ['nullable', 'uuid', 'exists:users,id'],
            'status_id' => ['nullable', 'uuid', 'exists:status,id']
        ];
    }
}
