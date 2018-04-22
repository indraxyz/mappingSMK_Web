<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'id'                => 'required',
            'password'          => 'required',
            'email'             => 'required|email',
            'nama'              => 'required',
            'nik'               => 'required',
            'tempat_lahir'      => 'required',
            'tgl_lahir'         => 'required',
            'kelamin'           => 'required',
            'pekerjaan'         => 'required',
            'alamat_lengkap'    => 'required',
            'tlp'               => 'required'
        ];
    }

    public function messages()
    {
        return [
            'Nama.required'  => 'A Nama is required',
            'tgl_lahir.required'  => 'Tanggal Lahir is required'
        ];
    }
}
