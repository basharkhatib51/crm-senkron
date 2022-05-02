<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => 'required|alpha_dash|unique:users,user_name',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'avatar_id' => 'sometimes|nullable|exists:uploads,id',
            'password' => ['required', Password::default()],
        ];
    }
}
