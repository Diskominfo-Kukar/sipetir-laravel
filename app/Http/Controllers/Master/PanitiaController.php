<?php

namespace App\Http\Controllers\Master;

use App\Http\Requests\Master\PanitiaRequest;
use App\Models\Master\Jabatan;
use App\Models\Master\Panitia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PanitiaController extends Controller
{
    public function __construct()
    {
        $this->route = 'panitia';
        $this->title = 'Panitia';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $title  = $this->title;
        $crumbs = [
            'Dashboard'          => route('dashboard'),
            'Master'             => '',
            "Manajemen {$title}" => '',
        ];

        $data = [
            'pageTitle'   => "Data {$title}",
            'subTitle'    => "Halaman Manajemen {$title}",
            'icon'        => 'fa fa-building',
            'route'       => $this->route,
            'crumbs'      => $crumbs,
            'dataJabatan' => Jabatan::get(),
        ];

        return view('dashboard.master.'.$this->route.'.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PanitiaRequest $request)
    {
        $validate = $request->validated();

        DB::transaction(function () use ($validate) {
            $jabatan_id   = $validate['jabatan_id'];
            $validateUser = [
                'name'     => $validate['nama'],
                'username' => $validate['username'],
                'email'    => $validate['email'],
                'password' => bcrypt($validate['password']),
            ];
            $jabatan = Jabatan::find($jabatan_id);
            $user    = User::create($validateUser);
            $user->assignRole($jabatan->nama);
            $validatePanitia = [
                'nik'        => $validate['nik'],
                'nip'        => $validate['nip'],
                'nama'       => $validate['nama'],
                'no_hp'      => $validate['no_hp'],
                'jabatan_id' => $validate['jabatan_id'],
                'user_id'    => $user->id,
            ];
            Panitia::create($validatePanitia);
        });

        session()->flash('success', $this->title.' Berhasil Ditambahkan');

        return redirect()->route($this->route.'.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        $panitia = Panitia::find($id);
        $data    = [
            'panitia'     => $panitia,
            'dataJabatan' => Jabatan::get(),
        ];

        return view('dashboard.master.'.$this->route.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PanitiaRequest $request, Panitia $panitium)
    {
        // return $panitium;
        // $panitias = Panitia::find($panitia);
        $validate   = $request->validated();
        $jabatan_id = $validate['jabatan_id'];

        $user_id      = $panitium->user_id;
        $validateUser = [
            'name'     => $validate['nama'],
            'username' => $validate['username'],
            'email'    => $validate['email'],
            'password' => bcrypt($validate['password']),
        ];

        $jabatan = Jabatan::find($jabatan_id);
        $user    = User::find($user_id);
        $user->update($validateUser);
        $user->assignRole($jabatan->nama);

        $validatePanitia = [
            'nik'        => $validate['nik'],
            'nip'        => $validate['nip'],
            'nama'       => $validate['nama'],
            'no_hp'      => $validate['no_hp'],
            'jabatan_id' => $validate['jabatan_id'],
            'user_id'    => $user->id,
        ];
        $panitium->update($validatePanitia);

        session()->flash('success', $this->title.'Review Berhasil Diupdate');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Panitia $panitium)
    {
        $delete = $panitium->delete();

        // check data deleted or not
        if ($delete) {
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

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Panitia::get();

            return DataTables::of($data)->addIndexColumn()
                ->addColumn('jabatan', function ($row) {
                    return ucwords($row->jabatan);
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                        <div class="btn-group btn-sm">
                            <a title="edit" href="'.route($this->route.'.edit', $row->id).'" action="'.route($this->route.'.update', $row->id).'" class="btn btn-warning btn-sm remote-modal">
                                <i class="bx bx-edit"></i>
                            </a>
                            <button title="Hapus" type="button" class="btn btn-danger btn-sm deleteConfirmation" data-target="'.route($this->route.'.destroy', [$row->id]).'">
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
