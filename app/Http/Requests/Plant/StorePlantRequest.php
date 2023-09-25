<?php

namespace App\Http\Requests\Plant;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePlantRequest extends FormRequest
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
            'name' => ['required', 'max:150'],
            'description' => ['nullable', 'max:500'],
            'price' => ['required', 'numeric'],
            'plant_species_id' => ['required', 'uuid', 'exists:plant_species,id']
        ];
    }
}
