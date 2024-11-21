<?php

namespace App\Services;

use App\Models\Master\KategoriReview;
use App\Models\Master\Pokmil;
use App\Models\Paket\BeritaAcara;
use App\Models\Paket\Paket;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class GenerateBeritaAcaraReview
{
    private $tanggal;

    public function __construct()
    {
        $this->tanggal = Carbon::now();
    }

    public function generate($request, $paketId, $isFinalGenerate = false)
    {
        $tanggal = $this->tanggal->locale('id')->translatedFormat('j F Y');
        $tglkop  = $this->tanggal->format('m/Y');

        $paket = Paket::find($paketId);

        $kategoris = KategoriReview::query()
            ->with([
                'questions.answers' => function ($query) use ($paket) {
                    $query->where('paket_id', $paket->id);
                },
                'answerCHR' => function ($query) use ($paket) {
                    $query->where('paket_id', $paket->id);
                },
            ])
            ->get();

        $pokmil  = Pokmil::find($paket->pokmil_id);
        $panitia = $pokmil->panitia;

        $beritaAcara = BeritaAcara::where('paket_id', $paketId)->first();

        if ($beritaAcara) {
            $beritaAcara->update([
                'paket_id'        => $request->paket_id,
                'kode'            => $request->kode,
                'jenis_pekerjaan' => $request->jenis_pekerjaan,
                'nama_paket'      => $request->nama_paket,
                'nama_opd'        => $request->nama_opd,
                'sumber_dana'     => $request->sumber_dana,
                'pagu'            => str_replace('.', '', $request->pagu),
                'hps'             => str_replace('.', '', $request->hps),
                'dpa'             => $request->dpa,
                'tahun'           => $request->tahun,
                'lokasi'          => $request->lokasi,
                'intro'           => $request->intro,
                'lokasi_ba'       => $request->lokasi_ba,
                'jam_mulai'       => $request->jam_mulai,
                'jam_berakhir'    => $request->jam_berakhir,
                'satker'          => $request->satker,
            ]);
        } else {
            if (! $this->isKodeDuplikat($request->kode)) {
                BeritaAcara::create([
                    'paket_id'        => $request->paket_id,
                    'kode'            => $request->kode,
                    'jenis_pekerjaan' => $request->jenis_pekerjaan,
                    'nama_paket'      => $request->nama_paket,
                    'nama_opd'        => $request->nama_opd,
                    'sumber_dana'     => $request->sumber_dana,
                    'pagu'            => str_replace('.', '', $request->pagu),
                    'hps'             => str_replace('.', '', $request->hps),
                    'dpa'             => $request->dpa,
                    'tahun'           => $request->tahun,
                    'lokasi'          => $request->lokasi,
                    'intro'           => $request->intro,
                    'lokasi_ba'       => $request->lokasi_ba,
                    'jam_mulai'       => $request->jam_mulai,
                    'jam_berakhir'    => $request->jam_berakhir,
                    'satker'          => $request->satker,
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
            'berita_acara' => $beritaAcara,
            'kategoris'    => $kategoris,
            'panitia'      => $panitia,
        ];

        $pdf = Pdf::loadView('dashboard.paket.paket.surat.surat_berita_acara', $data);

        $filePath = 'pdf/berita_acara_review_'.$paket->id.'.pdf';
        Storage::disk('public')->put($filePath, $pdf->output());

        return Storage::url($filePath);
    }

    private function isKodeDuplikat(string $kode): bool
    {
        return BeritaAcara::whereYear('created_at', Carbon::now()->year)
            ->where('kode', $kode)
            ->exists();
    }
}
