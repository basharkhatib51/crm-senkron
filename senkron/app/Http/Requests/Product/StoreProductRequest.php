<?php


namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;


class StoreProductRequest extends FormRequest
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
            'name' => "string|required",
            'image_id' => "nullable|exists:uploads,id",
            'description' => "nullable",
            'images.*.id' => "nullable|exists:uploads,id",
            'price' => "numeric|nullable",
            'tags' => "nullable|exists:tags,id",
            'category' => "nullable|exists:categories,id",
            'details.*' => "nullable",
        ];
    }
}
