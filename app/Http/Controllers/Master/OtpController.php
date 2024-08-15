<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OtpController extends Controller
{
    public function __construct()
    {
        $this->route = 'otp';
        $this->title = 'One-Time Password';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title  = $this->title;
        $crumbs = [
            'Dashboard'          => route('dashboard'),
            'Master'             => '',
            "Manajemen {$title}" => '',
        ];

        $data = [
            'pageTitle' => "Data {$title}",
            'subTitle'  => "Halaman Manajemen {$title}",
            'icon'      => 'fa fa-building',
            'route'     => $this->route,
            'crumbs'    => $crumbs,
        ];

        return view('dashboard.master.'.$this->route.'.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Otp::get();

            return DataTables::of($data)->addIndexColumn()
                ->editColumn('tipe', function ($data) {
                    $tipe = null;
                    switch ($data->tipe) {
                        case 1:
                            $tipe = 'awdawd';

                            break;

                        default:
                            $tipe = 'awdawd default';

                            break;
                    }

                    return $tipe;
                })
                ->editColumn('status', function ($data) {
                    $status = null;
                    switch ($data->status) {
                        case true:
                            $status = 'awdawd';

                            break;

                        default:
                            $status = 'awdawd default';

                            break;
                    }

                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                        <div class="btn-group btn-sm">
                            <a title="edit" href="'.route($this->route.'.edit', $row->id).'" action="'.route($this->route.'.update', $row->id).'" class="btn btn-warning btn-sm remote-modal">
                                <i class="bx bx-edit"></i>
                            </a>

                        </div>
                    ';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
