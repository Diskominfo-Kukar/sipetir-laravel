<?php

namespace App\Traits;

enum StatusPaket: int
{
    case Selesai        = 0;
    case Upload         = 1;
    case Verif          = 2;
    case PilihPokmil    = 3;
    case TTE1           = 4;
    case Review         = 5;
    case TTE2           = 6;
    case TTE3           = 7;
    case IsTayangKUPPBJ = 8;
}
