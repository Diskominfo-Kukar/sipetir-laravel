<?php

namespace App\Http\Controllers\Master;

use App\Http\Requests\Master\QuestionRequest;
use App\Models\Master\KategoriReview;
use App\Models\Master\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->route = 'question';
        $this->title = 'Question';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // check jika id kategori review tidak ada
        $kategori = $request->kategori;

        if (! $kategori) {
            return redirect()->route('kategori-review.index');
        }

        // check jika kategori review tidak ada
        $KategoriReview = KategoriReview::whereSlug($kategori)->first();

        if (! isset($KategoriReview)) {
            return redirect()->route('kategori-review.index');
        }

        if ($request->filled('question')) {
            $question = $request->question;
        }

        $title  = $this->title.' - '.$KategoriReview->nama;
        $crumbs = [
            'Dashboard'          => route('dashboard'),
            'Kategori Review'    => route('kategori-review.index'),
            "Manajemen {$title}" => '',
        ];

        $data = [
            'pageTitle'     => "Data {$title}",
            'subTitle'      => "Halaman Manajemen {$title}",
            'icon'          => 'fa fa-building',
            'route'         => $this->route,
            'crumbs'        => $crumbs,
            'kategori_id'   => $KategoriReview->id,
            'kategori_slug' => $KategoriReview->slug,
            'question'      => $question ?? null,
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(QuestionRequest $request)
    {
        $validate = $request->validated();

        DB::transaction(function () use ($validate) {
            Question::create($validate);
        });

        $KategoriReview = KategoriReview::find($request->kategori_id);
        session()->flash('success', $this->title.' Berhasil Ditambahkan');

        // @phpstan-ignore-next-line
        return redirect()->route($this->route.'.index', ['kategori' => $KategoriReview->slug, 'question' => $request?->parent_id])->with('kategori', $KategoriReview->slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(Question $question)
    {
        // check jika id kategori review tidak ada
        $kategori_id = $question->kategori_id;

        if (! $kategori_id) {
            return redirect()->route('kategori-review.index');
        }

        // check jika kategori review tidak ada
        $KategoriReview = KategoriReview::find($kategori_id);

        if (! isset($KategoriReview)) {
            return redirect()->route('kategori-review.index');
        }

        $data = [
            'question'    => $question,
            'kategori_id' => $kategori_id,
            // @phpstan-ignore-next-line
            'parent_id' => $question?->parent_id,
        ];

        return view('dashboard.master.'.$this->route.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $validate = $request->validated();

        DB::transaction(function () use ($validate, $question) {
            $question->update($validate);
        });

        session()->flash('success', $this->title.'Review Berhasil Diupdate');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Question $question)
    {
        $delete = $question->delete();

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
            $KategoriReview = KategoriReview::whereSlug($request->kategori)->first();
            $query          = Question::where('kategori_id', $KategoriReview->id);

            if ($request->filled('question')) {
                $question = $request->question;
                $query    = $query->find($question)->childrenQuestions();
            } else {
                $query = $query->where('parent_id', null);
            }

            $data = $query->orderBy('no_urut')->get();

            return DataTables::of($data)->addIndexColumn()
                ->editColumn('deskripsi', function ($data) {
                    // @phpstan-ignore-next-line
                    return $data?->deskripsi ?? '-';
                })
                ->addColumn('action', function ($row) use ($KategoriReview) {
                    $actionBtn = '
                        <div class="btn-group btn-sm">
                            <a title="Question" href="'.route('question.index').'?kategori='.$KategoriReview->slug.'&question='.$row->id.'" class="btn btn-success btn-sm">
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
