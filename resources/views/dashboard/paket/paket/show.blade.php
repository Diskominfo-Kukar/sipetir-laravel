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
                                <li class="@if ($paket->status == 0) active-tl @endif">Upload</li>
                                <li class="@if ($paket->status == 2) active-tl @endif">Review</li>
                                <li class="@if ($paket->status == 3) active-tl @endif">Kaji Ulang</li>
                                <li class="@if ($paket->status == 1) active-tl @endif">Selesai</li>
                            </ul>
                        </div>
                        <p  style="line-height: 100px">
                            {{-- Upload --}} &nbsp;
                        </p>
                    </div>
                </div>
                {{-- upload --}}
                @if($paket->status==0)
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
                                <button type="button" class="btn btn-primary mx-auto d-block">Save Changes</button>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- selesai --}}
                @elseif($paket->status==1)
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
                {{-- Review Admin--}}
                @elseif($paket->status==22)
                <div class="col-12">
                    <div class="border-0 shadow-sm card">
                        <div class="card-body">
                            <h5 class="mb-0">Review Paket</h5>
                            <hr>
                            <div class="border shadow-none card">
                                <div class="card-body">
                                    <form class="row g-3">
                                        @foreach ($jenis_dokumen as $dokumen)
                                        <div class="col-12">
                                            <label class="form-label">{{$dokumen->nama}}</label>
                                            <div class="mb-3 input-group">
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" type="checkbox" aria-label="Checkbox for following text input">
                                                </div>
                                                <input type="input" disabled value="{{ $dokumen->nama }}.pdf" class="bg-black form-control">
                                                <label class="input-group-text bg-success" for="">View</label>
                                            </div>
                                            <div class="mb-3 input-group">
                                                <div class="input-group-text">
                                                    <label for="Ctt" class="col-sm-2 ">Catatan</label>
                                                </div>
                                                <input type="textarea" class="form-control" id="Ctt">
                                            </div>
                                        </div>
                                        @endforeach
                                    </form>
                                </div>
                            </div>
                            <div class="text-start">
                                <button type="button" class="btn btn-primary mx-auto d-block">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Review --}}
                @elseif($paket->status==2)
                <div class="col-12">
                    <div class="border-0 shadow-sm card">
                        <div class="card-body">
                            <h5 class="mb-0">Review Paket</h5>
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
                                                <td><label class="input-group-text bg-success" for="">View</label></td>
                                                <td><label class="input-group-text bg-warning" for="">Upload</label></td>
                                                <td>-</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="text-start">
                                <button type="button" class="btn btn-primary mx-auto d-block">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Kaji Ulang --}}
                @elseif($paket->status==3)

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

    @push('script')
        <script>

        </script>
    @endpush
</x-app-layout>
