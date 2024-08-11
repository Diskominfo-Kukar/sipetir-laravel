<?php

namespace App\Jobs;

use App\Models\Notifikasi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class KirimNotifikasiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $panitiaId;

    protected $moduleClass;

    protected $moduleId;

    protected $targetUrl;

    protected $message;

    /**
     * Create a new job instance.
     */
    public function __construct($panitiaId, $moduleClass, $moduleId, $targetUrl, $message)
    {
        $this->panitiaId   = $panitiaId;
        $this->moduleClass = $moduleClass;
        $this->moduleId    = $moduleId;
        $this->targetUrl   = $targetUrl;
        $this->message     = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $notifikasi               = new Notifikasi();
        $notifikasi->panitia_id   = $this->panitiaId;
        $notifikasi->module_id    = $this->moduleId;
        $notifikasi->module_class = $this->moduleClass;
        $notifikasi->type         = null;
        $notifikasi->message      = $this->message;
        $notifikasi->target_url   = $this->targetUrl;
        $notifikasi->is_read      = false;
        $notifikasi->save();
    }
}
