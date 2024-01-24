<?php

namespace App\Http\Controllers\Paket;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as PaketController;

class Controller extends PaketController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $route;

    protected $title;
}
