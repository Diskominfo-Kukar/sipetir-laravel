<?php

namespace App\Console\Commands;

use App\Models\External\Epns\Paket as PaketExternal;
use App\Models\Paket\Paket;
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
    protected $description = 'Sinkronisasi Data Sipetir';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $externalData = PaketExternal::all();

        $externalDataTotalRecords = $externalData->count();
        $bar                      = $this->output->createProgressBar($externalDataTotalRecords);

        $this->info('Memulai Sinkronisasi Data Sipetir.');
        $bar->start();

        foreach ($externalData as $external) {
            try {
                Paket::updateOrCreate([
                    'pkt_id' => $external->pkt_id,
                ], [
                    'nama' => $external->pkt_nama,
                    'pagu' => (string) $external->pkt_pagu,
                ]);
                $bar->advance();
            } catch (\Exception $e) {
                $this->error('Failed to sync record with pkt_id '.$external->pkt_id.': '.$e->getMessage());
            }
        }
        $bar->finish();
        $this->line('');
        $this->info('Sinkronisasi Data Sipetir Berhasil.');
    }
}
