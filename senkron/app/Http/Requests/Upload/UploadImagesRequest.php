<?php

namespace App\Http\Requests\Upload;

use Illuminate\Foundation\Http\FormRequest;

class UploadImagesRequest extends FormRequest
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
        $validati = [];
        foreach (request()->all() as $key => $value)
            $validati[$key] = 'required|image|file|mimes:jpeg,jpg,bmp,png,webp|mimetypes:image/jpeg,image/png,image/webp,image/bmp|max:2048';
        return $validati;
    }
//    public function messages(): array
//    {
//        return [
//            'name.required'=>"your file doesn’t have name",
//        ];
//    }
}
