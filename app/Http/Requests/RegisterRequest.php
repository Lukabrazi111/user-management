<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255|min:3',
            'last_name' => 'required|max:255|min:3',
            'username' => 'required|max:150|min:3',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:6000',
            'email' => 'required|email',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password',
        ];
    }
}
