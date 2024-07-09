<?php

namespace App\Console\Commands;

use App\Models\External\Epns\Instansi as InstansiExternal;
use App\Models\External\Epns\Panitia as PanitiaExternal;
use App\Models\External\Epns\Pegawai;
use App\Models\Master\JenisOpd;
use App\Models\Master\Opd;
use App\Models\Master\Panitia;
use App\Models\User;
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
    protected $description = 'Sinkronisasi Data Sipetir';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->syncOpd();
        $this->syncPegawaiMaster();
        // $this->syncAnggotaPanitiaMaster();
    }

    public function syncOpd()
    {
        $jenisOpdExternal = InstansiExternal::select('jenis')->distinct()->pluck('jenis');

        foreach ($jenisOpdExternal as $jenisOpd) {
            JenisOpd::create([
                'nama' => Str::upper($jenisOpd),
            ]);
        }

        $opdExternal = InstansiExternal::select('id', 'nama', 'alamat', 'jenis')->get();

        foreach ($opdExternal as $opd) {
            $jenisOpd = JenisOpd::select('id')->where('nama', $opd->jenis)->pluck('id')->first();

            Opd::create([
                'kode'         => $opd->id,
                'nama'         => Str::title($opd->nama),
                'alamat'       => $opd->alamat,
                'jenis_opd_id' => $jenisOpd,
            ]);
        }
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
                    'jabatan'      => (string) $external->peg_jabatan,
                    'telepon'      => (string) $external->peg_telepon,
                    'no_sk'        => (string) $external->peg_no_sk,
                    'masa_berlaku' => (string) $external->peg_masa_berlaku,
                    'nik'          => (string) $external->nik,
                ]);

                $barPegawai->advance();
            } catch (\Exception $e) {
                $this->error('Failed to sync record '.$external->pegawai_id.': '.$e->getMessage());
            }
        }
        $barPegawai->finish();
        $this->line('');
        $this->info('Sinkronisasi Data Pegawai Sipetir Berhasil.');
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
}
