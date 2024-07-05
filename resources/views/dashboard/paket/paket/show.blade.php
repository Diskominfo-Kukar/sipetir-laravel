<x-app-layout :title=$pageTitle :sub-title=$subTitle :icon=$icon :crumbs=$crumbs>
    <div class="row">
        <div class="col-3 col-lg-3">
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
                        Detail
                    </li>
                    <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                        Log Proses
                        <span class="badge bg-secondary rounded-pill">1%</span>
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
                    @foreach ($jenis_dokumen as $dokumen)
                        <div class="col-12">
                            <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                                <label class="form-label"><i class="bi bi-download"></i>&nbsp;{{$dokumen->nama}}</label>
                            </li>
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-8 col-lg-8">
            <div class="row">
                <div class="col-12">
                    <div class="text-white card-body bg-dark"
                        <h5>Progress</h5>
                        <div class="gap-3">

                            <ul class="timeline">
                                <li class="@if ($paket->status == 1 || $paket->status == 11) active-tl @endif">Upload</li>
                                <li class="@if ($paket->status == 2) active-tl @endif">Verif Berkas</li>
                                <li class="@if ($paket->status == 3) active-tl @endif">Pemilihan Pokmil</li>
                                <li class="@if ($paket->status == 4) active-tl @endif">TTE Surat Tugas</li>
                                <li class="@if ($paket->status == 5) active-tl @endif">Review</li>
                                <li class="@if ($paket->status == 6) active-tl @endif">TTE Berita Acara Panitia</li>
                                <li class="@if ($paket->status == 7) active-tl @endif">TTE Berita Acara PPK</li>
                            </ul>
                        </div>
                        <p  style="line-height: 200px">
                            {{-- Upload --}} &nbsp;
                        </p>
                    </div>
                </div>
                {{-- selesai --}}
                @if($paket->status==0)
                <div class="col-12">
                    <div class="border-0 shadow-sm card">
                        <div class="card-body">
                            <h5 class="mb-0">Selesai</h5>
                            <hr>
                            <div class="border shadow-none card">
                                <div class="card-header">

                                </div>
                                <div class="card-body">
                                    <form class="row g-3">


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- upload --}}
                @elseif($paket->status==1)
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
                @elseif($paket->status==11)
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
                {{-- Verif Admin--}}
                @elseif($paket->status==2)
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
                                                    $dokumenComments = $paket_dokumen->firstWhere('jenis_dokumen_id', $dokumen->id);
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
                                                                @if ($dokumenComments && $dokumenComments->komens->isNotEmpty())
                                                                    @foreach ($dokumenComments->komens as $komen)
                                                                        <li>{{ $komen->isi }}</li>
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
                {{-- Upload ulang --}}

                {{-- Kaji Ulang --}}
                @elseif($paket->status==3)
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
                                            <form action="{{ route('paket.TTE_SuratTugas') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                                                <button id="process-button" type="submit" class="btn btn-success mx-2 d-none">Proses</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($paket->status==4)
                    <div class="col-12">
                        <div class="border-0 shadow-sm card">
                            <div class="card-body">
                                <h5 class="mb-0">Surat Tugas</h5>
                                <hr>
                                <div class="border shadow-none card">
                                    <div class="card-body">
                                        Belum jadi
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>

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


        </style>
    @endpush

    @push('scripts')
        <script>
        let isAnimating = false;
        let intervalId;
        let numbers = [];

        async function fetchNumbers() {
            try {
                const response = await fetch('/master/roll');
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
            } else {
                startAnimation();
                isAnimating = true;
                document.getElementById('toggle-button').textContent = 'Berhenti';
            }
        });
        </script>
    @endpush
</x-app-layout>
