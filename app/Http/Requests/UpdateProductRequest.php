<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            'store_id' => [
                'nullable',
                Rule::in(Auth::user()->storeMemberships->pluck('id')),
                /*Rule::exists('stores','id')->where(function ($query){
                    $query->where('user_id', Auth::id());
                }),*///Custom validation Rule
            ],
        ];
    }
}
