<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'avatar_id' => 'sometimes|nullable|exists:uploads,id',
            'user_name' => "required|alpha_dash|unique:users,user_name,$this->id",
            'email' => "required|email|unique:users,email,$this->id",
            'phone' => "required|unique:users,phone,$this->id",
        ];
    }
}
