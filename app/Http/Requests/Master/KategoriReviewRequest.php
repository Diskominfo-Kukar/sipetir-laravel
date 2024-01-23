<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class KategoriReviewRequest extends FormRequest
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

                'nama' => 'required|min:1|unique:kategori_review,nama,NULL,id,deleted_at,NULL',
            ];
        }
        $id = $request->kategori_review->id;

        //untuk update
        return [
            'nama' => 'required|max:255|unique:kategori_review,nama,'.$id.',id,deleted_at,NULL',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Kategori Wajib Diisi',
            'nama.unique'   => 'Kategori Harus berbeda dengan data yang lain',
        ];
    }
}
