<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Paket\Paket;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

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

        $paketStatus = [
            'paketTotal'    => Paket::count(),
            'paketProgress' => Paket::where('status', '>', 0)->count(),
            'paketSelesai'  => Paket::where('status', 0)->count(),
            'paketTayang'   => Paket::where('is_tayang_kuppbj', 1)->orWhere('is_tayang_pokja')->count(),
        ];

        $paketStatusPerBulan = DB::table('paket')
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(CASE WHEN status > 0 THEN 1 ELSE 0 END) as paketProgress'),
                DB::raw('SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as paketSelesai'),
                DB::raw('SUM(CASE WHEN is_tayang_kuppbj = 1 OR is_tayang_pokja = 1 THEN 1 ELSE 0 END) as paketTayang'),
                DB::raw('COUNT(*) as paketTotal')
            )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        $months        = [];
        $paketTotal    = [];
        $paketProgress = [];
        $paketSelesai  = [];
        $paketTayang   = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[]        = DateTime::createFromFormat('!m', (string) $i)->format('F');
            $paketTotal[]    = 0;
            $paketProgress[] = 0;
            $paketSelesai[]  = 0;
            $paketTayang[]   = 0;
        }

        foreach ($paketStatusPerBulan as $data) {
            $index                 = $data->month - 1;
            $paketTotal[$index]    = $data->paketTotal;
            $paketProgress[$index] = $data->paketProgress;
            $paketSelesai[$index]  = $data->paketSelesai;
            $paketTayang[$index]   = $data->paketTayang;
        }

        $data = [
            'pageTitle'     => 'Dashboard',
            'subTitle'      => 'Halaman Utama Apilkasi',
            'icon'          => 'pe-7s-browser',
            'crumbs'        => $crumbs,
            'paketStatus'   => $paketStatus,
            'months'        => $months,
            'paketTotal'    => $paketTotal,
            'paketProgress' => $paketProgress,
            'paketSelesai'  => $paketSelesai,
            'paketTayang'   => $paketTayang,
        ];

        return view('dashboard.dashboard', $data);
    }
}
