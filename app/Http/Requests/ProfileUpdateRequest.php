<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'sometimes|required|max:255',
            'email' => [
                'sometimes|required',
                 Rule::unique(User::class)->ignore($this->user()->id)
            ],
            'name' => 'sometimes|required|max:255',
            'contact '=> 'sometimes|required|max:255',
            'contact_type '=> 'sometimes|required|max:255',
            'role' => 'sometimes|required|max:255',
            'status' => 'sometimes|required|max:255',
            'address' => 'sometimes|required|max:255',
            'phone' => 'sometimes|required|max:255',
            'avatar' => 'sometimes|required',
        ];
    }
}
