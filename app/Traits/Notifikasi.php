<?php

namespace App\Traits;

use App\Jobs\KirimNotifikasiJob;
use App\Lib\Wappin;
use App\Models\Notifikasi as NotifikasiModel;

class Notifikasi
{
    public static function sendTo(string $tipe, string $to, int $userId, string $moduleClass, int $moduleId, string $targetUrl, string $message = 'Ini adalah Notifikasi')
    {
        dispatch(new KirimNotifikasiJob($userId, $moduleClass, $moduleId, $targetUrl, $message));

        $messageContent = $message.' &#13; Silahkan cek pada alamat ini: &#13; '.$targetUrl;

        switch ($tipe) {
            case 'wa':
                return self::whatsApp($to, $messageContent);
            case 'email':
                return self::email($to, $messageContent);
            default:
                return 'Invalid tipe';
        }
    }

    private static function whatsApp($phoneNumber, $message)
    {
        dispatch(function () use ($phoneNumber, $message) {
            $wappin = new Wappin();
            $wappin->sendMessage($phoneNumber, $message);
        });

        return true;
    }

    private static function email($emailAddress, $message)
    {
        return 'Send to '.$emailAddress.' from email: '.$message;
    }

    public static function get($userId)
    {
        return NotifikasiModel::where('panitia_id', $userId)->get();
    }
}
