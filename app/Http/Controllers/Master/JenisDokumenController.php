<?php

namespace App\Http\Controllers\Master;

use App\Http\Requests\Master\JenisDokumenRequest;
use App\Models\Master\JenisDokumen;
use App\Models\Paket\PaketDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class JenisDokumenController extends Controller
{
    public function __construct()
    {
        $this->route = 'jenis-dokumen';
        $this->title = 'Jenis Dokumen';
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
            'pageTitle' => "Data {$title}",
            'subTitle'  => "Halaman Manajemen {$title}",
            'icon'      => 'fa fa-building',
            'route'     => $this->route,
            'crumbs'    => $crumbs,
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
    public function store(JenisDokumenRequest $request)
    {
        $validate = $request->validated();
        DB::transaction(function () use ($validate) {
            JenisDokumen::create($validate);
        });

        session()->flash('success', $this->title.' Berhasil Ditambahkan');

        return redirect()->route($this->route.'.index');
    }

    public function tambahOpsional(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama dokumen harus diisi.',
            'nama.max'      => 'Nama dokumen tidak boleh lebih dari 255 karakter.',
        ]);

        $dokumenOpsionalPaket           = new JenisDokumen();
        $dokumenOpsionalPaket->nama     = $request->nama;
        $dokumenOpsionalPaket->paket_id = $request->paket_id;
        $dokumenOpsionalPaket->save();

        return back()->with('success', 'Jenis dokumen baru berhasil ditambahkan untuk paket ini.');
    }

    public function hapusOpsional($id)
    {
        $dokumenOpsionalPaket = JenisDokumen::findOrFail($id);
        $paketDokumen         = PaketDokumen::where('jenis_dokumen_id', $id)->get();

        foreach ($paketDokumen as $dokumen) {
            $dokumen->delete();
        }
        $dokumenOpsionalPaket->delete();

        return redirect()->back()->with('success', 'Jenis dokumen berhasil dihapus.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(JenisDokumen $jenis_dokuman)
    {
        $data = [
            'jenis_dokumen' => $jenis_dokuman,
        ];

        return view('dashboard.master.'.$this->route.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(JenisDokumenRequest $request, JenisDokumen $jenis_dokuman)
    {
        $validate = $request->validated();

        DB::transaction(function () use ($validate, $jenis_dokuman) {
            $jenis_dokuman->update($validate);
        });

        session()->flash('success', $this->title.'Review Berhasil Diupdate');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(JenisDokumen $jenis_dokuman)
    {
        $paketDokumen = PaketDokumen::where('jenis_dokumen_id', $jenis_dokuman->id)->get();

        foreach ($paketDokumen as $dokumen) {
            $dokumen->delete();
        }
        $delete = $jenis_dokuman->delete();

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
            $data = JenisDokumen::get();

            return DataTables::of($data)->addIndexColumn()
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
