<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PanitiaRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        if ($request->isMethod('post')) {
            return [
                'nik'        => 'required|min:1|unique:panitia,nik,NULL,id,deleted_at,NULL',
                'nip'        => 'required|min:1|unique:panitia,nip,NULL,id,deleted_at,NULL',
                'nama'       => 'required',
                'no_hp'      => 'required',
                'jabatan_id' => 'required',
                'username'   => 'required|min:5|unique:users,username,NULL,id,deleted_at,NULL',
                'email'      => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
                'password'   => 'required|min:6',
            ];
        }
        $id = $request->panitia->id;

        //untuk update
        return [
            'nik'        => 'required|max:255|unique:panitia,nik,'.$id.',id,deleted_at,NULL',
            'nip'        => 'required|max:255|unique:panitia,nip,'.$id.',id,deleted_at,NULL',
            'nama'       => 'required',
            'no_hp'      => 'required',
            'jabatan_id' => 'required',
            'username'   => 'required|max:255|unique:users,username,'.$id.',id,deleted_at,NULL',
            'email'      => 'required|email|max:255|unique:users,email,'.$id.',id,deleted_at,NULL',
            // 'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama Wajib Diisi',
            'nama.unique'   => 'Nama Harus berbeda dengan data yang lain',
        ];
    }
}
