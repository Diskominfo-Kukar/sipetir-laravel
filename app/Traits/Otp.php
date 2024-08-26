<?php

namespace App\Traits;

use App\Lib\Wappin;
use App\Models\Otp as OtpModel;

trait Otp
{
    public static function sendTo($type, $to, $moduleId, $moduleClass, $panitiaId)
    {
        $kodeOtp = self::generateOtp();

        OtpModel::create([
            'module_id'    => $moduleId,
            'module_class' => $moduleClass,
            'panitia_id'   => $panitiaId,
            'type'         => $type,
            'to'           => $to,
            'code'         => $kodeOtp,
            'status'       => 2, //Terkirim
        ]);

        $otpMessage = 'Kode OTP Anda: '.$kodeOtp;

        switch ($type) {
            case 'wa':
                return self::whatsApp($to, $otpMessage);
            case 'email':
                return self::email($to, $otpMessage);
            default:
                return 'Invalid type';
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

    private static function generateOtp($length = 6)
    {
        $otp = '';

        for ($i = 0; $i < $length; $i++) {
            $otp .= random_int(0, 9);
        }

        return $otp;
    }
}
