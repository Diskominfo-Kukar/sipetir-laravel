<?php

namespace App\Http\Controllers\Dashboard;

use App\Rules\MatchPassword;
use Hash;
use Illuminate\Http\Request;
use Validator;

class AkunController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $crumbs = [
            'Dashboard' => route('dashboard'),
            'Akun'      => '',
        ];

        $data = [
            'pageTitle' => 'Akun',
            'subTitle'  => 'Profile User',
            'icon'      => 'pe-7s-user',
            'crumbs'    => $crumbs,
            'user'      => auth()->user(),
        ];

        return view('dashboard.akun', $data);
    }

    /**
     * Handle an incoming registration request.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'username' => 'required|unique:users,username,'.auth()->user()->id.',id,deleted_at,NULL',
            'email'    => 'required|email|unique:users,email,'.auth()->user()->id.',id,deleted_at,NULL',
        ]);
        auth()->user()->update([
            'username' => $request->username,
        ]);
        session()->flash('success', 'Akun Berhasil Diupdate');

        return redirect()->back();
    }

    /**
     * Display Password Edit.
     *
     * @return \Illuminate\View\View
     */
    public function passwordEdit()
    {
        $crumbs = [
            'Dashboard'       => route('dashboard'),
            'Akun'            => route('akun.index'),
            'Update Password' => '',
        ];

        $data = [
            'pageTitle' => 'Password',
            'subTitle'  => 'Update Password Login',
            'icon'      => 'pe-7s-lock',
            'crumbs'    => $crumbs,
        ];

        return view('dashboard.password', $data);
    }

    /**
     * Handle an incoming password update request.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function passwordUpdate(Request $request)
    {
        $rules = [
            'old_password'          => ['required', new MatchPassword],
            'password'              => 'required',
            'password_confirmation' => 'required|same:password',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('akun.password.edit')
                ->withInput($request->all())
                ->withErrors($validator);
        }

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);
        session()->flash('success', 'Password Berhasil Diupdate');

        return redirect()->route('akun.password.edit');
    }
}
