<?php


namespace App\Http\Requests\Language;

use Illuminate\Foundation\Http\FormRequest;


class  UpdateLanguageRequest extends FormRequest
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
            'name' => "string|required|unique:languages,name,$this->id",
            'english_name' => "string|required|unique:languages,name,$this->id",
            'code' => "string|required|unique:languages,name,$this->id",
            'image' => "exists:uploads,id|nullable",
        ];
    }
}
