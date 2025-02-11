<?php

namespace App\Console\Commands;

use App\Models\External\Epns\Paket as PaketExternal;
use App\Models\External\Epns\Panitia as PokmilExternal;
use App\Models\External\Epns\Pegawai as PegawaiExternal;
use App\Models\External\Epns\PPK as PPKExternal;
use App\Models\Lib\SyncDataStatus;
use App\Models\Master\Jabatan;
use App\Models\Master\Pokmil as PokmilInternal;
use App\Models\Master\Ppk as PPKInternal;
use App\Models\Master\Satker as SatkerInternal;
use App\Models\Paket\Paket as PaketInternal;
use App\Models\User;
use App\Traits\StatusPaket;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        // $this->syncPegawai();
        $this->syncPanitiaPokmil();
        $this->syncPaket();
    }

    public function syncPaket()
    {
        $this->info('Memulai Sinkronisasi Data Paket');

        $paketExternal = PaketExternal::query();

        $totalRecords = $paketExternal->count();
        $bar          = $this->output->createProgressBar($totalRecords);

        $this->info('Memulai Sinkronisasi Data Paket (Jumlah Data: '.$totalRecords.' Paket)');
        $bar->start();

        foreach ($paketExternal->get() as $external) {
            $findPokmil = PokmilInternal::where('pokmil_id', $external->pnt_id)->first();
            $findPpk    = PPKInternal::where('ppk_id', $external->ppk_id)->first();

            if (is_null($findPpk)) {
                $user = User::with('panitia.ppk')->where('username', $external->audituser)->first();

                if ($user && $user->panitia && $user->panitia->ppk) {
                    $findPpk = PPKInternal::where('id', $user->panitia->ppk->id)->first();
                }

                if (is_null($findPpk)) {
                    $findPpk = $this->ppkBaru($external->ppk_id);
                }
            }
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

    public function syncPegawai()
    {
        $this->info('Memulai Sinkronisasi Data Pegawai');
        $dataPegawaiExternal = PegawaiExternal::all();

        $totalRecords = $dataPegawaiExternal->count();
        $bar          = $this->output->createProgressBar($totalRecords);

        $bar->start();

        foreach ($dataPegawaiExternal as $external) {
            try {
                $currentJabatan      = Str::upper($external->peg_jabatan);
                $findJabatanOnMaster = Jabatan::where('nama', $currentJabatan)->first();

                $userCreated = User::updateOrCreate([
                    'pegawai_id' => (int) $external->peg_id,
                ], [
                    'nama'     => (string) $external->peg_nama,
                    'username' => (string) $external->peg_namauser,
                    'password' => Hash::make((string) $external->peg_namauser),
                ]);

                $userCreated->panitia()->updateOrCreate([
                    'user_id' => (string) $userCreated->id,
                ], [
                    'nip'          => (string) $external->peg_nip,
                    'nama'         => (string) $external->peg_nama,
                    'alamat'       => (string) $external->peg_alamat,
                    'golongan'     => (string) $external->peg_golongan,
                    'pangkat'      => (string) $external->peg_pangkat,
                    'jabatan_id'   => (string) $findJabatanOnMaster->id,
                    'telepon'      => (string) $external->peg_telepon,
                    'no_sk'        => (string) $external->peg_no_sk,
                    'masa_berlaku' => (string) $external->peg_masa_berlaku,
                    'nik'          => (string) $external->peg_nik,
                ]);

                $userCreated->assignRole('Panitia');

                $dataKepalaBpbj = ['KABAG BPBJ', 'KEPALA BPBJ'];
                $jabatanBpbj    = Str::upper(preg_replace('/[^a-zA-Z0-9 ]/', '', $findJabatanOnMaster->nama));

                if (in_array($jabatanBpbj, $dataKepalaBpbj)) {
                    $userCreated->assignRole('Kepala BPBJ');
                }

                $bar->advance();
            } catch (\Exception $e) {
                $this->error('Gagal sinkronisasi record '.$external->pegawai_id.': '.$e->getMessage());
            }
        }

        $bar->finish();
        $this->line('');

        SyncDataStatus::updateOrCreate([
            'model' => User::class,
        ], [
            'model'       => User::class,
            'row_synced'  => $totalRecords,
            'last_synced' => Carbon::now(),
        ]);

        $this->info('Sinkronisasi Data Pegawai Berhasil');
    }

    public function syncPanitiaPokmil()
    {
        $this->info('Memulai Sinkronisasi Data Panitia Pokmil');

        $pokmilExternal = PokmilExternal::all();
        $this->info('Jumlah data External: '.$pokmilExternal->count());

        $totalRecords = $pokmilExternal->count();
        $bar          = $this->output->createProgressBar($totalRecords);
        $bar->start();

        $successCount = 0;
        $errorCount   = 0;
        $skippedCount = 0;

        foreach ($pokmilExternal as $external) {
            try {
                $this->info("\nMemproses Pokmil ID: ".$external->pnt_id);

                $findSatker = SatkerInternal::where('stk_id', $external->stk_id)->first();

                if (is_null($findSatker)) {
                    $this->warn('Satker tidak ditemukan untuk stk_id: '.$external->stk_id);
                    $skippedCount++;
                    $bar->advance();
                }

                $isActive = $external->is_active == -1 ? 1 : 0;

                $pokmilPivot = PokmilInternal::updateOrCreate(
                    [
                        'pokmil_id' => (string) $external->pnt_id,
                    ],
                    [
                        'satker_id' => $findSatker->id ?? null,
                        'nama'      => $external->pnt_nama,
                        'tahun'     => $external->pnt_tahun,
                        'no_sk'     => $external->pnt_no_sk,
                        'alamat'    => $external->pnt_alamat,
                        'is_active' => $isActive,
                    ]
                );

                $this->info('Pokmil berhasil disimpan dengan ID: '.$pokmilPivot->id);

                $anggotaPerPokmil = [];
                $this->info('Jumlah anggota: '.count($external->anggota));

                foreach ($external->anggota as $anggota) {
                    $anggotaFind = User::where('pegawai_id', $anggota->peg_id)
                        ->with('panitia')
                        ->first();

                    if (! is_null($anggotaFind) && ! is_null($anggotaFind->panitia)) {
                        $anggotaPerPokmil[] = $anggotaFind->panitia->id;
                    } else {
                        $this->warn('Anggota tidak ditemukan untuk pegawai_id: '.$anggota->peg_id);
                    }
                }

                if (! empty($anggotaPerPokmil)) {
                    $pokmilPivot->panitia()->sync($anggotaPerPokmil);
                    $this->info('Berhasil sync '.count($anggotaPerPokmil).' anggota');
                } else {
                    $this->warn('Tidak ada anggota yang dapat di-sync');
                }

                $successCount++;
                $bar->advance();
            } catch (\Exception $e) {
                $errorCount++;
                $this->error('Gagal sinkronisasi Pokmil ID '.$external->pnt_id.': '.$e->getMessage());
                $this->error($e->getTraceAsString());
            }
        }

        $bar->finish();
        $this->line('');

        $this->info('Sinkronisasi selesai dengan:');
        $this->info('- Berhasil: '.$successCount);
        $this->info('- Gagal: '.$errorCount);
        $this->info('- Dilewati (Satker tidak ditemukan): '.$skippedCount);
        $this->info('- Total diproses: '.$totalRecords);

        SyncDataStatus::updateOrCreate(
            [
                'model' => 'PanitiaPokmil',
            ],
            [
                'model'       => 'PanitiaPokmil',
                'row_synced'  => $successCount,
                'last_synced' => Carbon::now(),
            ]
        );

        $this->info('Sinkronisasi Data Panitia Pokmil Berhasil');
    }
}
