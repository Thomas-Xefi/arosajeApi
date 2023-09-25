<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        // TODO : Faire le mail unique sauf sur l'ancien mail
        return [
            'firstname' => ['nullable', 'string'],
            'lastname' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
            'phone_number' => ['nullable'],
            'address' => ['nullable'],
            'password' => ['nullable'],
        ];
    }
}
