<?php

namespace App\Http\Controllers\Master;

use App\Http\Requests\Master\KategoriReviewRequest;
use App\Models\Master\KategoriReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class KategoriReviewController extends Controller
{
    public function __construct()
    {
        $this->route = 'kategori-review';
        $this->title = 'Kategori Review';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
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

            'dataKategoriReview' => KategoriReview::orderBy('nama', 'asc')->get(),
        ];

        return view('dashboard.master.'.$this->route.'.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(KategoriReviewRequest $request)
    {
        $validate = $request->validated();
        DB::transaction(function () use ($validate) {
            $incrementNoUrut     = KategoriReview::max('no_urut');
            $validate['no_urut'] = $incrementNoUrut + 1;

            KategoriReview::create($validate);
        });

        session()->flash('success', $this->title.' Berhasil Ditambahkan');

        return redirect()->route($this->route.'.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(KategoriReview $kategoriReview)
    {
        $data = [
            'KategoriReview' => $kategoriReview,
        ];

        return view('dashboard.master.'.$this->route.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(KategoriReviewRequest $request, KategoriReview $kategori_review)
    {
        $validate = $request->validated();

        DB::transaction(function () use ($validate, $kategori_review) {
            $kategori_review->update($validate);
        });

        session()->flash('success', $this->title.'Review Berhasil Diupdate');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(KategoriReview $kategoriReview)
    {
        $delete = $kategoriReview->delete();

        // check data deleted or not
        if ($delete) {
            $class   = 'success';
            $success = true;
            $message = 'Data Telah Dihapus';
        } else {
            $class   = 'error';
            $success = false;
            $message = 'Data tidak ditemukan';
        }

        session()->flash($class, $message);

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = KategoriReview::orderBy('no_urut')->get();

            return DataTables::of($data)->addIndexColumn()
                ->editColumn('deskripsi', function ($data) {
                    // @phpstan-ignore-next-line
                    return $data?->deskripsi ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                        <div class="btn-group btn-sm">
                            <a title="Question" href="'.route('question.index').'?kategori='.$row->slug.'" class="btn btn-success btn-sm">
                                    <i class="bx bx-help-circle"></i>
                                </a>
                            <a title="edit" href="'.route($this->route.'.edit', $row->id).'" action="'.route($this->route.'.update', $row->id).'" class="btn btn-warning btn-sm remote-modal">
                                <i class="bx bx-edit"></i>
                            </a>
                            <button title="Hapus" type="button" class="btn btn-danger btn-sm deleteConfirmation" data-target="'.route($this->route.'.destroy', [$row->id]).'">
                                <i class="bx bx-trash "></i>
                            </button>
                        </div>
                    ';

                    return $actionBtn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        return abort(404);
    }
}
