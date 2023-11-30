<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreOrderItemRequest extends FormRequest
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
            'quantity' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'discount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'status' => 'required|in:available,pending,active,inactive,other',
            'store_id' => [
                'nullable',
                Rule::in(Auth::user()->stores->pluck('id')),
                ],
            'product_id' => [
                'nullable',
                Rule::in(Auth::user()->products->pluck('id')),
                ],
            'order_id' => [
                'nullable',
                Rule::in(Auth::user()->orderMemberships->pluck('id')),
                ],
        ];
    }
}
