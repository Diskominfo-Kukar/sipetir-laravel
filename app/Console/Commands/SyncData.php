<?php

namespace App\Console\Commands;

use App\Models\External\Epns\Instansi as InstansiExternal;
use App\Models\External\Epns\Paket as PaketExternal;
use App\Models\External\Epns\Panitia as PokmilExternal;
use App\Models\External\Epns\Pegawai as PegawaiExternal;
use App\Models\External\Epns\PPK as PPKExternal;
use App\Models\External\Epns\Satker as SatkerExternal;
use App\Models\Master\Jabatan;
use App\Models\Master\JenisOpd as JenisOpdInternal;
use App\Models\Master\Opd as OpdInternal;
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
    protected $signature = 'sipetir:import';

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
        $this->syncJabatanMaster();
        $this->syncPegawaiMaster();
        $this->syncSatker();
        $this->syncPokmil();
        $this->syncPanitiaPokmil();
        $this->syncPpk();
        $this->syncPaket();
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

    public function syncJabatanMaster()
    {
        $jabatanOnPegawai = PegawaiExternal::select('peg_jabatan')->distinct()->pluck('peg_jabatan');

        foreach ($jabatanOnPegawai as $jabatan) {
            Jabatan::firstOrCreate([
                'nama' => Str::upper($jabatan),
            ]);
        }
    }

    public function syncPegawaiMaster()
    {
        $dataPegawaiExternal = PegawaiExternal::all();

        $dataPegawaiExternalTotalRecords = $dataPegawaiExternal->count();
        $barPegawai                      = $this->output->createProgressBar($dataPegawaiExternalTotalRecords);

        $this->info('Memulai Sinkronisasi Data Pegawai Sipetir.');
        $barPegawai->start();

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

    public function syncPpk()
    {
        $ppkExternal = PPKExternal::all();

        foreach ($ppkExternal as $external) {
            $user = User::with('panitia')->where('pegawai_id', $external->peg_id)->first();

            if (! is_null($user)) {
                PPKInternal::create([
                    'ppk_id'     => $external->ppk_id,
                    'panitia_id' => $user->panitia->id,
                ]);

                $user->assignRole('PPK');
            }
        }
    }

    public function syncPaket()
    {
        $paketExternal = PaketExternal::all();

        foreach ($paketExternal as $external) {
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
        }
    }
}
