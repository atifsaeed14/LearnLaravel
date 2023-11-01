<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreRequest extends FormRequest
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
            'name'=>'sometimes|required|max:255',
            'code'=>'sometimes|required|max:255',
            'symbol'=>'sometimes|required|max:255',
            'email'=>'sometimes|required|max:255',
            'tagline'=>'sometimes|required|max:255',
            'description'=>'sometimes|required|max:255',
            'contact'=>'sometimes|required|max:255',
            'contact_type'=>'sometimes|required|max:255',
            'cover'=>'sometimes|required|max:255',
            'logo'=>'sometimes|required|max:255',
            'status'=>'sometimes|required|max:255',
            'address1'=>'sometimes|required|max:255',
            'address2'=>'sometimes|required|max:255',
            'city'=>'sometimes|required|max:255',
            'state'=>'sometimes|required|max:255',
            'postal_code'=>'sometimes|required|max:255',
            'country'=>'sometimes|required|max:255',
            'shipping'=>'sometimes|required|max:255',
            'tax'=>'sometimes|required|max:255'
        ];
    }
}
