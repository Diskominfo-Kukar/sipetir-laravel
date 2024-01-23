<?php

namespace App\Http\Controllers\Dashboard;

class IndexController extends Controller
{
    /**
     * Show Dashboard Index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $crumbs = [
            'Dashboard' => '',
        ];

        $data = [
            'pageTitle' => 'Dashboard',
            'subTitle'  => 'Halaman Utama Apilkasi',
            'icon'      => 'pe-7s-browser',
            'crumbs'    => $crumbs,
        ];

        return view('dashboard.dashboard', $data);
    }
}
