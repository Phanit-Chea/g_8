<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class profileUpdateRequest extends FormRequest
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
            'name' => 'sometimes|max:100',
            'email' => 'sometimes|string|max:255|unique:users,email,' .$this->user()->id,
            'phone_number' => 'sometimes|digits_between:5,20|unique:users,phone_number,'.$this->user(),
            'gender' => 'sometimes|string',
            'address' => 'sometimes|string',
            'profile' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
