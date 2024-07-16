<?php

namespace App\Http\Controllers\Paket;

use App\Models\Master\Answer;
use App\Models\Master\JenisDokumen;
use App\Models\Master\KategoriReview;
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
        $paket_dokumen = PaketDokumen::with('jenisDokumen')->where('paket_id', $paket->id)->with('komens')->get();
        $file_dokumen  = $paket_dokumen->pluck('file', 'jenis_dokumen_id');

        // Dump
        // dump($paket_dokumen, $jenis_dokumen);

        $kategoriReviews = KategoriReview::orderBy('no_urut')->get();
        $kategoriReviews->load(['questions.answers.user.panitia']);

        $user    = Auth::user();
        $panitia = Panitia::where('user_id', $user->id)->first();

        if ($user->username == 'Superadmin') {
            $panitia_nama     = 'Superadmin';
            $panitia          = new Panitia();
            $panitia->jabatan = '-';
        } else {
            $panitia_nama = $panitia ? $panitia->nama : 'Tidak diketahui';
        }

        $surat_tugas    = $paket->surat_tugas;
        $berita_acara_1 = $paket->berita_acara_review;

        $log = static::getProses($paket->status);

        $timelines = [
            1 => 'Upload',
            2 => 'Verifikasi Berkas',
            3 => 'Pemilihan Pokmil',
            4 => 'TTE Surat Tugas',
            5 => 'Review',
            6 => 'TTE Berita Acara Panitia',
            7 => 'TTE Berita Acara PPK',
        ];

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
            'timelines'        => collect($timelines),
            'panitia'          => $panitia_nama,
            'panitia_data'     => $panitia,
            'surat_tugas'      => $surat_tugas,
            'berita_acara_1'   => $berita_acara_1,
            'log'              => $log,
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
        $user = Auth::user();

        if ($request->ajax()) {
            $query = Paket::query();

            if ($user->role->first()->name == 'Panitia') {
                $query->orderByRaw(
                    'case
                        when status = 5 then 1
                        when status = 6 then 2
                        else 3
                    end'
                )->orderBy('status', 'desc');
            } elseif ($user->role->first()->name == 'ppk') {
                $query->orderByRaw(
                    'case
                        when status = 1 then 1
                        when status = 7 then 2
                        else 3
                    end'
                )->orderBy('status', 'desc');
            } elseif ($user->role->first()->name == 'Admin') {
                $query->orderByRaw(
                    'case
                        when status = 2 then 1
                        else 2
                    end'
                )->orderBy('status', 'desc');
            } elseif ($user->role->first()->name == 'Kepala BPBJ') {
                $query->orderByRaw(
                    'case
                        when status = 3 then 1
                        when status = 4 then 2
                        else 3
                    end'
                )->orderBy('status', 'desc');
            } else {
                $query->orderBy('status', 'desc');
            }
            $query->orderBy('created_at', 'desc');
            $data = $query->get();

            return DataTables::of($data)->addIndexColumn()
                ->addColumn('nama_tahun', function ($row) {
                    return ucwords($row->nama_tahun);
                })
                ->addColumn('action', function ($row) use ($user) {
                    $status      = $row->status;
                    $buttonText  = 'Detail';
                    $buttonClass = 'btn-primary';

                    if ($user->role->first()->name == 'Panitia') {
                        if ($status == 5 || $status == 6) {
                            $buttonText  = 'Proses';
                            $buttonClass = 'btn-warning';
                        }
                    } elseif ($user->role->first()->name == 'ppk') {
                        if ($status == 1 || $status == 7) {
                            $buttonText  = 'Proses';
                            $buttonClass = 'btn-warning';
                        }
                    } elseif ($user->role->first()->name == 'Admin') {
                        if ($status == 2) {
                            $buttonText  = 'Proses';
                            $buttonClass = 'btn-warning';
                        }
                    } elseif ($user->role->first()->name == 'Kepala BPBJ') {
                        if ($status == 3 || $status == 4) {
                            $buttonText  = 'Proses';
                            $buttonClass = 'btn-warning';
                        }
                    }

                    $actionBtn = '
                        <div class="btn-group btn-sm">
                            <a title="'.($buttonText).'" href="'.route($this->route.'.show', $row->id).'" class="btn '.$buttonClass.' btn-sm">
                                <i class="bx bx-'.($buttonText == 'Proses' ? 'edit' : 'info-circle').'"></i> '.$buttonText.'
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
        $id = Pokmil::pluck('pokmil_id');

        return response()->json($id);
    }

    public function progres_surat_tugas(Request $request)
    {
        $paket       = Paket::where('id', $request->paket_id)->first();
        $pokmil      = Pokmil::where('pokmil_id', $request->pokmil_number)->first();
        $uuid_pokmil = $pokmil->id;
        $paket->update([
            'pokmil_id' => $uuid_pokmil,
            'status'    => '4',
        ]);
        session()->flash('success', 'Pokmil berhasil dipilih untuk paket ini');

        return redirect()->back();
    }

    public function generate_surat_tugas(Request $request)
    {
        $tgl     = Carbon::now();
        $tanggal = $tgl->locale('id')->translatedFormat('j F Y');
        $tglkop  = $tgl->format('m/Y');

        $paket   = Paket::find($request->paket_id);
        $pokmil  = Pokmil::find($paket->pokmil_id);
        $panitia = $pokmil->panitia;

        $data = [
            'tanggal' => $tanggal,
            'tglkop'  => $tglkop,
            'paket'   => $paket,
            'panitia' => $panitia,
        ];

        $pdf = Pdf::loadView('dashboard.paket.'.$this->route.'.surat.surat_tugas', $data);

        $filePath = 'pdf/surat_tugas_'.$paket->id.'.pdf';
        Storage::disk('public')->put($filePath, $pdf->output());
        $pdfUrl = url('storage/'.$filePath);

        $paket->update([
            'surat_tugas' => $filePath,
        ]);

        return redirect()->back()->with('surat_tugas', $pdfUrl);
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
        $answer = Answer::where('paket_id', $request->paket_id)
            ->where('question_id', $request->question_id)
            ->first();

        if ($request->review !== null) {
            if ($answer) {
                $answer->update([
                    'user_id'     => Auth::id(),
                    'paket_id'    => $request->paket_id,
                    'question_id' => $request->question_id,
                    'review'      => $request->review,
                ]);
            } else {
                Answer::create([
                    'user_id'     => Auth::id(),
                    'paket_id'    => $request->paket_id,
                    'question_id' => $request->question_id,
                    'review'      => $request->review,
                ]);
            }

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

    public function generate_berita_acara(Request $request)
    {
        $tgl     = Carbon::now();
        $tanggal = $tgl->locale('id')->translatedFormat('j F Y');
        $tglkop  = $tgl->format('m/Y');

        $paket = Paket::find($request->paket_id);

        $data = [
            'tanggal' => $tanggal,
            'tglkop'  => $tglkop,
            'paket'   => $paket,
        ];

        $pdf = Pdf::loadView('dashboard.paket.'.$this->route.'.surat.surat_berita_acara', $data);

        $filePath = 'pdf/berita_acara_review_'.$paket->id.'.pdf';
        Storage::disk('public')->put($filePath, $pdf->output());
        $pdfUrl = url('storage/'.$filePath);

        $paket->update([
            'berita_acara_review' => $filePath,
        ]);

        return redirect()->back()->with('berita_acara_1', $pdfUrl);
    }

    public function berita_acara_TTE_panitia(Request $request)
    {
        $paket = Paket::where('id', $request->paket_id)->first();
        $paket->update([
            'status' => '7',
        ]);
        session()->flash('success', 'Paket diserahkan ke PPK');

        return redirect()->back();
    }

    public function berita_acara_TTE_ppk(Request $request)
    {
        $paket = Paket::where('id', $request->paket_id)->first();
        $paket->update([
            'status' => '0',
        ]);
        session()->flash('success', 'Paket Selesai');

        return redirect()->back();
    }

    public static function getProses($status)
    {
        if ($status != 0) {
            $proses = ($status / 8) * 100;
        } else {
            $proses = 100;
        }

        return $proses;
    }
}
