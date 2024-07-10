<?php

namespace App\Console\Commands;

use App\Models\External\Epns\Instansi as InstansiExternal;
use App\Models\External\Epns\Panitia as PokmilExternal;
use App\Models\External\Epns\Pegawai as PegawaiExternal;
use App\Models\External\Epns\Satker as SatkerExternal;
use App\Models\Master\JenisOpd as JenisOpdInternal;
use App\Models\Master\Opd as OpdInternal;
use App\Models\Master\Pokmil as PokmilInternal;
use App\Models\Master\Satker as SatkerInternal;
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
        $this->syncSatker();
        $this->syncPokmil();
        $this->syncPanitiaPokmil();
    }

    public function syncOpd()
    {
        $jenisOpdExternal = InstansiExternal::select('jenis')->distinct()->pluck('jenis');

        foreach ($jenisOpdExternal as $jenisOpd) {
            JenisOpdInternal::create([
                'nama' => Str::upper($jenisOpd),
            ]);
        }

        $opdExternal = InstansiExternal::select('id', 'nama', 'alamat', 'jenis')->get();

        foreach ($opdExternal as $opd) {
            $jenisOpd = JenisOpdInternal::select('id')->where('nama', $opd->jenis)->pluck('id')->first();

            OpdInternal::create([
                'kode'         => $opd->id,
                'nama'         => Str::title($opd->nama),
                'alamat'       => $opd->alamat,
                'jenis_opd_id' => $jenisOpd,
            ]);
        }
    }

    public function syncPegawaiMaster()
    {
        $dataPegawaiExternal = PegawaiExternal::all();
        // $dataPegawaiExternal = PegawaiExternal::limit(100)->get();

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

    public function syncSatker()
    {
        $dataSatkerExternal = SatkerExternal::all();

        foreach ($dataSatkerExternal as $satker) {
            $opd = OpdInternal::whereKode($satker->instansi_id)->first();
            if (! is_null($opd)) {
                SatkerInternal::updateOrCreate([
                    'stk_id' => $satker->stk_id,
                ], [
                    'nama'    => (string) Str::title($satker->stk_nama),
                    'opd_id'  => $opd->id,
                    'alamat'  => $satker->stk_alamat,
                    'telepon' => $satker->stk_telepon,
                ]);
            }
        }
    }

    public function syncPokmil()
    {
        $dataPokmilExternal = PokmilExternal::all();

        foreach ($dataPokmilExternal as $panitia) {
            $satker = SatkerInternal::where('stk_id', $panitia->stk_id)->first();
            if (! is_null($satker)) {
                PokmilInternal::updateOrCreate([
                    'pokmil_id' => $panitia->pnt_id,
                ], [
                    'satker_id' => $satker->id,
                    'nama'      => $panitia->pnt_nama,
                    'tahun'     => $panitia->pnt_tahun,
                    'no_sk'     => $panitia->pnt_no_sk,
                    'alamat'    => $panitia->pnt_alamat,
                ]);
            }
        }
    }

    public function syncPanitiaPokmil()
    {
        $pokmilExternal = PokmilExternal::with('anggota')->get();
        $pokmilInternal = PokmilInternal::all();

        $pokmilInternalMap = $pokmilInternal->keyBy('pokmil_id');
        foreach ($pokmilExternal as $external) {
            if ($pokmilInternalMap->has($external->pnt_id)) {
                $pokmilPivot      = $pokmilInternalMap->get($external->pnt_id);
                $anggotaPerPokmil = null;
                foreach ($external->anggota as $anggota) {
                    $anggotaFind = User::where('pegawai_id', $anggota->peg_id)->with('panitia')->first();
                    if (! is_null($anggotaFind)) {
                        $anggotaPerPokmil[] = $anggotaFind->panitia->id;
                    }
                }
                if (! is_null($anggotaPerPokmil)) {
                    $pokmilPivot->panitia()->sync($anggotaPerPokmil);
                }
            }
        }
    }
}
