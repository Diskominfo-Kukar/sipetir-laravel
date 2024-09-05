<x-app-layout :title=$pageTitle :sub-title=$subTitle :icon=$icon :crumbs=$crumbs>
    <div>
        @if ($paket->status != 0 && $paket->status != 10)
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="text-white card-body bg-dark"
                    <div class="container">
                        <div class="row text-center justify-content-center">
                            <div class="col-xl-6 col-lg-8">
                                <p class="font-weight-bold">Progress Timeline</p>
                                {{-- <p class="text-muted">We’re very proud of the path we’ve taken. Explore the history that made us the company we are today.</p> --}}
                            </div>
                        </div>

                        <x-fragments.timeline :timelines=$timelines :paket=$paket />
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row justify-content-evenly">
            <div class="col-md-3">
                <div class="overflow-hidden border-0 shadow-sm card">
                    <div class="card-body" style="background-color: #dad9d8">

                        <div class="mt-4 text-center">
                            <h4 class="mb-1">Kode Paket : {{$paket->kode}}</h4>
                            <p class="mb-0 text-secondary">
                                {{$paket->opd}}
                            </p>

                            <div class="mt-4"></div>
                            <h6 class="mb-1">{{$paket->nama}}</h6>
                        </div>
                        <hr>
                        <div class="text-start">
                            <h5 class="">Uraian Pekerjaan</h5>
                            <p class="mb-0">
                                {{$paket->urarian_pekerjaan}}
                            </p>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                            Proses
                            <span class="badge bg-secondary rounded-pill">{{ $progres }}%</span>
                        </li>
                    </ul>
                </div>
                <div class="overflow-hidden border-0 shadow-sm card">
                    <div class="card-body detail-bgc" style="background-color: orange">
                        <div class="text-start">
                            <h5 class="">Detail</h5>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                            PPK
                            <span class="badge bg-primary rounded-pill">{{$paket->nama_ppk}}</span>
                        </li>
                        <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                            Kode
                            <span class="badge bg-primary rounded-pill">{{$paket->kode}}</span>
                        </li>
                        <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                            Tahun
                            <span class="badge bg-info rounded-pill">{{$paket->tahun}}</span>
                        </li>
                        <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                            Kategori
                            <span class="badge bg-success rounded-pill">{{$paket->spesifikasi_pekerjaan}}</span>
                        </li>
                        <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                            RUP
                            <span class="badge bg-danger rounded-pill">112093019</span>
                        </li>
                    </ul>
                </div>
                <div class="overflow-hidden border-0 shadow-sm card">
                    <div class="card-body" style="background-color: #14d3dd">
                        <div class="text-start">
                            <h5 class="">File</h5>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        @forelse ($paket_dokumen as $dokumen)
                        <div class="col-12">
                            {{-- Download File (Tinggal masukin path nya) --}}
                            <a href="{{ asset('storage/' . $dokumen->file) }}" target="_blank">
                                <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                                    <label class="form-label"><i class="bi bi-download"></i>&nbsp;{{$dokumen->jenisDokumen->nama}}</label>
                                </li>
                            </a>
                        </div>
                        @empty
                        <div class="col-md-12 mt-3">
                            <p class="text-center fw-bold">File kosong</p>
                        </div>
                        @endforelse
                        @php
                            $documents = [
                                'surat_tugas' => 'Surat Tugas',
                                'berita_acara_1' => 'Berita Acara Review',
                                'berita_acara_2' => 'Berita Acara Penetapan',
                                'berita_acara_3' => 'Berita Acara Pengumuman',
                            ];
                        @endphp
                        @foreach($documents as $key => $label)
                            @if(!empty($$key))
                                <a href="{{ asset('storage/' . $$key) }}" target="_blank">
                                    <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                                        <label class="form-label"><i class="bi bi-download"></i>&nbsp;{{ $label }}</label>
                                    </li>
                                </a>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row">

                    @if($status=="Upload")
                        @role('PPK')
                            @if (! auth()->user()->hasRole(['Kepala BPBJ','Superadmin']) && ! $paket->ppk_id == auth()->user()->ppk_id)
                                @include('dashboard.paket.paket.components.upload')
                            @else
                            <div class="col-12">
                                <div class="border-0 shadow-sm card">
                                    <div class="card-body">
                                        <h5 class="mb-0">Upload Dokumentasi Paket</h5>
                                        <hr>
                                        <div class="border shadow-none card">
                                            <div class="card-header">

                                            </div>
                                            <div class="card-body">
                                                <div class="row g-3">
                                                    @php
                                                        $completed = true;
                                                    @endphp
                                                    @foreach ($jenis_dokumen as $dokumen)
                                                        <form class="row g-3" enctype="multipart/form-data" method="POST" action="{{ route('paket.uploadBerkas') }}">
                                                            @csrf
                                                            <div class="col-12">
                                                                <label class="form-label">{{$dokumen->nama}}</label>
                                                                <div class="mb-3 input-group">
                                                                    <input type="file" class="bg-black form-control" name="dokumen">
                                                                    <input type="hidden" name="dokumen_id" value="{{ $dokumen->id }}">
                                                                    <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                                                                    @if(isset($file_dokumen[$dokumen->id]))
                                                                        <a href="{{ asset('storage/' . $file_dokumen[$dokumen->id]) }}" class="input-group-text bg-success" target="_blank">View</a>
                                                                    @else
                                                                        @php
                                                                            $completed = false;
                                                                        @endphp
                                                                    @endif
                                                                    <button type="submit" class="input-group-text bg-warning border-0">Upload</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-start">
                                            @if($completed)
                                                <form action="{{ route('paket.uploadAllBerkas') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                                                    <button type="submit" class="btn btn-primary mx-auto d-block">Kirimkan berkas</button>
                                                </form>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endif
                        @else
                            @include('dashboard.paket.paket.components.upload')
                        @endrole

                    @elseif($status=="Upload Ulang")
                        @role('PPK')
                            @if (! auth()->user()->hasRole(['Kepala BPBJ','Superadmin']) && ! $paket->ppk_id == auth()->user()->ppk_id)
                                @include('dashboard.paket.paket.components.upload')
                            @else
                            <div class="col-12">
                                <div class="border-0 shadow-sm card">
                                    <div class="card-body">
                                        <h5 class="mb-0">Upload Paket</h5>
                                        <hr>
                                        <div class="border shadow-none card">
                                            <div class="card-body">
                                                <table class="table table-bordered ">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Nama Dokumen</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Lihat</th>
                                                            <th scope="col">Jenis Dok</th>
                                                            <th scope="col">Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($jenis_dokumen as $dokumen)
                                                        <tr>
                                                            <td>{{$dokumen->nama}}</td>
                                                            <td>{{$dokumen->status}}</td>
                                                            @if(isset($file_dokumen[$dokumen->id]))
                                                                <td><a href="{{ asset('storage/' . $file_dokumen[$dokumen->id]) }}" class="input-group-text bg-success" target="_blank">View</a></td>
                                                            @endif
                                                            <td>
                                                                <form action="{{ route('paket.uploadBerkas') }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="dokumen_id" value="{{ $dokumen->id }}">
                                                                    <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                                                                    <input type="file" name="dokumen" class="form-control">
                                                                    <button type="submit" class="btn btn-primary mt-2 form-control">Upload</button>
                                                                </form>
                                                            </td>
                                                            <td>
                                                                @php
                                                                    $dokumenKomen = $paket_dokumen->firstWhere('jenis_dokumen_id', $dokumen->id);
                                                                    $lastKomen = $dokumenKomen ? $dokumenKomen->komens->last() : null;
                                                                @endphp
                                                                @if ($lastKomen)
                                                                    <p>{{ $lastKomen->isi }}</p>
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="text-start">
                                            <form action="{{ route('paket.uploadAllBerkas') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                                                <button type="submit" class="btn btn-primary mx-auto d-block">Kirimkan berkas</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @else
                            @include('dashboard.paket.paket.components.upload')
                        @endrole

                    @elseif($status=="Verifikasi Berkas")
                        @role('Admin')
                            <div class="col-12">
                                <div class="border-0 shadow-sm card">
                                    <div class="card-body">
                                        <h5 class="mb-0">Verifikasi Berkas</h5>
                                        <hr>
                                        <div class="border shadow-none card">
                                            <div class="card-body">
                                                <form class="row g-3" enctype="multipart/form-data" method="POST" action="{{ route('paket.VerifBerkas') }}">
                                                @csrf
                                                @foreach ($jenis_dokumen as $dokumen)
                                                    <div class="col-12">
                                                        <div class="mb-3 input-group">
                                                            <input type="text" disabled value="{{ $dokumen->nama }}.pdf" class="bg-black form-control">
                                                            @if(isset($file_dokumen[$dokumen->id]))
                                                                <a href="{{ asset('storage/' . $file_dokumen[$dokumen->id]) }}" class="input-group-text bg-success" target="_blank">View</a>
                                                            @endif
                                                            <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                                                        </div>
                                                        <div class="mb-3 input-group">
                                                            <span class="input-group-text">Catatan</span>
                                                            <input class="form-control" name="catatan_{{ $dokumen->id }}"></input>
                                                        </div>
                                                        <div class="mb-3">
                                                            @php
                                                                $dokumen_Komen = $paket_dokumen->firstWhere('jenis_dokumen_id', $dokumen->id);
                                                            @endphp
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="heading-{{ $dokumen->id }}">
                                                                    <button class="accordion-button collapsed bg-light text-body" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $dokumen->id }}" aria-expanded="true" aria-controls="collapse-{{ $dokumen->id }}">
                                                                        Riwayat Komen
                                                                    </button>
                                                                </h2>
                                                                <div id="collapse-{{ $dokumen->id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $dokumen->id }}" data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body">
                                                                        <ul class="text-body">
                                                                            @if ($dokumen_Komen && $dokumen_Komen->komens->isNotEmpty())
                                                                                @foreach ($dokumen_Komen->komens as $komen)
                                                                                    <li>{{ $komen->isi }} - {{ \Carbon\Carbon::parse($komen->created_at)->locale('id')->translatedFormat('d F Y H:i') }}</li>

                                                                                @endforeach
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    &nbsp;
                                                @endforeach
                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-danger" name="action" value="decline">Tidak Setujui</button> &nbsp;&nbsp;
                                                    <button type="submit" class="btn btn-primary" name="action" value="accept">Setujui</button>
                                                </div>
                                            </form>

                                            </div>
                                        </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @include('dashboard.paket.paket.components.verif')
                        @endrole

                    @elseif($status=="Pemilihan Pokmil")
                        @role('Kepala BPBJ')
                            <div class="col-12">
                                <div class="border-0 shadow-sm card">
                                    <div class="card-body">
                                        <h5 class="mb-0">Pemilihan Pokmil</h5>
                                        <hr>
                                        <div class="border shadow-none card">
                                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                                <span id="number-display" class="display-1 text-center">0</span> &nbsp;
                                                <div class="d-flex justify-content-center">
                                                    <button id="toggle-button" type="button" class="btn btn-primary mx-2">Acak</button>
                                                    <form action="{{ route('paket.progres_surat_tugas') }}" method="POST">
                                                        @csrf
                                                        <input id="pokmil-number-input" type="hidden" name="pokmil_number" value="">
                                                        <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                                                        <button id="process-button" type="submit" class="btn btn-success mx-2 d-none">Proses</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @include('dashboard.paket.paket.components.pilpokmil')
                        @endrole

                    @elseif($status=="Surat Tugas")
                        @role('PPK')
                            <div class="col-12">
                                <div class="border-0 shadow-sm card">
                                    <div class="card-body">
                                        <h5 class="mb-0">Permohonan Surat Tugas</h5>
                                        <hr>
                                        <div class="border shadow-none card">
                                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                                <div class="d-flex justify-content-center w-100">
                                                    <form action="{{ route('paket.generate_surat_tugas') }}" method="POST" class="w-100">
                                                        @csrf
                                                        <div class="form-group row mb-3">
                                                            <label for="kode" class="col-sm-3 col-form-label text-right">Kode Surat</label>
                                                            <div class="col-sm-9">
                                                                <input type="number" name="kode" class="form-control" value="{{ $kode_sa }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-3">
                                                            <label for="nama_paket" class="col-sm-3 col-form-label text-right">Nama Paket</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="nama_paket" class="form-control" value="{{ $paket->nama }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-3">
                                                            <label for="jenis_pekerjaan" class="col-sm-3 col-form-label text-right">Jenis Pekerjaan</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="jenis_pekerjaan" class="form-control" value="{{ $paket->jenis_pekerjaan }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-3">
                                                            <label for="nama_opd" class="col-sm-3 col-form-label text-right">Nama OPD</label>
                                                            <div class="col-sm-9">
                                                                <select name="nama_opd" class="form-control select2" required>
                                                                    <option value="" disabled selected></option>
                                                                    @foreach($opd as $item)
                                                                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-3">
                                                            <label for="sumber_dana" class="col-sm-3 col-form-label text-right">Sumber Dana</label>
                                                            <div class="col-sm-9">
                                                                <select name="sumber_dana" class="form-control select2" required>
                                                                    <option value="" disabled selected></option>
                                                                    @foreach($sumber_dana as $item)
                                                                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-3">
                                                            <label for="pagu" class="col-sm-3 col-form-label text-right">Pagu</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="pagu" class="form-control input-rupiah" value="{{ formatRupiah($paket->pagu) }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-3">
                                                            <label for="hps" class="col-sm-3 col-form-label text-right">HPS</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="hps" class="form-control input-rupiah" value="{{ formatRupiah($paket->hps) }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-3">
                                                            <label for="dpa" class="col-sm-3 col-form-label text-right">DPA</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="dpa" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-3">
                                                            <label for="tahun" class="col-sm-3 col-form-label text-right">Tahun</label>
                                                            <div class="col-sm-9">
                                                                <input type="number" name="tahun" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                                                        <div class="form-group row mt-4">
                                                            <div class="col-sm-12 text-center">
                                                                <button type="submit" class="btn btn-danger mx-2">
                                                                    <i class="fa fa-file-pdf"></i>
                                                                    Buat Surat Tugas
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @include('dashboard.paket.paket.components.surattugas')
                        @endrole

                    @elseif($status=="TTE Surat Tugas")
                        @role('Kepala BPBJ')
                            <div class="col-12">
                                <div class="border-0 shadow-sm card">
                                    <div class="card-body">
                                        <h5 class="mb-0">Surat Tugas</h5>
                                        <hr>
                                        <div class="border shadow-none card">
                                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                                <div class="d-flex justify-content-center">
                                                    @if ($surat_tugas)
                                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-tte">
                                                            <i class="bi bi-pen"></i>Tandatangani
                                                        </a>
                                                    @endif
                                                </div>
                                                @if ($surat_tugas)
                                                    <br>
                                                    <div class="mt-4 w-100">
                                                        <iframe src="{{ asset('storage/' . $surat_tugas)  }}" width="100%" height="800px"></iframe>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @include('dashboard.paket.paket.components.surattugasTTE')
                        @endrole

                    @elseif($status=="Review")
                        @role('Panitia')
                            @if (! auth()->user()->hasRole(['Kepala BPBJ','Superadmin']) && ! in_array($paket->pokmil_id, auth()->user()->pokmil_id))
                                @include('dashboard.paket.paket.components.review')
                            @else
                            <div class="col-12">
                                <div class="border-0 shadow-sm card">
                                    <div class="card-body">
                                        <h5 class="mb-0">Review</h5>
                                        <hr>
                                        <div class="border shadow-none card">
                                            <div class="card-body">
                                                <ul class="nav nav-tabs" id="reviewTab" role="tablist">
                                                    @foreach ($kategori_reviews as $index => $kategori)
                                                        <li class="nav-item" role="presentation">
                                                            <a class="nav-link {{ $index == 0 ? 'active' : '' }}" id="tab{{ $kategori->id }}-tab" data-bs-toggle="tab" href="#tab{{ $kategori->id }}" role="tab" aria-controls="tab{{ $kategori->id }}" aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                                                                {{ $kategori->nama }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                &nbsp;
                                                <div class="tab-content" id="reviewTabContent">
                                                    @foreach ($kategori_reviews as $index => $kategori)
                                                        <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="tab{{ $kategori->id }}" role="tabpanel" aria-labelledby="tab{{ $kategori->id }}-tab">
                                                            <ul>
                                                                @foreach ($kategori->questions as $question)
                                                                    @php
                                                                        $answer = $question->answers->firstWhere('paket_id', $paket->id);
                                                                    @endphp
                                                                    <li>
                                                                        <div>
                                                                            {{ $question->nama }} <br>
                                                                            @if ($answer)
                                                                                Jawaban: {{ $answer->review }}
                                                                                @if ($answer->user->panitia)
                                                                                    (Dijawab oleh {{ $answer->user->panitia->nama }}) - {{ \Carbon\Carbon::parse($answer->updated_at)->locale('id')->translatedFormat('d F Y H:i') }}
                                                                                @endif
                                                                            @else
                                                                                &nbsp;<br>[ Belum ada jawaban ]
                                                                            @endif
                                                                        </div>
                                                                        <div>
                                                                            <form method="POST" action="{{ route('paket.answer_question') }}" class="d-flex flex-row align-items-center">
                                                                                @csrf
                                                                                <input type="hidden" name="question_id" value="{{ $question->id }}">
                                                                                <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                                                                                <input type="text" name="review" class="form-control me-2" placeholder="{{ $panitia->nama }} menjawab">
                                                                                <button type="submit" class="btn btn-danger">Kirim</button>
                                                                            </form>
                                                                        </div>
                                                                        @if (!$loop->last)
                                                                            &nbsp;<hr>
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center mt-3">
                                            <form action="{{ route('paket.progres_berita_acara') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                                                <button type="submit" class="btn btn-success mx-2">Selesai Review</button>
                                            </form>
                                        </div><br>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @else
                            @include('dashboard.paket.paket.components.review')
                        @endrole

                    @elseif($status=="Berita Acara")
                        @role('Panitia')
                            @if (! auth()->user()->hasRole(['Kepala BPBJ','Superadmin']) && ! in_array($paket->pokmil_id, auth()->user()->pokmil_id))
                                @include('dashboard.paket.paket.components.beritaacara')
                            @else
                            <div class="col-12">
                                    <div class="border-0 shadow-sm card">
                                        <div class="card-body">
                                            <ul class="nav nav-tabs" id="reviewTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" id="berita-acara-1-tab" data-bs-toggle="tab" href="#berita-acara-1" role="tab" aria-controls="berita-acara-1" aria-selected="true">
                                                        Buat Berita Acara Review
                                                    </a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="berita-acara-2-tab" data-bs-toggle="tab" href="#berita-acara-2" role="tab" aria-controls="berita-acara-2" aria-selected="false">
                                                        Upload Berita Acara Review
                                                    </a>
                                                </li>
                                            </ul>
                                            &nbsp;
                                            <div class="tab-content" id="reviewTabContent">
                                                <div class="tab-pane show active" id="berita-acara-1" role="tabpanel" aria-labelledby="berita-acara-1-tab">
                                                    <div class="card-body">
                                                        <div class="border shadow-none card">
                                                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                                                <div class="d-flex justify-content-center w-100">
                                                                    <form action="{{ route('paket.generate_berita_acara') }}" method="POST" class="w-100">
                                                                        @csrf
                                                                        <div class="form-group row mb-3">
                                                                            <label for="kode" class="col-sm-3 col-form-label text-right">Kode Surat</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="number" name="kode" class="form-control" value="{{ old('kode', $kode_ba) }}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mb-3">
                                                                            <label for="nama_paket" class="col-sm-3 col-form-label text-right">Nama Paket</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="nama_paket" class="form-control" value="{{ old('nama_paket', $new_data->nama_paket) }}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mb-3">
                                                                            <label for="jenis_pekerjaan" class="col-sm-3 col-form-label text-right">Jenis Pekerjaan</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="jenis_pekerjaan" class="form-control" value="{{ old('jenis_pekerjaan', $new_data->jenis_pekerjaan) }}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mb-3">
                                                                            <label for="satker" class="col-sm-3 col-form-label text-right">Satuan Kerja</label>
                                                                            <div class="col-sm-9">
                                                                                <select name="satker" class="form-control select2" required>
                                                                                    <option value="{{ old('satker', $new_data->satker) }}">{{ old('satker', $new_data->satker) }}</option>
                                                                                    @foreach($satker as $item)
                                                                                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mb-3">
                                                                            <label for="nama_opd" class="col-sm-3 col-form-label text-right">Nama OPD</label>
                                                                            <div class="col-sm-9">
                                                                                <select name="nama_opd" class="form-control select2" required>
                                                                                    <option value="{{ old('nama_opd', $new_data->nama_opd) }}">{{ old('nama_opd', $new_data->nama_opd) }}</option>
                                                                                    @foreach($opd as $item)
                                                                                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mb-3">
                                                                            <label for="sumber_dana" class="col-sm-3 col-form-label text-right">Sumber Dana</label>
                                                                            <div class="col-sm-9">
                                                                                <select name="sumber_dana" class="form-control select2" required>
                                                                                    <option value="{{ old('sumber_dana', $new_data->sumber_dana) }}">{{ old('sumber_dana', $new_data->sumber_dana) }}</option>
                                                                                    @foreach($sumber_dana as $item)
                                                                                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mb-3">
                                                                            <label for="pagu" class="col-sm-3 col-form-label text-right">Pagu</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="pagu" class="form-control input-rupiah" value="{{ old('pagu', formatRupiah($new_data->pagu)) }}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mb-3">
                                                                            <label for="hps" class="col-sm-3 col-form-label text-right">HPS</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="hps" class="form-control input-rupiah" value="{{ old('hps', formatRupiah($new_data->hps)) }}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mb-3">
                                                                            <label for="dpa" class="col-sm-3 col-form-label text-right">DPA</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="dpa" class="form-control " value="{{ old('dpa', $new_data->dpa) }}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mb-3">
                                                                            <label for="tahun" class="col-sm-3 col-form-label text-right">Tahun</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $new_data->tahun) }}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mb-3">
                                                                            <label for="lokasi" class="col-sm-3 col-form-label text-right">Lokasi Pekerjaan</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="lokasi" class="form-control" value="-" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mb-3">
                                                                            <label for="intro" class="col-sm-3 col-form-label text-right">Kalimat Pembuka</label>
                                                                            <div class="col-sm-9">
                                                                                <textarea name="intro" class="form-control" rows="5" required>
                                                                                    <p style="padding: 8px; text-align: justify;">Pada hari ini <b>{{ $tanggal['hari'] }}</b> tanggal <b>{{ $tanggal['tanggal'] }}</b> bulan
                                                                                        <b>{{ $tanggal['bulan'] }}</b> tahun
                                                                                        <b>{{ $tanggal['tahun'] }}</b>, bertempat di <b>Kantor Bagian Pengadaan Barang dan Jasa Sekertariat Daerah Kabupaten
                                                                                            Kartanegara</b> telah dilaksanakan kegiatan Reviu Dokumen Persiapan Pengadaan untuk:
                                                                                    </p>
                                                                                </textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mb-3">
                                                                            <label for="lokasi_ba" class="col-sm-3 col-form-label text-right">Lokasi Berita Acara</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="lokasi_ba" class="form-control" value="Tenggarong" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mb-3">
                                                                            <label for="jam_mulai" class="col-sm-3 col-form-label text-right">Jam Mulai Rapat</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="jam_mulai" class="form-control" value="10.00 Wita" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mb-3">
                                                                            <label for="jam_berakhir" class="col-sm-3 col-form-label text-right">Jam Berakhir Rapat</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="jam_berakhir" class="form-control" value="11.30 Wita" required>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                                                                        <div class="form-group row mt-4">
                                                                            <div class="col-sm-12 text-center">
                                                                                <button type="submit" class="btn btn-danger mx-2">
                                                                                    <i class="fa fa-file-pdf"></i>
                                                                                    Buat Berita Acara Review
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="berita-acara-2" role="tabpanel" aria-labelledby="berita-acara-2-tab">
                                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                                        <div class="d-flex justify-content-center">
                                                            <form action="{{ route('paket.upload_berita_acara_1') }}" enctype="multipart/form-data" method="POST" class="d-flex align-items-center">
                                                                @csrf
                                                                <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                                                                <div class="input-group">
                                                                    <input type="file" class="form-control" name="dokumen" style="max-width: 300px;">
                                                                    <button type="submit" class="btn btn-danger">
                                                                        <i class="fa fa-file-pdf"></i>
                                                                        Upload Berita Acara Review
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            @endif
                        @else
                            @include('dashboard.paket.paket.components.beritaacara')
                        @endrole

                    @elseif($status=="TTE Berita Acara Panitia")
                        @role('Panitia')
                            @if (! auth()->user()->hasRole(['Kepala BPBJ','Superadmin']) && ! in_array($paket->pokmil_id, auth()->user()->pokmil_id))
                                @include('dashboard.paket.paket.components.beritaacaraTTE_panitia')
                            @else
                            <div class="col-12">
                                <div class="border-0 shadow-sm card">
                                    <div class="card-body">
                                        <h5 class="mb-0">Berita Acara</h5>
                                        <hr>
                                        <div class="border shadow-none card">
                                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                                <div class="d-flex justify-content-center">
                                                    @if ($berita_acara_1 && !$panitiaSudahAcc)
                                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-tte">
                                                            <i class="bi bi-pen"></i>Tandatangani
                                                        </a>
                                                    @elseif($panitiaSudahAcc)
                                                        Sudah menyetujui berita acara, menunggu panitia lain menyetujui berita acara ini.
                                                    @endif
                                                </div>
                                                @if ($berita_acara_1)
                                                    <br>
                                                    <div class="mt-4 w-100">
                                                        <iframe src="{{ asset('storage/' . $berita_acara_1)  }}" width="100%" height="800px"></iframe>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @else
                            @include('dashboard.paket.paket.components.beritaacaraTTE_panitia')
                        @endrole

                    @elseif($status=="TTE Berita Acara PPK")
                        @role('PPK')
                            @if (! auth()->user()->hasRole(['Kepala BPBJ','Superadmin']) && ! $paket->ppk_id == auth()->user()->ppk_id)
                                @include('dashboard.paket.paket.components.beritaacaraTTE_ppk')
                            @else
                            <div class="col-12">
                                <div class="border-0 shadow-sm card">
                                    <div class="card-body">
                                        <h5 class="mb-0">Berita Acara</h5>
                                        <hr>
                                        <div class="border shadow-none card">
                                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                                <div class="d-flex justify-content-center">
                                                    @if ($berita_acara_1)
                                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-tte">
                                                            <i class="bi bi-pen"></i>Tandatangani
                                                        </a>
                                                    @endif
                                                </div>
                                                @if ($berita_acara_1)
                                                    <br>
                                                    <div class="mt-4 w-100">
                                                        <iframe src="{{ asset('storage/' . $berita_acara_1)  }}" width="100%" height="800px"></iframe>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @else
                            @include('dashboard.paket.paket.components.beritaacaraTTE_ppk')
                        @endrole

                    @endif

                    @if(($paket->status == 10) &&  auth()->user()->hasRole('Panitia'))
                        @if($berita_acara_2==null)
                            @include('dashboard.paket.paket.components.penetapan')
                        @elseif ($berita_acara_3==null)
                            @include('dashboard.paket.paket.components.pengumuman')
                        @else
                            @include('dashboard.paket.paket.components.status0')
                        @endif
                    @elseif(($paket->status == 0 || $paket->status == 10 || $paket->status == null ))
                        @include('dashboard.paket.paket.components.status0')
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('dashboard.paket.paket.components.modal-tte')

    <!--end row-->
    @push('styles')
        <style>
            /* .detail-bgc{
            background-color: #b87c0c";
            } */

            .timeline{
            counter-reset: test 0;
            position: relative;
            }

            br {
            content: "";
            margin: 2em;
            display: block;
            font-size: 24%;
            }

            .timeline li{
            list-style: none;
            float: left;
            width: 24%;
            position: relative;
            text-align: center;
            text-transform: uppercase;
            }

            ul:nth-child(1){
            color: #4caf50;
            }

            .tab-pane ul {
                color: #555555;
            }

            .timeline li:before{
            counter-increment: test;
            content: counter(test);
            width: 50px;
            height: 50px;
            border: 3px solid #4caf50;
            border-radius: 50%;
            display: block;
            text-align: center;
            line-height: 50px;
            margin: 0 auto 10px auto;
            background: #fff;
            color: #000;
            transition: all ease-in-out .3s;
            cursor: pointer;
            }

            .timeline li:after{
            content: "";
            position: absolute;
            width: 100%;
            height: 1px;
            background-color: grey;
            top: 25px;
            left: -50%;
            z-index: -999;
            transition: all ease-in-out .3s;
            }

            .timeline li:first-child:after{
            content: none;
            }
            .timeline li.active-tl{
            color: #555555;
            }
            .timeline li.active-tl:before{
            background: #065773;
            color: #F1F1F1;
            }

            .timeline li.active-tl + li:after{
            background: #4caf50;
            }

            .select2-container--bootstrap-5 .select2-results__option {
                color: black;
            }


        </style>
    @endpush

    @push('scripts')
    <script>

        $('.input-rupiah').on("input", function() {
            let val = formatRupiah(this.value, '');
            $(this).val(val);
        });

        $(document).ready(function() {
        $('.select2').select2({
                theme: 'bootstrap-5',
            });
        });

        </script>
        <script src="https://cdn.tiny.cloud/1/5ps1i1boa3tg20qfzwuk59h75b186ickj43d35pn8x1o4xy7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea[name=intro], textarea[name=outro]',
            height: 300,
            menubar: false,
            statusbar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | for     matselect | bold italic backcolor | \
                      alignleft aligncenter alignright alignjustify | \
                      bullist numlist outdent indent | removeformat | help'
        });
    </script>
        <script>
        let isAnimating = false;
        let intervalId;
        let numbers = [];

        async function fetchNumbers() {
            try {
                const response = await fetch('/roll');
                const data = await response.json();
                numbers = data;
            } catch (error) {
                console.error('Error fetching numbers:', error);
            }
        }

        document.addEventListener('DOMContentLoaded', fetchNumbers);

        function startAnimation() {
            const display = document.getElementById('number-display');
            intervalId = setInterval(() => {
                const randomIndex = Math.floor(Math.random() * numbers.length);
                display.textContent = numbers[randomIndex];
            }, 50);
        }

        function stopAnimation() {
            clearInterval(intervalId);
        }

        document.getElementById('toggle-button').addEventListener('click', () => {
            if (isAnimating) {
                stopAnimation();
                isAnimating = false;
                document.getElementById('toggle-button').textContent = 'Acak';
                document.getElementById('process-button').classList.remove('d-none');
                var number = document.getElementById('number-display').textContent;
                var inputHidden = document.getElementById('pokmil-number-input');
                inputHidden.value = number;
            } else {
                startAnimation();
                isAnimating = true;
                document.getElementById('toggle-button').textContent = 'Berhenti';
                document.getElementById('process-button').classList.add('d-none');
            }
        });


        </script>
    @endpush
</x-app-layout>
