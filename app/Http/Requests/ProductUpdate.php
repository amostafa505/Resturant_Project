<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ProductUpdate extends FormRequest
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
            'name'          => 'required|min:3|max:60',
            'price'         => 'required|numeric',
            'qty'           => 'required|numeric',
            'menu_id'       => 'required',
            'description'   => 'nullable|min:10|max:200',
            'status'        => 'required|in:pending,active,notactive',
            'discount'      => 'nullable|numeric',
            'image_id'      => 'nullable',
            'image_id.*'    => 'mimes:jpeg,png,jpg,gif,svg',
        ];
    }
    // public function failedValidation(Validator $validator)
    // {
    //    throw new HttpResponseException(response()->json([
    //      'success'   => false,
    //      'message'   => 'Validation errors',
    //      'data'      => $validator->errors()
    //    ]));
    // }
}
