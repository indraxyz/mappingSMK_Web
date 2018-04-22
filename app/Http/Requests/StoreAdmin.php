<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdmin extends FormRequest
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
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email',
            'akses' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required'  => 'A e-mail is required',
            'akses.required'  => 'A akses is required'
        ];
    }
}
