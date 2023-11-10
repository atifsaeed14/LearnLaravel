<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'number'=>'sometimes|required',
            'source'=>'sometimes|required',
            'status'=>'sometimes|required',
            'active'=>'sometimes|required',
            'instruction'=>'sometimes|required',
            'first_name'=>'sometimes|required',
            'last_name'=>'sometimes|required',
            'email'=>'sometimes|required',
            'mobile'=>'sometimes|required',
            'lineland'=>'sometimes|required',
            'billing_address1'=>'sometimes|required',
            'billing_address2'=>'sometimes|required',
            'billing_city'=>'sometimes|required',
            'billing_state'=>'sometimes|required',
            'billing_postal_code'=>'sometimes|required',
            'billing_country'=>'sometimes|required',
            'shipping_address1'=>'sometimes|required',
            'shipping_address2'=>'sometimes|required',
            'shipping_city'=>'sometimes|required',
            'shipping_state'=>'sometimes|required',
            'shipping_postal_code'=>'sometimes|required',
            'shipping_country'=>'sometimes|required',
            'promo'=>'sometimes|required',
            'coupon_id'=>'sometimes|required',
            'subtotal'=>'sometimes|required',
            'shipping'=>'sometimes|required',
            'tax'=>'sometimes|required',
            'discount'=>'sometimes|required',
            'total'=>'sometimes|required',
        ];
    }
}
