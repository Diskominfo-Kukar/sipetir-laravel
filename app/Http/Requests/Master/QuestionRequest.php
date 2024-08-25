<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
                'nama' => [
                    'required',
                    'min:1',
                    Rule::unique('question')->where(function ($query) {
                        $parentId = request()->input('parent_id');

                        if ($parentId) {
                            return $query->where('parent_id', $parentId)
                                ->where('kategori_id', request()->input('kategori_id'))
                                ->where('deleted_at', null);
                        } else {
                            return $query->whereNull('parent_id')
                                ->where('kategori_id', request()->input('kategori_id'))
                                ->where('deleted_at', null);
                        }
                    }),
                ],
                'deskripsi'   => 'required',
                'kategori_id' => 'required',
                'parent_id'   => 'sometimes',
            ];
        }
        $id = $request->question->id;

        //untuk update
        return [
            'nama' => [
                'required',
                'min:1',
                Rule::unique('question')->ignore($id)->where(function ($query) {
                    $parentId = request()->input('parent_id');

                    if ($parentId) {
                        return $query->where('parent_id', $parentId)
                            ->where('kategori_id', request()->input('kategori_id'))
                            ->where('deleted_at', null);
                    } else {
                        return $query->whereNull('parent_id')
                            ->where('kategori_id', request()->input('kategori_id'))
                            ->where('deleted_at', null);
                    }
                }),
            ],
            'deskripsi'   => 'required',
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
