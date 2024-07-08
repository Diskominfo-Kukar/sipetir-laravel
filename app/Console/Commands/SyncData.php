<?php

namespace App\Console\Commands;

use App\Models\External\Epns\Panitia as PanitiaExternal;
use App\Models\External\Epns\Pegawai;
use App\Models\Master\Panitia;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

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
    protected $description = 'Sinkronisasi Data Sipetir';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->syncPegawaiMaster();
        $this->syncAnggotaPanitiaMaster();
    }

    public function syncAnggotaPanitiaMaster()
    {
        // $dataPanitiaExternal = PanitiaExternal::all();
        $dataPanitiaExternal = PanitiaExternal::limit(10)->get();

        $dataPanitiaExternalTotalRecords = $dataPanitiaExternal->count();
        $barPegawai                      = $this->output->createProgressBar($dataPanitiaExternalTotalRecords);

        $this->info('Memulai Sinkronisasi Data Panitia Sipetir.');
        $barPegawai->start();

        foreach ($dataPanitiaExternal as $external) {
            try {
                $existingPanitia = Panitia::where('pnt_id', (int) $external->pnt_id)->first();

                if ($existingPanitia) {
                    continue;
                }

                Panitia::updateOrCreate([
                    'pnt_id' => (int) $external->pnt_id,
                ], [
                    'nama'  => (string) $external->pnt_nama,
                    'tahun' => (string) $external->pnt_tahun,
                    'no_sk' => (string) $external->pnt_no_sk,
                ]);

                $barPegawai->advance();
            } catch (\Exception $e) {
                $this->error('Failed to sync record with pnt_id '.$external->pnt_id.': '.$e->getMessage());
            }
        }
        $barPegawai->finish();
        $this->line('');
        $this->info('Sinkronisasi Data Panitia Sipetir Berhasil.');
    }

    public function syncPegawaiMaster()
    {
        // $dataPegawaiExternal = Pegawai::all();
        $dataPegawaiExternal = Pegawai::limit(10)->get();

        $dataPegawaiExternalTotalRecords = $dataPegawaiExternal->count();
        $barPegawai                      = $this->output->createProgressBar($dataPegawaiExternalTotalRecords);

        $this->info('Memulai Sinkronisasi Data Pegawai Sipetir.');
        $barPegawai->start();

        foreach ($dataPegawaiExternal as $external) {
            try {
                $existingUser = User::where('peg_id', (int) $external->peg_id)->first();

                if ($existingUser) {
                    continue;
                }

                User::updateOrCreate([
                    'peg_id' => (int) $external->peg_id,
                ], [
                    'nip'      => (string) $external->peg_nip,
                    'name'     => (string) $external->peg_nama,
                    'username' => (string) $external->peg_namauser,
                    'password' => Hash::make((string) $external->peg_namauser),
                ]);

                $barPegawai->advance();
            } catch (\Exception $e) {
                $this->error('Failed to sync record with peg_id '.$external->peg_id.': '.$e->getMessage());
            }
        }
        $barPegawai->finish();
        $this->line('');
        $this->info('Sinkronisasi Data Pegawai Sipetir Berhasil.');
    }
}
