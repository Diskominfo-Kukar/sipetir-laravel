<?php

namespace App\Http\Controllers\Paket;

use App\Models\Master\JenisDokumen;
use App\Models\Master\Pokmil;
use App\Models\Paket\Komen;
use App\Models\Paket\Paket;
use App\Models\Paket\PaketDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class PaketController extends Controller
{
    public function __construct()
    {
        $this->route = 'paket';
        $this->title = 'Paket';
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
            'Paket'              => '',
            "Manajemen {$title}" => '',
        ];

        $data = [
            'pageTitle' => "Data {$title}",
            'subTitle'  => "Halaman Manajemen {$title}",
            'icon'      => 'fa fa-building',
            'route'     => $this->route,
            'crumbs'    => $crumbs,
        ];

        return view('dashboard.paket.'.$this->route.'.index', $data);
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
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(Paket $jenis_dokuman)
    {
        $data = [
            'jenis_dokumen' => $jenis_dokuman,
        ];

        return view('dashboard.paket.'.$this->route.'.edit', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Paket $paket)
    {
        $title         = $paket->nama;
        $jenis_dokumen = JenisDokumen::orderBy('nama')->get();
        $crumbs        = [
            'Dashboard'       => route('dashboard'),
            'Paket'           => route('paket.index'),
            "Proses {$title}" => '',
        ];
        $paket_dokumen = PaketDokumen::where('paket_id', $paket->id)->with('komens')->get();
        $file_dokumen  = $paket_dokumen->pluck('file', 'jenis_dokumen_id');

        $data = [
            'pageTitle'     => "Paket {$title}",
            'subTitle'      => "Proses {$title}",
            'icon'          => 'fa fa-building',
            'route'         => $this->route,
            'crumbs'        => $crumbs,
            'paket'         => $paket,
            'jenis_dokumen' => $jenis_dokumen,
            'paket_dokumen' => $paket_dokumen,
            'file_dokumen'  => $file_dokumen,
        ];

        return view('dashboard.paket.'.$this->route.'.show', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Paket $jenis_dokuman)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Paket $jenis_dokuman)
    {
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
            $data = Paket::get();

            return DataTables::of($data)->addIndexColumn()
                ->addColumn('nama_tahun', function ($row) {
                    return ucwords($row->nama_tahun);
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                        <div class="btn-group btn-sm">
                            <a title="prosses" href="'.route($this->route.'.show', $row->id).'" action="'.route($this->route.'.update', $row->id).'" class="btn btn-warning btn-sm ">
                                <i class="bx bx-edit"></i> Proses
                            </a>

                        </div>
                    ';

                    return $actionBtn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        return abort(404);
    }

    public function uploadBerkas(Request $request)
    {
        $file      = $request->file('dokumen');
        $dokumenId = $request->dokumen_id;
        $check     = PaketDokumen::where('paket_id', $request->paket_id)
            ->where('jenis_dokumen_id', $dokumenId)
            ->first();

        if ($file && $file->isValid()) {
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/uploads', $filename);

            //Tambah berkas
            if ($check == null) {
                PaketDokumen::create([
                    'paket_id'         => $request->paket_id,
                    'jenis_dokumen_id' => $dokumenId,
                    'file'             => 'uploads/'.$filename,
                ]);
                session()->flash('success', 'Dokumen Berhasil di-upload');

                return redirect()->back();
            }
            //Edit berkas
            elseif ($check) {
                Storage::delete('public/'.$check->file);
                $check->update([
                    'file' => 'uploads/'.$filename,
                ]);
                session()->flash('success', 'Dokumen Berhasil diubah');

                return redirect()->back();
            }
        }

        session()->flash('error', 'Dokumen Gagal di-upload');

        return redirect()->back();
    }

    public function uploadAllBerkas(Request $request)
    {
        $paket = Paket::where('id', $request->paket_id)->first();
        $paket->update([
            'status' => '2',
        ]);
        session()->flash('success', 'Dokumen Berhasil dikirim');

        return redirect()->back();
    }

    public function VerifBerkas(Request $request)
    {
        $action = $request->input('action');

        if ($action == 'decline') {
            $paketId       = $request->input('paket_id');
            $paket_dokumen = PaketDokumen::where('paket_id', $paketId)->get();
            $catatan       = [];

            foreach ($paket_dokumen as $dokumen) {
                $catatan[$dokumen->id] = $request->input('catatan_'.$dokumen->jenis_dokumen_id);

                if ($catatan[$dokumen->id] !== null) {
                    $komen = Komen::create([
                        'isi'    => $catatan[$dokumen->id],
                        'active' => '1',
                    ]);
                    $dokumen->komens()->attach($komen->id);
                }
            }

            $paket = Paket::where('id', $request->paket_id)->first();
            $paket->update([
                'status' => '11',
            ]);
            session()->flash('success', 'Dokumen Berhasil dikembalikan');

            return redirect()->back();
        } elseif ($action == 'accept') {
            $paket = Paket::where('id', $request->paket_id)->first();
            $paket->update([
                'status' => '3',
            ]);
            session()->flash('success', 'Dokumen Berhasil diverifikasi');

            return redirect()->back();
        }

        return redirect()->back();
    }

    public function roll()
    {
        $id = Pokmil::pluck('id');

        return response()->json($id);
    }

    public function TTE_SuratTugas(Request $request)
    {
        $paket = Paket::where('id', $request->paket_id)->first();
        $paket->update([
            'status' => '4',
        ]);
        session()->flash('success', 'Pokmil berhasil dipilih untuk paket ini');

        return redirect()->back();
    }
}
