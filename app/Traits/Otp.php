<?php

namespace App\Traits;

use App\Lib\Wappin;
use App\Models\Otp as OtpModel;

trait Otp
{
    public static function sendTo($tipe, $to, $request = null)
    {
        $kodeOtp = self::generateOtp();

        // OtpModel::create([
        //     'module_id'    => $request->module_id,
        //     'module_class' => $request->module_class,
        //     'panitia_id'   => $request->panitia_id,
        //     'message'      => $kodeOtp,
        //     'tipe'         => $request->tipe,
        //     'status'       => $request->status,
        // ]);

        $otpMessage = 'Kode OTP Anda: '.$kodeOtp;

        switch ($tipe) {
            case 'wa':
                return self::whatsApp($to, $otpMessage);
            case 'email':
                return self::email($to, $otpMessage);
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

    private static function generateOtp($length = 6)
    {
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= random_int(0, 9);
        }

        return $otp;
    }
}
