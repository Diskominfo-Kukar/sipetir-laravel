<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        if ($request->isMethod('post')) {
            return [
                'role'     => 'required',
                'name'     => 'required',
                'username' => 'required|unique:users,username',
                'email'    => 'required|unique:users,email',
                'password' => 'required',
            ];
        }

        return [
            'role'     => 'required',
            'name'     => 'required',
            'username' => 'required|unique:users,username,'.$request->user->id,
            'email'    => 'required|unique:users,email,'.$request->user->id,
            'password' => '',
        ];
    }

    /**
     * With Validator.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        //untuk open modal sebelumnya
        $modalId = request()->modal_id;

        if ($validator->fails()) {
            session()->flash('open-modal', $modalId);
        }
        // $validator->after(function ($validator) use($modalId) {

        // });
    }
}
