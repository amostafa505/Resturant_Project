<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdate extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|string|min:5|max:50',
            'email'     => ['required', 'email', 'max:255',Rule::unique('users')->ignore($this->user)], //<= this Rule for makeing the unique validation not working when the same email given in updating
            'password'  => 'nullable|string|min:6|max:60',
            'img'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'is_admin'  => 'required|boolean',
        ];
    }
}
