<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
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
            'username' => 'required|max:255',
            'email' => 'required|'.Rule::unique(User::class)->ignore($this->user()->id)].'',
            'name' => 'required|max:255',
            'contact '=> 'required|max:255',
            'contact_type '=> 'required|max:255',
            'role' => 'required|max:255',
            'status' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:255',
            'avatar' => 'required,
        ];
    }
}
