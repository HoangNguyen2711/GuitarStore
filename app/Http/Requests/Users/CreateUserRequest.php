<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:10|unique:users,phone',
            'gender' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,PNG,jpec,webp',
            'password' => 'required|string|min:5',
            'email'=> 'required|email|unique:users,email'
        ];
    }
}
