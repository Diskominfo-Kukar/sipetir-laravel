<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class OpdRequest extends FormRequest
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

                'kode' => 'required|min:1|unique:opd,kode,NULL,id,deleted_at,NULL',
                'nama' => 'required|min:1|unique:opd,nama,NULL,id,deleted_at,NULL',
            ];
        }
        $id = $request->opd->id;

        //untuk update
        return [
            'kode' => 'required|max:255|unique:opd,kode,'.$id.',id,deleted_at,NULL',
            'nama' => 'required|max:255|unique:opd,nama,'.$id.',id,deleted_at,NULL',
        ];
    }
}
