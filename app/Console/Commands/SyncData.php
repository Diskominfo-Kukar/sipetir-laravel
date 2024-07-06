<?php

namespace App\Console\Commands;

use App\Models\External\Epns\Pegawai;
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
        $dataPegawaiExternal = Pegawai::all();

        $dataPegawaiExternalTotalRecords = $dataPegawaiExternal->count();
        $barPegawai                      = $this->output->createProgressBar($dataPegawaiExternalTotalRecords);

        $this->info('Memulai Sinkronisasi Data Sipetir.');
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
        $this->info('Sinkronisasi Data Sipetir Berhasil.');
    }
}
