<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'confirmed', 'string'],
        ];
        // return [
        //     'current_password' => ['required'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ];
    }
}
