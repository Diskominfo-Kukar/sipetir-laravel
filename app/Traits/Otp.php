<?php

namespace App\Traits;

use App\Models\Otp as OtpModel;

trait Otp
{
    public static function sendTo($tipe, $message)
    {
        switch ($tipe) {
            case 'wa':
                return self::whatsapp($message);
            case 'email':
                return self::email($message);
            default:
                return 'Invalid tipe';
        }
    }

    public static function send($tipe, $request)
    {
        $kodeOtp = 1234;

        OtpModel::create([
            'modul_id'   => $request->modul_id,
            'panitia_id' => $request->panitia_id,
            'message'    => $request->message,
            'tipe'       => $request->tipe,
            'status'     => $request->status,
        ]);

        $otpMessage = 'Kode OTP Anda: '.$kodeOtp;

        return self::sendTo($tipe, $otpMessage);
    }

    private static function whatsapp($message)
    {
        return 'Send from whatsapp: '.$message;
    }

    private static function email($message)
    {
        return 'Send from email: '.$message;
    }
}
