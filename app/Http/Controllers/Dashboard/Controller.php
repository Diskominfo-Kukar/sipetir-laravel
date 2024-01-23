<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as DashboardController;

class Controller extends DashboardController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $route;

    protected $title;
}
