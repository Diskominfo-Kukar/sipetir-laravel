<?php

namespace App\Http\Requests\Master;

use App\Models\Master\Ppk;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PpkRequest extends FormRequest
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
        if (request()->isMethod('post')) {
            return [
                'nik'      => 'required|min:1|unique:ppk,nik,NULL,id,deleted_at,NULL',
                'nip'      => 'required|min:1|unique:ppk,nip,NULL,id,deleted_at,NULL',
                'nama'     => 'required',
                'no_hp'    => 'required',
                'opd_id'   => 'required',
                'username' => 'required|min:5|unique:users,username,NULL,id,deleted_at,NULL',
                'email'    => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
                'password' => 'required|min:6',
            ];
        }
        $id      = request()->segment(3);
        $user_id = Ppk::find($id)->value('user_id');

        //untuk update
        return [
            'nik'      => 'required|max:255|unique:ppk,nik,'.$id.',id,deleted_at,NULL',
            'nip'      => 'required|max:255|unique:ppk,nip,'.$id.',id,deleted_at,NULL',
            'nama'     => 'required',
            'no_hp'    => 'required',
            'opd_id'   => 'required',
            'username' => 'required|min:5|unique:users,username,'.$user_id.',id,deleted_at,NULL',
            'email'    => [
                'required',
                'email',
                Rule::unique('users')->ignore($user_id)->whereNull('deleted_at'),
            ],
            'password' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama Wajib Diisi',
            'nama.unique'   => 'Nama Harus berbeda dengan data yang lain',
        ];
    }

    public function withValidator($validator)
    {
        if (request()->isMethod('post')) {
            $modalId = request()->modal_id;

            if ($validator->fails()) {
                session()->flash('open-modal', $modalId);
            }
        }
    }
}
