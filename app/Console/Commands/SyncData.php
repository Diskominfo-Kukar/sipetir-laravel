<?php

namespace App\Console\Commands;

use App\Models\External\Epns\Paket as PaketExternal;
use App\Models\External\Epns\PPK as PPKExternal;
use App\Models\Lib\SyncDataStatus;
use App\Models\Master\Pokmil as PokmilInternal;
use App\Models\Master\Ppk as PPKInternal;
use App\Models\Master\Satker as SatkerInternal;
use App\Models\Paket\Paket as PaketInternal;
use App\Models\User;
use App\Traits\StatusPaket;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SyncData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sipetir:sync';

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
        $this->info('Memulai Sinkronisasi Data Paket');

        $paketExternal = PaketExternal::query();

        $totalRecords = $paketExternal->count();
        $bar          = $this->output->createProgressBar($totalRecords);

        $this->info('Memulai Sinkronisasi Data Paket (Jumlah Data: ' . $totalRecords . ' Paket)');
        $bar->start();

        foreach ($paketExternal->get() as $external) {
            $findPokmil = PokmilInternal::where('pokmil_id', $external->pnt_id)->first();
            $findPpk = PPKInternal::where('ppk_id', $external->ppk_id)
                ->firstOr(function () use ($external) {
                    $usernamePpkInternal = User::where('username', $external->audituser)->first();
                    if ($usernamePpkInternal) {
                        return $usernamePpkInternal;
                    }

                    return $this->ppkBaru($external->ppk_id);
                });
            $findSatuanKerja = SatkerInternal::where('stk_id', $external->stk_id)->first();

            $statusPaket = null;

            $isTayangKuppbj = $external->is_tayang_kuppbj == 't' || $external->is_tayang_kuppbj == 1;

            if ($isTayangKuppbj) {
                $statusPaket = StatusPaket::Selesai->value;
            } else {
                $statusPaket = StatusPaket::Upload->value;
            }

            PaketInternal::updateOrCreate(
                [
                    'pkt_id' => $external->pkt_id,
                ],
                [
                    'pokmil_id'        => $findPokmil->id ?? null,
                    'ppk_id'           => $findPpk->id ?? null,
                    'satker_id'        => $findSatuanKerja->id ?? null,
                    'nama'             => $external->pkt_nama,
                    'pagu'             => (float) $external->pkt_pagu,
                    'status'           => (int) $statusPaket,
                    'is_tayang_kuppbj' => (int) $isTayangKuppbj,
                    'is_tayang_pokja'  => (int) $external->is_tayang_pokja,
                    'tgl_assign_ukpbj' => Carbon::parse($external->pkt_tgl_assign_ukpbj),
                    'tgl_assign_pokja' => Carbon::parse($external->pkt_tgl_assign_pokja),
                    'tgl_assign'       => Carbon::parse($external->pkt_tgl_assign),
                    'tgl_buat'         => Carbon::parse($external->pkt_tgl_buat),
                ]
            );
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

    public function ppkBaru($externalPpkId)
    {
        $externalPpk = PPKExternal::where('ppk_id', $externalPpkId)->first();

        if (is_null($externalPpk)) {
            return null;
        }

        $user = User::with('panitia')->where('pegawai_id', $externalPpk->peg_id)->first();

        if (! is_null($user)) {
            $newPpk = PPKInternal::create([
                'ppk_id'     => $externalPpk->ppk_id,
                'panitia_id' => $user->panitia->id,
            ]);

            $user->assignRole('PPK');

            return $newPpk;
        }

        return null;
    }
}
