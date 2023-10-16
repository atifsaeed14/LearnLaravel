<?php

namespace App\Http\Requests;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|max:255',
            'thumbnail' => 'sometimes|required|max:255',
            'sku' => 'sometimes|required|max:255',
            'tagline' => 'sometimes|required|min:3|max:500',
            'description' => 'sometimes|required|min:3|max:1000',
            'price' => 'sometimes|required|regex:/^\d+(\.\d{1,2})?$/',
            'discount' => 'sometimes|required|regex:/^\d+(\.\d{1,2})?$/',
            'status' => 'sometimes|required|in:active,inactive,other',
            'published' => 'sometimes|required|integer|min:1',
            'featured' => 'sometimes|required|integer|min:1',
            'stock' => 'sometimes|required|integer|min:1',
            'store_id' => 'sometimes|required|integer|min:1',
            'user_id' => 'sometimes|required|integer|min:1'
        ];
    }
}
