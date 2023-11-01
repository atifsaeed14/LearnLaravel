<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
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
            'name'=>'required|max:255',
            'code'=>'required|max:255',
            'symbol'=>'required|max:255',
            'email'=>'required|max:255',
            'tagline'=>'required|max:255',
            'description'=>'required|max:255',
            'contact'=>'required|max:255',
            'contact_type'=>'required|max:255',
            'cover'=>'required|max:255',
            'logo'=>'required|max:255',
            'status'=>'required|max:255',
            'address1'=>'required|max:255',
            'address2'=>'required|max:255',
            'city'=>'required|max:255',
            'state'=>'required|max:255',
            'postal_code'=>'required|max:255',
            'country'=>'required|max:255',
            'shipping'=>'required|max:255',
            'tax'=>'required|max:255'
        ];
    }
}
