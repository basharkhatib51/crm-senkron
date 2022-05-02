<?php


namespace App\Http\Requests\Language;

use Illuminate\Foundation\Http\FormRequest;


class StoreLanguageRequest extends FormRequest
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
            'name' => "string|required|unique:languages,name",
            'english_name' => "string|required|unique:languages,english_name",
            'code' => "string|required|unique:languages,english_name",
            'image' => "exists:uploads,id|nullable",

        ];
    }
}
