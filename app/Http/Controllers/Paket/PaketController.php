<?php

namespace App\Http\Controllers\Paket;

use App\Models\Master\Answer;
use App\Models\Master\Jabatan;
use App\Models\Master\JenisDokumen;
use App\Models\Master\KategoriReview;
use App\Models\Master\Opd;
use App\Models\Master\Panitia;
use App\Models\Master\Pokmil;
use App\Models\Master\SumberDana;
use App\Models\Paket\BeritaAcara;
use App\Models\Paket\Komen;
use App\Models\Paket\Paket;
use App\Models\Paket\PaketDokumen;
use App\Models\Paket\SuratTugas;
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
    public function index(Request $request)
    {
        $title  = $this->title;
        $crumbs = [
            'Dashboard'          => route('dashboard'),
            'Paket'              => '',
            "Manajemen {$title}" => '',
        ];

        $user  = Auth::user();
        $query = Paket::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%'.$search.'%')
                    ->orWhereRaw('YEAR(tgl_buat) = ?', [$search]);
            });
        }

        if ($user->hasRole('Panitia') || $user->hasRole('PPK')) {
            if (! $user->hasRole('Kepala BPBJ')) {
                $query = Paket::where('ppk_id', Auth::user()->ppk_id)
                    ->orWhereIn('pokmil_id', Auth::user()->pokmil_id);
            }
        }

        if ($user->hasRole('Panitia') && $user->hasRole('PPK')) {
            $query->orderByRaw(
                'case
                    when status = 11 then 1
                    when status = 1 then 2
                    when status = 6 then 3
                    when status = 7 then 4
                    when status = 8 then 5
                    else 3
                end'
            )->orderBy('status', 'desc');
        } elseif ($user->hasRole('Panitia')) {
            $query->orderByRaw(
                'case
                    when status = 6 then 1
                    when status = 7 then 2
                    when status = 8 then 3
                    else 3
                end'
            )->orderBy('status', 'desc');
        } elseif ($user->hasRole('PPK')) {
            $query->orderByRaw(
                'case
                    when status = 11 then 1
                    when status = 1 then 2
                    when status = 4 then 3
                    when status = 9 then 4
                    else 3
                end'
            )->orderBy('status', 'desc');
        } elseif ($user->hasRole('Admin')) {
            $query->orderByRaw(
                'case
                    when status = 10 then 1
                    when status = 2 then 2
                    else 3
                end'
            )->orderBy('status', 'desc');
        } elseif ($user->hasRole('Kepala BPBJ')) {
            $query->orderByRaw(
                'case
                    when status = 3 then 1
                    when status = 5 then 2
                    else 3
                end'
            )->orderBy('status', 'desc');
        } else {
            $query->orderBy('status', 'desc');
        }
        $query->orderBy('tgl_buat', 'asc');

        $pakets = $query->paginate(10);

        $pakets->getCollection()->transform(function ($paket) use ($user) {
            $status      = $paket->status;
            $buttonText  = 'Detail';
            $buttonClass = 'btn-primary';

            if ($user->hasRole('Panitia')) {
                if ($status == 6 || $status == 7 || $status == 8) {
                    $buttonText  = 'Proses';
                    $buttonClass = 'btn-warning';
                }
            }

            if ($user->hasRole('PPK')) {
                if ($status == 1 || $status == 11 || $status == 4 || $status == 9) {
                    $buttonText  = 'Proses';
                    $buttonClass = 'btn-warning';
                }
            }

            if ($user->hasRole('Admin')) {
                if ($status == 2 || $status == 10) {
                    $buttonText  = 'Proses';
                    $buttonClass = 'btn-warning';
                }
            }

            if ($user->hasRole('Kepala BPBJ')) {
                if ($status == 3 || $status == 5) {
                    $buttonText  = 'Proses';
                    $buttonClass = 'btn-warning';
                }
            }

            $paket->buttonText  = $buttonText;
            $paket->buttonClass = $buttonClass;

            return $paket;
        });

        $data = [
            'pageTitle' => "Data {$title}",
            'subTitle'  => "Halaman Manajemen {$title}",
            'icon'      => 'fa fa-building',
            'route'     => $this->route,
            'crumbs'    => $crumbs,
            'pakets'    => $pakets,
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
        if (! auth()->user()->hasRole('Kepala BPBJ') && ! auth()->user()->hasRole('Admin')) {
            if (! $paket->ppk_id == auth()->user()->ppk_id && ! in_array($paket->pokmil_id, auth()->user()->pokmil_id)) {
                return abort(403);
            }
        }

        $title         = $paket->nama;
        $jenis_dokumen = JenisDokumen::orderBy('nama')->get();
        $crumbs        = [
            'Dashboard'       => route('dashboard'),
            'Paket'           => route('paket.index'),
            "Proses {$title}" => '',
        ];
        $paket_dokumen = PaketDokumen::with('jenisDokumen')->where('paket_id', $paket->id)->with('komens')->get();
        $file_dokumen  = $paket_dokumen->pluck('file', 'jenis_dokumen_id');

        $kategoriReviews = KategoriReview::orderBy('no_urut')->get();
        $kategoriReviews->load(['questions.answers.user.panitia']);

        $user       = Auth::user();
        $pokmil_ids = auth()->user()->pokmil_id;
        $panitia    = Panitia::where('user_id', $user->id)->first();

        if (! $panitia) {
            $panitia          = new Panitia();
            $panitia->jabatan = new Jabatan();
        }
        $panitia->jabatan->nama = $panitia->jabatan->nama ?? '-';

        if ($user->hasRole('Admin')) {
            $panitia->nama = $panitia->nama ?? 'Admin';
        } elseif ($user->hasRole('Superadmin')) {
            $panitia->nama = $panitia->nama ?? 'Superadmin';
        }

        $surat_tugas    = $paket->surat_tugas;
        $berita_acara_1 = $paket->berita_acara_review;
        $berita_acara_2 = $paket->berita_acara_penetapan;
        $berita_acara_3 = $paket->berita_acara_pengumuman;

        $progres = static::getProses($paket->status);
        $tanggal = static::getTanggal();
        $kode_ba = static::getKodeSurat('ba');
        $kode_sa = static::getKodeSurat('sa');

        $new_data    = SuratTugas::where('paket_id', $paket->id)->first();
        $opd         = Opd::all();
        $sumber_dana = SumberDana::all();

        $pokmil = $paket->pokmil;

        if ($pokmil) {
            $panitiaSudahAcc = $pokmil->panitia()
                ->wherePivot('panitia_id', $panitia->id)
                ->wherePivot('approve', 1)
                ->exists();
        } else {
            $panitiaSudahAcc = false;
        }

        $timelines = [
            1 => 'Upload',
            2 => 'Verifikasi Berkas',
            3 => 'Pemilihan Pokmil',
            4 => 'Surat Tugas',
            5 => 'TTE Surat Tugas',
            6 => 'Review',
            7 => 'Berita Acara',
            8 => 'TTE Berita Acara Panitia',
            9 => 'TTE Berita Acara PPK',
        ];

        if (array_key_exists($paket->status, $timelines)) {
            $status = $timelines[$paket->status];
        } elseif ($paket->status == 11) {
            $status = 'Upload Ulang';
        } else {
            $status = 'Status tidak diketahui';
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
            'timelines'        => collect($timelines),
            'panitia'          => $panitia,
            'surat_tugas'      => $surat_tugas,
            'berita_acara_1'   => $berita_acara_1,
            'berita_acara_2'   => $berita_acara_2,
            'berita_acara_3'   => $berita_acara_3,
            'progres'          => $progres,
            'status'           => $status,
            'pokmil_ids'       => $pokmil_ids,
            'new_data'         => $new_data,
            'opd'              => $opd,
            'sumber_dana'      => $sumber_dana,
            'tanggal'          => $tanggal,
            'panitiaSudahAcc'  => $panitiaSudahAcc,
            'kode_ba'          => $kode_ba,
            'kode_sa'          => $kode_sa,
        ];

        return view('dashboard.paket.'.$this->route.'.show', $data);
    }

    public static function getKodeSurat($type)
    {
        $tahun = Carbon::now()->year;
        $kode  = 1;

        if ($type === 'ba') {
            $kodeList = BeritaAcara::whereYear('created_at', $tahun)
                ->orderBy('kode', 'asc')
                ->pluck('kode')
                ->toArray();
        } elseif ($type === 'sa') {
            $kodeList = SuratTugas::whereYear('created_at', $tahun)
                ->orderBy('kode', 'asc')
                ->pluck('kode')
                ->toArray();
        }

        if (! empty($kodeList)) {
            $maxKode = max($kodeList);

            $missingKode = false;

            for ($i = 1; $i <= $maxKode; $i++) {
                if (! in_array($i, $kodeList)) {
                    $kode        = $i;
                    $missingKode = true;

                    break;
                }
            }

            if (! $missingKode) {
                $kode = $maxKode + 1;
            }
        }

        return $kode;
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
        $user  = Auth::user();
        $query = Paket::query();

        if ($request->ajax()) {
            if ($user->hasRole('Panitia') || $user->hasRole('PPK')) {
                if (! $user->hasRole('Kepala BPBJ')) {
                    $query = Paket::where('ppk_id', Auth::user()->ppk_id)
                        ->orWhereIn('pokmil_id', Auth::user()->pokmil_id);
                }
            }

            if ($user->hasRole('Panitia') && $user->hasRole('PPK')) {
                $query->orderByRaw(
                    'case
                        when status = 11 then 1
                        when status = 1 then 2
                        when status = 6 then 3
                        when status = 7 then 4
                        when status = 8 then 5
                        else 3
                    end'
                )->orderBy('status', 'desc');
            } elseif ($user->hasRole('Panitia')) {
                $query->orderByRaw(
                    'case
                        when status = 6 then 1
                        when status = 7 then 2
                        when status = 8 then 3
                        else 3
                    end'
                )->orderBy('status', 'desc');
            } elseif ($user->hasRole('PPK')) {
                $query->orderByRaw(
                    'case
                        when status = 11 then 1
                        when status = 1 then 2
                        when status = 4 then 3
                        when status = 9 then 4
                        else 3
                    end'
                )->orderBy('status', 'desc');
            } elseif ($user->hasRole('Admin')) {
                $query->orderByRaw(
                    'case
                        when status = 10 then 1
                        when status = 2 then 2
                        else 3
                    end'
                )->orderBy('status', 'desc');
            } elseif ($user->hasRole('Kepala BPBJ')) {
                $query->orderByRaw(
                    'case
                        when status = 3 then 1
                        when status = 5 then 2
                        else 3
                    end'
                )->orderBy('status', 'desc');
            } else {
                $query->orderBy('status', 'desc');
            }
            $query->orderBy('tgl_buat', 'asc');
            //$data = $query->get();
            $data = $query->limit(1000)->get();

            return DataTables::of($data)->addIndexColumn()
                ->addColumn('tgl_buat', function ($row) {
                    return Carbon::parse($row->tgl_buat)->format('Y');
                })
                ->addColumn('action', function ($row) use ($user) {
                    $status      = $row->status;
                    $buttonText  = 'Detail';
                    $buttonClass = 'btn-primary';

                    if ($user->hasRole('Panitia')) {
                        if ($status == 6 || $status == 7 || $status == 8) {
                            $buttonText  = 'Proses';
                            $buttonClass = 'btn-warning';
                        }
                    }

                    if ($user->hasRole('PPK')) {
                        if ($status == 1 || $status == 11 || $status == 4 || $status == 9) {
                            $buttonText  = 'Proses';
                            $buttonClass = 'btn-warning';
                        }
                    }

                    if ($user->hasRole('Admin')) {
                        if ($status == 2 || $status == 10) {
                            $buttonText  = 'Proses';
                            $buttonClass = 'btn-warning';
                        }
                    }

                    if ($user->hasRole('Kepala BPBJ')) {
                        if ($status == 3 || $status == 5) {
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

            if (! $paket->pokmil_id) {
                $paket->update([
                    'status' => '3',
                ]);
            } else {
                $paket->update([
                    'status' => '4',
                ]);
            }
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

        $surat_tugas = SuratTugas::where('paket_id', $request->paket_id)->first();

        if ($surat_tugas) {
            $surat_tugas->update([
                'paket_id'        => $request->paket_id,
                'kode'            => $request->kode,
                'jenis_pekerjaan' => $request->jenis_pekerjaan,
                'nama_paket'      => $request->nama_paket,
                'nama_opd'        => $request->nama_opd,
                'sumber_dana'     => $request->sumber_dana,
                'pagu'            => $request->pagu,
                'hps'             => $request->hps,
                'dpa'             => $request->dpa,
                'tahun'           => $request->tahun,
            ]);
        } else {
            $tahun         = Carbon::now()->year;
            $kode_duplikat = SuratTugas::whereYear('created_at', $tahun)
                ->where('kode', $request->kode)->first();

            if (! $kode_duplikat) {
                $surat_tugas = SuratTugas::create([
                    'paket_id'        => $request->paket_id,
                    'kode'            => $request->kode,
                    'jenis_pekerjaan' => $request->jenis_pekerjaan,
                    'nama_paket'      => $request->nama_paket,
                    'nama_opd'        => $request->nama_opd,
                    'sumber_dana'     => $request->sumber_dana,
                    'pagu'            => $request->pagu,
                    'hps'             => $request->hps,
                    'dpa'             => $request->dpa,
                    'tahun'           => $request->tahun,
                ]);
            } else {
                session()->flash('error', 'Kode surat sudah digunakan');

                return redirect()->back();
            }
        }

        $data = [
            'surat_tugas' => $surat_tugas,
            'tanggal'     => $tanggal,
            'tglkop'      => $tglkop,
            'paket'       => $paket,
            'panitia'     => $panitia,
        ];

        $pdf = Pdf::loadView('dashboard.paket.'.$this->route.'.surat.surat_tugas', $data);

        $filePath = 'pdf/surat_tugas_'.$paket->id.'.pdf';
        Storage::disk('public')->put($filePath, $pdf->output());
        $pdfUrl = url('storage/'.$filePath);

        $paket->update([
            'surat_tugas' => $filePath,
            'status'      => '5',
        ]);
        session()->flash('success', 'Surat Tugas berhasil dibuat');

        return redirect()->back()->with('surat_tugas', $pdfUrl);
    }

    public function generate_berita_acara(Request $request)
    {
        $tgl     = Carbon::now();
        $tanggal = $tgl->locale('id')->translatedFormat('j F Y');
        $tglkop  = $tgl->format('m/Y');

        $paket     = Paket::find($request->paket_id);
        $paketId   = $request->paket_id;
        $kategoris = KategoriReview::with(['questions' => function ($query) use ($paketId) { // @phpstan-ignore-line
            $query->with(['answers' => function ($query) use ($paketId) {
                $query->where('paket_id', $paketId);
            }]);
        }])->get();

        $berita_acara = BeritaAcara::where('paket_id', $request->paket_id)->first();

        if ($berita_acara) {
            $berita_acara->update([
                'paket_id'        => $request->paket_id,
                'kode'            => $request->kode,
                'jenis_pekerjaan' => $request->jenis_pekerjaan,
                'nama_paket'      => $request->nama_paket,
                'nama_opd'        => $request->nama_opd,
                'sumber_dana'     => $request->sumber_dana,
                'pagu'            => $request->pagu,
                'hps'             => $request->hps,
                'dpa'             => $request->dpa,
                'tahun'           => $request->tahun,
                'lokasi'          => $request->lokasi,
                'waktu'           => $request->waktu,
                'uraian'          => $request->uraian,
                'intro'           => $request->intro,
                'outro'           => $request->outro,
            ]);
        } else {
            $tahun         = Carbon::now()->year;
            $kode_duplikat = BeritaAcara::whereYear('created_at', $tahun)
                ->where('kode', $request->kode)->first();

            if (! $kode_duplikat) {
                $berita_acara = BeritaAcara::create([
                    'paket_id'        => $request->paket_id,
                    'kode'            => $request->kode,
                    'jenis_pekerjaan' => $request->jenis_pekerjaan,
                    'nama_paket'      => $request->nama_paket,
                    'nama_opd'        => $request->nama_opd,
                    'sumber_dana'     => $request->sumber_dana,
                    'pagu'            => $request->pagu,
                    'hps'             => $request->hps,
                    'dpa'             => $request->dpa,
                    'tahun'           => $request->tahun,
                    'lokasi'          => $request->lokasi,
                    'waktu'           => $request->waktu,
                    'uraian'          => $request->uraian,
                    'intro'           => $request->intro,
                    'outro'           => $request->outro,
                ]);
            } else {
                session()->flash('error', 'Kode surat sudah digunakan');

                return redirect()->back();
            }
        }

        $data = [
            'tanggal'      => $tanggal,
            'tglkop'       => $tglkop,
            'paket'        => $paket,
            'berita_acara' => $berita_acara,
            'kategoris'    => $kategoris,
        ];

        $pdf = Pdf::loadView('dashboard.paket.'.$this->route.'.surat.surat_berita_acara', $data);

        $filePath = 'pdf/berita_acara_review_'.$paket->id.'.pdf';
        Storage::disk('public')->put($filePath, $pdf->output());
        $pdfUrl = url('storage/'.$filePath);

        $paket->update([
            'berita_acara_review' => $filePath,
            'status'              => '8',
        ]);
        session()->flash('success', 'Berita acara berhasil dibuat');

        return redirect()->back()->with('berita_acara_1', $pdfUrl);
    }

    public function review(Request $request)
    {
        $paket = Paket::where('id', $request->paket_id)->first();
        $paket->update([
            'status' => '6',
        ]);
        session()->flash('success', 'Paket diserahkan kepada panitia untuk di review');

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
            'status' => '7',
        ]);
        session()->flash('success', 'Semua review berhasil ditambahkan');

        return redirect()->back();
    }

    public function berita_acara_TTE_panitia(Request $request)
    {
        $paket  = Paket::where('id', $request->paket_id)->first();
        $pokmil = $paket->pokmil;

        $panitiaSudahAcc = $pokmil->panitia()
            ->wherePivot('panitia_id', $request->panitia_id)
            ->wherePivot('approve', 1)
            ->exists();

        if ($panitiaSudahAcc) {
            session()->flash('success', 'Anda sudah menyetujui berita acara');

            return redirect()->back();
        } else {
            $pokmil->panitia()->updateExistingPivot($request->panitia_id, ['approve' => 1]);
        }

        $totalPanitia    = $pokmil->panitia()->count();
        $totalPanitiaAcc = $pokmil->panitia()->wherePivot('approve', true)->count();

        if ($totalPanitiaAcc >= $totalPanitia / 2) {
            $paket->update([
                'status' => '9',
            ]);
            session()->flash('success', 'Berhasil menyetujui berita acara dan paket diserahkan ke PPK');
        } else {
            session()->flash('success', 'Berhasil menyetujui berita acara');
        }

        return redirect()->back();
    }

    public function berita_acara_TTE_ppk(Request $request)
    {
        $paket = Paket::where('id', $request->paket_id)->first();

        if ($paket->is_tayang_kuppbj == 0 && $paket->is_tayang_pokja == 0) {
            $paket->update([
                'status' => '0',
            ]);
        } else {
            $paket->update([
                'status' => '10',
            ]);
        }
        session()->flash('success', 'Paket Selesai');

        return redirect()->back();
    }

    public static function getProses($status)
    {
        if ($status != 0) {
            $proses = ($status / 10) * 100;
        } else {
            $proses = 100;
        }

        return $proses;
    }

    public static function getTahun($tahun)
    {
        $angkaTerjemahan = [
            1 => 'Satu', 2 => 'Dua', 3 => 'Tiga', 4 => 'Empat', 5 => 'Lima',
            6 => 'Enam', 7 => 'Tujuh', 8 => 'Delapan', 9 => 'Sembilan',
            0 => 'Nol',
        ];

        $tahun      = strval($tahun);
        $tahunArray = str_split($tahun);

        $terjemahan = '';

        // Menambahkan "Dua Ribu" jika tahun adalah 2000-an
        if (count($tahunArray) === 4 && $tahunArray[0] == 2 && $tahunArray[1] == 0) {
            $terjemahan .= 'Dua Ribu ';
        }

        // Menambahkan angka terakhir
        $terjemahan .= $angkaTerjemahan[intval($tahunArray[2])].' Ribu '.$angkaTerjemahan[intval($tahunArray[3])];

        return $terjemahan;
    }

    public static function getTanggal()
    {
        $tgl = Carbon::now();
        $tgl->locale('id');
        $hari = $tgl->translatedFormat('l');

        $tanggalTerjemahan = [
            1  => 'Satu', 2 => 'Dua', 3 => 'Tiga', 4 => 'Empat', 5 => 'Lima',
            6  => 'Enam', 7 => 'Tujuh', 8 => 'Delapan', 9 => 'Sembilan', 10 => 'Sepuluh',
            11 => 'Sebelas', 12 => 'Dua Belas', 13 => 'Tiga Belas', 14 => 'Empat Belas', 15 => 'Lima Belas',
            16 => 'Enam Belas', 17 => 'Tujuh Belas', 18 => 'Delapan Belas', 19 => 'Sembilan Belas', 20 => 'Dua Puluh',
            21 => 'Dua Puluh Satu', 22 => 'Dua Puluh Dua', 23 => 'Dua Puluh Tiga', 24 => 'Dua Puluh Empat', 25 => 'Dua Puluh Lima',
            26 => 'Dua Puluh Enam', 27 => 'Dua Puluh Tujuh', 28 => 'Dua Puluh Delapan', 29 => 'Dua Puluh Sembilan', 30 => 'Tiga Puluh',
            31 => 'Tiga Puluh Satu',
        ];

        $tanggalAngka = $tgl->day;
        $tanggal      = $tanggalTerjemahan[$tanggalAngka];
        $bulan        = $tgl->translatedFormat('F');

        $tahunAngka = $tgl->year;
        $tahun      = static::getTahun($tahunAngka);

        $data = [
            'hari'    => $hari,
            'tanggal' => $tanggal,
            'bulan'   => $bulan,
            'tahun'   => $tahun,
        ];

        return $data;
    }

    public function upload_berita_acara_1(Request $request)
    {
        $paket = Paket::find($request->paket_id);
        $file  = $request->file('dokumen');

        if ($file) {
            if ($file->getMimeType() === 'application/pdf') {
                $filename = 'berita_acara_review_'.$paket->id.'.pdf';
                $file->storeAs('public/pdf', $filename);

                $paket->update([
                    'berita_acara_review' => 'pdf/'.$filename,
                    'status'              => '8',
                ]);

                session()->flash('success', 'Dokumen Berhasil di-upload');

                return redirect()->back();
            } else {
                session()->flash('error', 'Dokumen harus berupa file PDF.');

                return redirect()->back();
            }
        }
        session()->flash('error', 'Dokumen gagal di-upload');

        return redirect()->back();
    }

    public function upload_berita_acara_2(Request $request)
    {
        $paket = Paket::find($request->paket_id);
        $file  = $request->file('dokumen');

        if ($file) {
            if ($file->getMimeType() === 'application/pdf') {
                $filename = 'berita_acara_penetapan_'.$paket->id.'.pdf';
                $file->storeAs('public/pdf', $filename);

                $paket->update([
                    'berita_acara_penetapan' => 'pdf/'.$filename,
                ]);

                session()->flash('success', 'Dokumen Berhasil di-upload');

                return redirect()->back();
            } else {
                session()->flash('error', 'Dokumen harus berupa file PDF.');

                return redirect()->back();
            }
        }
        session()->flash('error', 'Dokumen gagal di-upload');

        return redirect()->back();
    }

    public function upload_berita_acara_3(Request $request)
    {
        $paket = Paket::find($request->paket_id);
        $file  = $request->file('dokumen');

        if ($file) {
            if ($file->getMimeType() === 'application/pdf') {
                $filename = 'berita_acara_pengumuman_'.$paket->id.'.pdf';
                $file->storeAs('public/pdf', $filename);

                $paket->update([
                    'berita_acara_pengumuman' => 'pdf/'.$filename,
                ]);

                session()->flash('success', 'Dokumen Berhasil di-upload');

                return redirect()->back();
            } else {
                session()->flash('error', 'Dokumen harus berupa file PDF.');

                return redirect()->back();
            }
        }
        session()->flash('error', 'Dokumen gagal di-upload');

        return redirect()->back();
    }
}
