<?php

namespace App\Console\Commands;

use App\Models\External\Epns\Paket as PaketExternal;
use App\Models\Lib\SyncDataStatus;
use App\Models\Master\Pokmil as PokmilInternal;
use App\Models\Master\Ppk as PPKInternal;
use App\Models\Master\Satker as SatkerInternal;
use App\Models\Paket\Paket as PaketInternal;
use App\Traits\StatusPaket;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:paket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi Data Paket Sipetir';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->syncPaket();
    }

    public function syncPaket()
    {
        $dataPaketTerakhir = SyncDataStatus::whereModel(PaketInternal::class)->first();

        $paketBaru = PaketExternal::where(DB::raw("to_char(pkt_tgl_buat, 'YYYY-MM-DD HH24:MI:SS')"), '>', $dataPaketTerakhir->last_synced)->orderBy('pkt_tgl_buat');

        if (! $paketBaru->exists()) {
            $this->info('Tidak ada data paket baru yang perlu disikronisasi');

            return;
        }

        $this->info('Memulai Sinkronisasi Data Paket');

        $totalRecords = $paketBaru->count();
        $bar          = $this->output->createProgressBar($totalRecords);

        $this->info('Memulai Sinkronisasi Data Paket (Jumlah Data: '.$totalRecords.' Paket)');
        $bar->start();

        foreach ($paketBaru->get() as $external) {
            $findPokmil      = PokmilInternal::where('pokmil_id', $external->pnt_id)->first();
            $findPpk         = PPKInternal::where('ppk_id', $external->ppk_id)->first();
            $findSatuanKerja = SatkerInternal::where('stk_id', $external->stk_id)->first();

            $statusPaket = null;

            if ($external->is_tayang_kuppbj) {
                $statusPaket = StatusPaket::Selesai->value;
            } else {
                $statusPaket = StatusPaket::Upload->value;
            }

            PaketInternal::create([
                'pokmil_id'        => $findPokmil->id ?? null,
                'ppk_id'           => $findPpk->id ?? null,
                'satker_id'        => $findSatuanKerja->id ?? null,
                'nama'             => $external->pkt_nama,
                'pagu'             => (float) $external->pkt_pagu,
                'status'           => (int) $statusPaket,
                'is_tayang_kuppbj' => (bool) $external->is_tayang_kuppbj,
                'is_tayang_pokja'  => (bool) $external->is_tayang_pokja,
                'tgl_assign_ukpbj' => Carbon::parse($external->pkt_tgl_assign_ukpbj),
                'tgl_assign_pokja' => Carbon::parse($external->pkt_tgl_assign_pokja),
                'tgl_assign'       => Carbon::parse($external->pkt_tgl_assign),
                'tgl_buat'         => Carbon::parse($external->pkt_tgl_buat),
            ]);
            $bar->advance();
        }

        $bar->finish();
        $this->line('');

        SyncDataStatus::updateOrCreate([
            'model' => PaketInternal::class,
        ], [
            'model'       => PaketInternal::class,
            'row_synced'  => $totalRecords,
            'last_synced' => Carbon::now(),
        ]);

        $this->info('Sinkronisasi Data Paket Berhasil');
    }
}
