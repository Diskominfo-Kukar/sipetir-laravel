<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class JenisDokumenRequest extends FormRequest
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

                'nama' => 'required|min:1|unique:jenis_dokumen,nama,NULL,id,deleted_at,NULL',
            ];
        }
        $id = request()->jenis_dokuman->id;

        //untuk update
        return [
            'nama' => 'required|max:255|unique:jenis_dokumen,nama,'.$id.',id,deleted_at,NULL',
        ];
    }

    public function withValidator($validator)
    {
        $modalId    = request()->modal_id;
        $action_url = request()->action_url;
        $load_url   = request()->load_url;

        if (request()->isMethod('post')) {
            if ($validator->fails()) {
                session()->flash('open-modal', $modalId);
            }
        } else {
            // dd(request());
            if ($validator->fails()) {
                session()->flash('edit-modal', $modalId);
                session()->flash('action-modal', $action_url);
                session()->flash('load_url', $load_url);
            }
        }
    }
}
