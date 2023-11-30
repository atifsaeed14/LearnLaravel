<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
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
                "type"=>"sometimes|required|max:255",
                "promo"=>"sometimes|required|max:255",
                "percentage"=>"sometimes|required|max:255",
                "comment"=>"sometimes|required|max:255",
                "status"=>"sometimes|required|max:255",
        ];
    }
}
