<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class QuestionRequest extends FormRequest
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
                'nama'        => 'required|min:1|unique:question,nama,NULL,id,deleted_at,NULL',
                'kategori_id' => 'required',
            ];
        }
        $id = $request->question->id;

        //untuk update
        return [
            'nama'        => 'required|max:255|unique:question,nama,'.$id.',id,deleted_at,NULL',
            'kategori_id' => 'required',
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
