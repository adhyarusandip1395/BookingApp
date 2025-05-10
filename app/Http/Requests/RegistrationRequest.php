<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', Password::min(8)
            ->mixedCase()
            ->letters()
            ->numbers()
            ->symbols()],
        ];
    }

    public function messages()
    {
        $pass_error = 'Password should be at least 8 characters, including at least one uppercase letter, one lowercase letter, one number, and one symbol';
        
        return [
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email format',
            'password.required' => 'Password is required',
            'password.min' => $pass_error,
            'password.mixedCase' => $pass_error,
            'password.letters' => $pass_error,
            'password.numbers' => $pass_error,
            'password.symbols' => $pass_error,
        ];
    }
}
