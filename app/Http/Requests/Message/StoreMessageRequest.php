<?php

namespace App\Http\Requests\Message;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
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
            'sender_id' => ['required', 'uuid', 'exists:users,id'],
            'receiver_id' => ['required', 'uuid', 'exists:users,id'],
            'content' => ['required', 'string', 'max:1000'],
            'send_at' => ['required', 'date'],
        ];
    }
}
