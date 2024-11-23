<?php

namespace App\Services;

use App\Models\Master\KategoriReview;
use App\Models\Master\Panitia;
use App\Models\Master\Pokmil;
use App\Models\Paket\BeritaAcara;
use App\Models\Paket\Paket;
use App\Models\Paket\TTEBeritaAcara;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;

class GenerateBeritaAcaraReview
{
    private $tanggal;

    /**
     * Initialize the service.
     *
     * Set the current date and time for the letter.
     */
    public function __construct()
    {
        $this->tanggal = Carbon::now();
    }

    /**
     * Generate a PDF of the review letter.
     *
     * @param  Paket  $paket
     * @param  Panitia  $panitia
     * @param  array  $kredensialTte
     * @return string
     */
    public function generate($paket, $panitia, $kredensialTte)
    {
        try {
            $tanggal = $this->tanggal->locale('id')->translatedFormat('j F Y');
            $tglkop  = $this->tanggal->format('m/Y');

            $kategoris = KategoriReview::query() // @phpstan-ignore-line
                ->with([
                    'questions' => function ($query) use ($paket) {
                        $query->with(['answers' => function ($query) use ($paket) {
                            $query->where('paket_id', $paket->id);
                        }]);
                    },
                    'answerCHR' => function ($query) use ($paket) {
                        $query->where('paket_id', $paket->id);
                    },
                ])
                ->get();

            $pokmil = Pokmil::find($paket->pokmil_id);

            $beritaAcara = BeritaAcara::where('paket_id', $paket->id)->first();

            TTEBeritaAcara::updateOrCreate(
                [
                    'paket_id'   => $paket->id,
                    'panitia_id' => $panitia->id,
                ],
                [
                    'nip'        => $kredensialTte['nip'],
                    'passphrase' => $kredensialTte['passphrase'],
                ]
            );

            $paket->load(['pokmil.panitia.beritaAcaraTte' => function ($query) use ($paket) {
                $query->where('paket_id', $paket->id);
            }]);

            $data = [
                'tanggal'      => $tanggal,
                'tglkop'       => $tglkop,
                'paket'        => $paket,
                'berita_acara' => $beritaAcara,
                'kategoris'    => $kategoris,
                'panitia'      => $pokmil->panitia,
            ];

            $pdf = Pdf::loadView('dashboard.paket.paket.surat.surat_berita_acara', $data);

            $filePath = 'pdf/berita_acara_review_'.$paket->id.'.pdf';
            Storage::disk('public')->put($filePath, $pdf->output());

            //return Storage::url($filePath);
            return $filePath;
        } catch (Exception $e) {
            return $e;
        }
    }
}
