<?php

namespace App\Http\Controllers\Master;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as MasterController;

class Controller extends MasterController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $route;

    protected $title;
}
