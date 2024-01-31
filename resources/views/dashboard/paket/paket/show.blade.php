<x-app-layout :title=$pageTitle :sub-title=$subTitle :icon=$icon :crumbs=$crumbs>

    <div class="row">
        <div class="col-3 col-lg-3">
            <div class="overflow-hidden border-0 shadow-sm card">
                <div class="card-body">

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
                        <span class="badge bg-primary rounded-pill">70%</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-8 col-lg-8">
            <div class="row">
                <div class="col-12">
                    <div class="text-white card-body bg-dark">
                        <h5>Progress</h5>
                        <div class="gap-3">

                            <ul class="timeline">
                                <li class="active-tl">Android</li>
                                <li>Windows</li>
                                <li>iOS</li>
                            </ul>
                        </div>
                        <p>
                            Upload
                        </p>
                    </div>
                </div>
                <div class="col-12">

                    <div class="border-0 shadow-sm card">
                        <div class="card-body">
                            <h5 class="mb-0">Upload Dokumentasi Paket</h5>
                            <hr>
                            <div class="border shadow-none card">
                                <div class="card-header">

                                </div>
                                <div class="card-body">
                                    <form class="row g-3">
                                        @foreach ($jenis_dokuman as $dokumen)

                                        <div class="col-12">
                                            <label class="form-label">{{$dokumen->nama}}</label>
                                            <div class="mb-3 input-group">
                                                <input type="file" class="bg-black form-control" >
                                                <label class="input-group-text bg-success" for="">View</label>
                                                <label class="input-group-text bg-warning" for="">Upload</label>
                                            </div>
                                        </div>
                                        @endforeach

                                    </form>
                                </div>
                            </div>
                            <div class="text-start">
                                {{-- <button type="button" class="px-4 btn btn-primary">Save Changes</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--end row-->
    @push('styles')
        <style>
            .timeline{
            counter-reset: test 22;
            position: relative;
            }

            .timeline li{
            list-style: none;
            float: left;
            width: 33.3333%;
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

</x-app-layout>
