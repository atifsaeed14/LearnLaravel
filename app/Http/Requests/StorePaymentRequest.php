<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StorePaymentRequest extends FormRequest
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
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'source' => 'required|max:255',
            'status' => 'in:active,inactive,other',
            'note' => 'required|max:255',
            'order_id' => [
                'nullable',
                Rule::in(Auth::user()->orderMemberships->pluck('id')),
                ],
        ];
    }
}
