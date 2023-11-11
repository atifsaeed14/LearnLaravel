<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UpdateShippingRequest extends FormRequest
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
            'source'=>'sometimes|required|max:255',
            'status'=>'sometimes|required|max:255',
            'cost'=>'sometimes|required|max:10',
            'order_id' => [
                'nullable',
                Rule::in(Auth::user()->orderMemberships->pluck('id')),
            ]
        ];
    }
}
