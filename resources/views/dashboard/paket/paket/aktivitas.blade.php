<x-app-layout :title=$pageTitle :sub-title=$subTitle :icon=$icon :crumbs=$crumbs>
    <div>
        {{-- @if ($paket->status != 0 && $paket->status != 10) --}}
        @if (($paket->status > 0 && $paket->status < 10) || $paket->status == 11)
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
                        <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                            Surat Tugas
                            @if(str_starts_with($surat_tugas, 'documents/signed/'))
                                <span class="badge bg-success rounded-pill">Sudah</span>
                            @else
                                <span class="badge bg-danger rounded-pill">Belum</span>
                            @endif
                        </li>
                        <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                            Berita Acara Review
                            @if(str_starts_with($berita_acara_1, 'documents/signed/'))
                                <span class="badge bg-success rounded-pill">Sudah</span>
                            @else
                                <span class="badge bg-danger rounded-pill">Belum</span>
                            @endif
                        </li>
                        <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                            Berita Acara Penetapan
                            @if($berita_acara_2)
                                <span class="badge bg-success rounded-pill">Sudah</span>
                            @else
                                <span class="badge bg-danger rounded-pill">Belum</span>
                            @endif
                        </li>
                        <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                            Berita Acara Pengumuman
                            @if($berita_acara_3)
                                <span class="badge bg-success rounded-pill">Sudah</span>
                            @else
                                <span class="badge bg-danger rounded-pill">Belum</span>
                            @endif
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
                            Pokmil
                            <span class="badge bg-primary rounded-pill">{{$paket->pokmil->pokmil_id}}</span>
                        </li>
                        <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                            Tahun
                            <span class="badge bg-primary rounded-pill">{{ \Carbon\Carbon::parse($paket->tgl_buat)->format('Y') }}</span>
                        </li>
                        @foreach ([
                            'jenis_pekerjaan' => 'Jenis Pekerjaan',
                            'nama_opd' => 'Nama Opd',
                            'sumber_dana' => 'Sumber Dana',
                            'dpa' => 'DPA',
                            'pagu' => 'Pagu',
                            'hps' => 'Hps',
                            'lokasi' => 'Lokasi'
                        ] as $field => $label)
                            @if(isset($data->$field))
                                <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                                    {{ $label }}
                                    <span class="badge bg-primary rounded-pill">{{ $data->$field }}</span>
                                </li>
                            @endif
                        @endforeach
                        <!--li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                            RUP
                            <span class="badge bg-danger rounded-pill">112093019</span>
                        </!--li-->
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

                <div class="overflow-hidden border-0 shadow-sm card mt-3">
                    <div class="card-body" style="background-color: #b9a8eb">
                        <div class="text-start">
                            <h5>Aktifitas Paket</h5>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        @forelse ($paket->paketHistories->take(5) as $history)
                            <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                                <label class="form-label small"><i class="bi bi-clock-history"></i>&nbsp;{{ $history->message }}</label>
                                <span class="text-muted small">{{ $history->created_at->format('d-m-Y H:i:s') }}</span>
                            </li>
                        @empty
                        <div class="col-md-12 mt-3">
                            <p class="text-center fw-bold small">Tidak ada riwayat</p>
                        </div>
                        @endforelse
                    </ul>
                </div>

            </div>

            <div class="col-md-8">
                <div class="row">
                    @include('dashboard.paket.paket.components.aktivitas')
                </div>
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

        </script>
    @endpush
</x-app-layout>
