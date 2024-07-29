<?php

namespace App\Traits;

enum StatusPaket: int
{
    case Selesai        = 0;
    case Upload         = 1;
    case Verif          = 2;
    case PilihPokmil    = 3;
    case SuratTugas     = 4;
    case TTE1           = 5;
    case Review         = 6;
    case BeritaAcara    = 7;
    case TTE2           = 8;
    case TTE3           = 9;
    case IsTayangKUPPBJ = 10;
}
