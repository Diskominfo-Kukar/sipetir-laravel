<?php

namespace App\Traits;

trait Otp
{
    public static function sendTo($tipe, $message)
    {
        switch ($tipe) {
            case 'wa':
                return self::whatsapp($message);
                break;
            case 'email':
                return self::email($message);
                break;
            default:
                return self::whatsapp($message);
                break;
        }

        return 'Invalid tipe';
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
