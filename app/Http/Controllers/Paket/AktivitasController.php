<?php

namespace App\Http\Controllers\Paket;

use App\Http\Controllers\Controller;
use App\Models\Master\Jabatan;
use App\Models\Master\Panitia;
use App\Models\Paket\BeritaAcara;
use App\Models\Paket\Paket;
use App\Models\Paket\PaketDokumen;
use App\Models\Paket\SuratTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AktivitasController extends Controller
{
    public function __construct()
    {
        $this->route = 'paket';
        $this->title = 'Paket';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Paket $paket)
    {
        $title = $paket->nama;

        $crumbs = [
            'Dashboard'       => route('dashboard'),
            'Paket'           => route('paket.index'),
            "Proses {$title}" => route('paket.show', ['paket' => $paket]),
            'Aktivitas'       => '',
        ];

        $paket_dokumen = PaketDokumen::with('jenisDokumen')->where('paket_id', $paket->id)->with('komens')->get();
        $file_dokumen  = $paket_dokumen->pluck('file', 'jenis_dokumen_id');

        $user    = Auth::user();
        $panitia = Panitia::where('user_id', $user->id)->first();

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

        $new_data  = SuratTugas::where('paket_id', $paket->id)->first();
        $new_data2 = BeritaAcara::where('paket_id', $paket->id)->first();
        $data      = $new_data2 ?? $new_data ?? $paket;

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

        $paket          = Paket::findOrFail($paket->id);
        $paketHistories = $paket->paketHistories()->paginate(10);

        $data = [
            'pageTitle'      => "Paket {$title}",
            'subTitle'       => "Proses {$title}",
            'icon'           => 'fa fa-building',
            'route'          => $this->route,
            'crumbs'         => $crumbs,
            'paket'          => $paket,
            'paket_dokumen'  => $paket_dokumen,
            'file_dokumen'   => $file_dokumen,
            'timelines'      => collect($timelines),
            'surat_tugas'    => $surat_tugas,
            'berita_acara_1' => $berita_acara_1,
            'berita_acara_2' => $berita_acara_2,
            'berita_acara_3' => $berita_acara_3,
            'progres'        => $progres,
            'new_data'       => $new_data,
            'new_data2'      => $new_data2,
            'paketHistories' => $paketHistories,
            'data'           => $data,
        ];

        return view('dashboard.paket.'.$this->route.'.aktivitas', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
}
