<?php

namespace App\Traits;

use App\Models\Notifikasi as NotifikasiModel;

trait Notifikasi
{
    public static function sendTo($panitiaId, $moduleClass, $moduleId, $targetUrl)
    {
        $notifikasi               = new NotifikasiModel();
        $notifikasi->panitia_id   = $panitiaId;
        $notifikasi->module_id    = $moduleId;
        $notifikasi->module_class = $moduleClass;
        $notifikasi->type         = null;
        $notifikasi->message      = 'Isi message untuk content notifikasi';
        $notifikasi->target_url   = $targetUrl;
        $notifikasi->is_read      = false;
        $notifikasi->save();

        return $notifikasi;
    }

    public static function get($panitiaId)
    {
        return NotifikasiModel::where('panitia_id', $panitiaId)->get();
    }
}
