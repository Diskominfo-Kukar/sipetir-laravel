<?php

namespace App\Traits;

use App\Jobs\KirimNotifikasiJob;
use App\Lib\Wappin;
use App\Models\Notifikasi as NotifikasiModel;

class Notifikasi
{
    /**
     * Mengirimkan notifikasi ke user melalui whatsapp atau email.
     *
     * @param string $tipe Tipe notifikasi yang akan dikirimkan, harus berupa 'wa' untuk whatsapp atau 'email' untuk email
     * @param string $to Nomor whatsapp atau email yang akan dikirimi notifikasi
     * @param int $userId Id user yang akan dikirimi notifikasi
     * @param string $moduleClass Nama class dari module yang mengirimkan notifikasi
     * @param string $moduleId Id dari module yang mengirimkan notifikasi
     * @param string $targetUrl Alamat url yang akan diklik oleh user setelah menerima notifikasi
     * @param string $message Isi notifikasi yang akan dikirimkan, default adalah 'Ini adalah Notifikasi'
     * @return string Berisi pesan apakah notifikasi berhasil dikirimkan atau tidak
     */
    public static function sendTo(string $tipe, string $to, int $userId, string $moduleClass, string $moduleId, string $targetUrl, string $message = 'Ini adalah Notifikasi')
    {
        //TODO aktifkan jika task TTE & WA aman
        // dispatch(new KirimNotifikasiJob($userId, $moduleClass, $moduleId, $targetUrl, $message));

        $messageContent = $message;
        // $messageContent = $message.' &#13; Silahkan cek pada alamat ini: &#13; '.$targetUrl;

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
            if (config('app.env') == 'local') {
                $wappin->sendMessage(config('wappin.phone_test_number'), $message);
            } else {
                $wappin->sendMessage($phoneNumber, $message);
            }
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
