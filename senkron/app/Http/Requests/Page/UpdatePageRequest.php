<?php


namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;


class  UpdatePageRequest extends FormRequest
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
            'title' => "string|required|unique:pages,title,$this->id",
            'image' => "exists:uploads,id|nullable",
            'background' => "exists:uploads,id|nullable",
            'content' => "required",
            'type' => "in:normal,service|nullable",
            'excerpt' => "nullable",
            'layout' => "in:full,without_menu|nullable",
            'status' => "in:published,waiting_for_review|required",
            'tags' => "nullable|exists:tags,id",
            'category' => "nullable|exists:service_categories,id",
            'slider_id' => "nullable|exists:sliders,id",

        ];
    }
}
