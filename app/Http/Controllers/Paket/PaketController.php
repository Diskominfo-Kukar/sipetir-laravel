<?php

namespace App\Http\Controllers\Paket;

use App\Models\Master\Answer;
use App\Models\Master\JenisDokumen;
use App\Models\Master\KategoriReview;
use App\Models\Master\Opd;
use App\Models\Master\Panitia;
use App\Models\Master\Pokmil;
use App\Models\Paket\Komen;
use App\Models\Paket\Paket;
use App\Models\Paket\PaketDokumen;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $kategoriReviews = KategoriReview::orderBy('no_urut')->get();
        $kategoriReviews->load(['questions.answers.user.panitia']);

        $user = Auth::user();

        if ($user->username == 'Superadmin') {
            $panitia_nama = 'Superadmin';
        } else {
            $panitia      = Panitia::where('user_id', $user->id)->first();
            $panitia_nama = $panitia ? $panitia->nama : 'Tidak diketahui';
        }

        $data = [
            'pageTitle'        => "Paket {$title}",
            'subTitle'         => "Proses {$title}",
            'icon'             => 'fa fa-building',
            'route'            => $this->route,
            'crumbs'           => $crumbs,
            'paket'            => $paket,
            'jenis_dokumen'    => $jenis_dokumen,
            'paket_dokumen'    => $paket_dokumen,
            'file_dokumen'     => $file_dokumen,
            'kategori_reviews' => $kategoriReviews,
            'panitia'          => $panitia_nama,
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
        session()->flash('success', 'Semua Dokumen Berhasil dikirim');

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

    public function progres_surat_tugas(Request $request)
    {
        $paket = Paket::where('id', $request->paket_id)->first();
        $paket->update([
            'ppk_id' => $request->pokmil_number,
            'status' => '4',
        ]);
        session()->flash('success', 'Pokmil berhasil dipilih untuk paket ini');

        return redirect()->back();
    }

    public function generate_surat_tugas(Request $request)
    {
        $tgl     = Carbon::now();
        $tanggal = $tgl->locale('id')->translatedFormat('j F Y');
        $tglkop  = $tgl->format('m/Y');

        $paket = Paket::where('id', $request->paket_id)->first();
        $opd   = Opd::where('id', $paket->opd_id)->first();

        $data = [
            'tanggal' => $tanggal,
            'tglkop'  => $tglkop,
            'paket'   => $paket,
            'opd'     => $opd,
        ];

        $pdf = Pdf::loadView('dashboard.paket.'.$this->route.'.surat.surat_tugas', $data);

        return $pdf->stream('surat_tugas.pdf');
    }

    public function review(Request $request)
    {
        $paket = Paket::where('id', $request->paket_id)->first();
        $paket->update([
            'status' => '5',
        ]);
        //session()->flash('success', '');

        return redirect()->back();
    }

    public function answer_question(Request $request)
    {
        if ($request->review !== null) {
            Answer::create([
                'user_id'     => Auth::id(),
                'paket_id'    => $request->paket_id,
                'question_id' => $request->question_id,
                'review'      => $request->review,
            ]);
            session()->flash('success', 'Sukses menambahkan jawaban');
        } else {
            //session()->flash('success', 'Gagal menambahkan jawaban');
        }

        return redirect()->back();
    }

    public function progres_berita_acara(Request $request)
    {
        $paket = Paket::where('id', $request->paket_id)->first();
        $paket->update([
            'status' => '6',
        ]);
        session()->flash('success', 'Semua review berhasil ditambahkan');

        return redirect()->back();
    }

    public function berita_acara_PPK(Request $request)
    {
        $paket = Paket::where('id', $request->paket_id)->first();
        $paket->update([
            'status' => '7',
        ]);
        session()->flash('success', 'Berhasil di kirim ke PPK');

        return redirect()->back();
    }
}
