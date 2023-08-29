<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'name' => 'required',
            'image' => 'image|mimes:png,jpg,PNG,jpec',
            'description' => 'required',
            'size' => 'required',
            'color' => 'required',
            'price' => 'required',
            'old_price' => 'required'
        ];
    }
}
