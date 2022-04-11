<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request()->segment(2);

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'dob' => 'required',
            'phone' => 'required|numeric',
            'gender' => 'required',
        ];

        if (request('password') != '') {
            $rules['password'] = ['required', 'string', 'min:8', 'same:confirm_password'];
            $rules['confirm_password'] = ['required', 'string', 'min:8'];
        }

        return $rules;
    }
}
