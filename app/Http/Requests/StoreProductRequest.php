<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'title' => 'required|max:255',
            'thumbnail' => 'required|max:255',
            'sku' => 'required|max:255',
            'tagline' => 'required|min:3|max:500',
            'description' => 'required|min:3|max:1000',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'discount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'status' => 'in:active,inactive,other',
            'published' => 'required|integer|min:1',
            'featured' => 'required|integer|min:1',
            'stock' => 'required|integer|min:1',
            'store_id' => [
                'nullable',
                Rule::exists('stores','id')->where(function ($query){
                    $query->where('user_id', Auth::id());
                }),
            'user_id' => 'required|integer|min:1'
        ];
    }
}
