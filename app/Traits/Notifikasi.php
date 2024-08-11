<?php

namespace App\Traits;

use App\Jobs\KirimNotifikasiJob;
use App\Models\Notifikasi as NotifikasiModel;

trait Notifikasi
{
    public static function sendTo($userId, $moduleClass, $moduleId, $targetUrl, $message = 'Ini adalah Notifikasi')
    {
        dispatch(new KirimNotifikasiJob($userId, $moduleClass, $moduleId, $targetUrl, $message));

        return true;
    }

    public static function get($userId)
    {
        return NotifikasiModel::where('panitia_id', $userId)->get();
    }
}
