<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userStore extends FormRequest
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
        // dd(Request());
        return [
            'name'      => 'required|string|min:5|max:50|unique:users,name',
            'email'     => 'required|email:filter|unique:users,email',
            'address'   => 'nullable|string|min:10|max:100',
            'phone'     => 'nullable|string|min:10|max:15',
            'password'  => 'required|string|min:6|max:60',
            'img'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'is_admin'  => 'required|boolean',
        ];
    }
}
