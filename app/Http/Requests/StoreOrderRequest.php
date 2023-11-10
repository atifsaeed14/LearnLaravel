<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'number'=>'required',
            'source'=>'required',
            'status'=>'required',
            'active'=>'required',
            'instruction'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'mobile'=>'required',
            'lineland'=>'required',
            'billing_address1'=>'required',
            'billing_address2'=>'required',
            'billing_city'=>'required',
            'billing_state'=>'required',
            'billing_postal_code'=>'required',
            'billing_country'=>'required',
            'shipping_address1'=>'required',
            'shipping_address2'=>'required',
            'shipping_city'=>'required',
            'shipping_state'=>'required',
            'shipping_postal_code'=>'required',
            'shipping_country'=>'required',
            'promo'=>'required',
            'coupon_id'=>'required',
            'subtotal'=>'required',
            'shipping'=>'required',
            'tax'=>'required',
            'discount'=>'required',
            'total'=>'required',
        ];
    }
}
