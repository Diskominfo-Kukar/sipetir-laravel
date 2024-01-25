<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:superadmin|admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $crumbs = [
            'Dashboard'      => route('dashboard'),
            'Manajemen User' => '',
        ];

        $data = [
            'pageTitle' => 'Data User',
            'subTitle'  => 'Halaman Manajemen User',
            'icon'      => 'fa fa-users',
            'crumbs'    => $crumbs,
            'dataRole'  => Role::whereNotIn('name', ['superadmin'])->get(),
        ];

        return view('dashboard.user.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->role);
        session()->flash('success', 'User Berhasil Ditambah');

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $data = [
            'user'     => $user,
            'dataRole' => Role::whereNotIn('name', ['superadmin'])->get(),

        ];

        return view('dashboard.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $save = [
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
        ];

        if ($request->password != '') {
            $save['password'] = Hash::make($request->password);
        }

        $user->update($save);
        $user->roles()->detach();
        $user->assignRole($request->role);

        session()->flash('success', 'User Berhasil Diupdate');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        $delete = $user->delete();

        // check data deleted or not
        if ($delete == 1) {
            $class   = 'success';
            $success = true;
            $message = 'Data Telah Dihapus';
        } else {
            $class   = 'error';
            $success = false;
            $message = 'Data tidak ditemukan';
        }

        session()->flash($class, $message);

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    /**
     * Show Datatable.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('id', 'name', 'email', 'username')
                ->whereNotIn('name', ['superadmin'])
                ->with('roles')->get();

            return DataTables::of($data)->addIndexColumn()
                ->addColumn('role', function ($row) {
                    return ucwords($row->roles[0]->name);
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                        <div class="btn-group btn-sm">
                            <a title="edit" href="' . route('user.edit', $row->id) . '" action="' . route('user.update', $row->id) . '" class="btn btn-warning btn-sm remote-modal">
                                <i class="bx bx-edit"></i>
                            </a>
                            <button title="Hapus" type="button" class="btn btn-danger btn-sm deleteConfirmation" data-target="' . route('user.destroy', [$row->id]) . '">
                                <i class="bx bx-trash "></i>
                            </button>
                        </div>
                    ';

                    return $actionBtn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        return abort(404);
    }
}
