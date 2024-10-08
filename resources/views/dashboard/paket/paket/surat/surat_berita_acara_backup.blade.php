<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Berita Acara</title>
    <style>
        @page {
            margin: 0px;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .margin-page-body {
            border: 1px solid black;
        }

        body {
            margin: 1cm 2cm 2cm 2cm;
            padding: 0;
            font-size: 11pt;
            font-family: 'Arial', sans-serif;
        }

        .tanggal-loc {
            position: absolute;
            bottom: 5cm;
            right: 3cm;
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .table-head td {
            padding: 4px;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .capital {
            text-transform: uppercase;
        }

        h3 {
            font-size: 14pt;
        }

        hr.double {
            border-top: 3px double #000;
        }

        .mb-1 {
            margin-bottom: 1cm;
        }

        .mb-half {
            margin-bottom: .5cm;
        }

        .ml-half {
            margin-left: .5cm;
        }

        .mt-1 {
            margin-top: 1cm;
        }

        .body {
            margin-top: 1cm;
        }

        .table-content td {
            padding: 5px;
        }

        .text-capital {
            text-transform: capitalize;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 1cm;
            right: 1cm;
            height: 70px;
            color: rgb(120, 120, 120);
            text-align: left;
            font-size: 10pt;
        }

        .barcode {
            width: 110px;
            height: 110px;
        }

        .keterangan-tte {
            border: 2px solid #000;
            width: auto;
            height: 107px;
            font-size: 10pt;
        }

        address {
            font-size: 8pt;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .address-normal {
            font-style: normal;
        }

        .table-border,
        .table-border th,
        .table-border td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table-clear,
        .table-clear td {
            border: none;
            border-collapse: collapse;
        }
    </style>
</head>

<body>

    <table width="100%" class="table-head">
        <tr>
            <td width="10%">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(base_path('public/img/logo.png'))) }}"
                    width="80" alt="">
            </td>
            <td width="100%" class="text-center">
                <h3 class="capital">PEMERINTAH KABUPATEN KUTAI KARTANEGARA</h3>
                <h1 class="capital">SEKRETARIAT DAERAH</h1>
                <address>Jalan Wolter Monginsidi Nomor : 01 Telp. (0541)2090020-28 Fax (0541)2090029 </address>
                <address class="address-normal">Website : http://humas.kutaikartanegarakab.go.id E.Mail:
                    setda@kutaikartanegarakab.go.id Tenggarong 75511</address>
            </td>
        </tr>
    </table>
    <hr class="double" />

    <div class="body">
        <p class="text-center">
            <strong>BERITA ACARA REVIU DOKUMEN PERSIAPAN PENGADAAN<br>
                DAN KERTAS KERJA PERSIAPAN PEMILIHAN<br>
                <u>TAHUN ANGGARAN {{ date('Y', strtotime($tanggal)) }}</u>
            </strong><br>
            Nomor: 323/ST-POKMIL/BPBJ/{{ $tglkop }}
        </p>&nbsp;

        {!! $berita_acara->intro !!}

        <table style="border-collapse: collapse; width: 100%;">

            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">Nama PPK</td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%;"><b>{{ $paket->ppk->nama }}</b>
                </td>
            </tr>
            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">SKPD/OPD</td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%; ">-
                    </td>
            </tr>
            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">No. SK</td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%;">
                    {{ $paket->ppk->panitia->no_sk }}</td>
            </tr>

            <tr>
                <td style="padding: 10px 8px 0 8px; vertical-align: top; width: 100%;" colspan="3">Telah
                    mengadakan Reviu Dokumen Persiapan Pengadaan untuk :
                </td>
            </tr>
            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">Nama Paket Pengadaan</td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%;">
                    <b>{{ $berita_acara->nama_paket }} </b>
                </td>
            </tr>
            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">Lokasi Pekerjaan
                </td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%;">{{ $berita_acara->lokasi }}</td>
            </tr>
            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">Waktu Pelaksanaan</td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%;">{{ $berita_acara->waktu }} Hari Kalender</td>
            </tr>
            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">Uraian Pekerjaan</td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%;">{{ $berita_acara->uraian }}</td>
            </tr>
            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">Sumber Dana</td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%;">{{ $berita_acara->sumber_dana }}</td>
            </tr>
            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">Nilai Pagu Anggaran</td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%;">Rp. {{ $berita_acara->pagu }},-</td>
            </tr>
            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">Nilai HPS</td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%;">Rp. {{ $berita_acara->hps }},-</td>
            </tr>
        </table>&nbsp;

        {!! $berita_acara->outro !!}

        <p style="padding:16px 8px;" class="text-center">
            <strong>PEJABAT PEMBUAT KOMITMEN
                <br>{{ $berita_acara->nama_paket }}
                <br>-
            </strong>
        </p>

        <p style="padding:70px 8px;" class="text-center">
            <strong><u>{{ $paket->ppk->nama }}</u></strong>
            <br>NIP. {{ $paket->ppk->panitia->nip }}
        </p>

    </div>

    <footer>
        <table width="100%">
            <tr>
                <td width="15%">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(base_path('public/img/logo-bsre.png'))) }}"
                        width="100" alt="">
                </td>
                <td>
                    Dokumen Ini Ditandatangani Secara Elektronik Menggunakan Sertifikat Elektronik Yang
                    Diterbitkan
                    Oleh Balai Sertifikasi Elektronik (BSRE), Badan Siber dan Sandi Negara (BSSN)
                </td>
            </tr>
        </table>
    </footer>
</body>
{{-- page 2 --}}

<body>
    <div class="body">
        {{-- bagian 1 --}}
        <div>
            <p style="padding: 8px; text-align: center;"><b>BAGIAN KESATU</b></p>

            {{-- sub bagian 1 --}}
            <div>
                {{-- 1.A --}}
                <div style="padding: 8px;">
                    <li type="A" value="1" style="padding: 0 8px; font-weight: bold;">
                        Reviu Spesifikasi Teknis
                    </li>
                    <div>
                        <p style="padding: 0 8px;"><i>Spesifikasi teknis untuk pengadaan Pekerjaan Konstruksi
                                meliputi:</i>
                        </p>
                        <!--img style="padding: 8px;"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(base_path('public/img/logo.png'))) }}"
                            width="80" alt=""-->

                        <p style="padding: 8px; text-align: justify;">Peraturan LKPP No. 12 Tahun 2021 tentang Pedoman
                            Pelaksanaan Pengadaan Barang/Jasa Pemerintah Melalui Penyedia</p>

                        <table class="table-border" style="width:100%">
                            <tr>
                                <th style="width: 6%">No.</th>
                                <th style="width: 42%">Uraian / Pertanyaan</th>
                                <th style="width: 42%">Catatan / Pembahasan</th>
                            </tr>

                            <tr>
                                <td style="vertical-align: top;" class="text-center"><b>1</b></td>
                                <td style="padding:0 8px;"><b>Ruang lingkup Pekerjaan Konstruksi yang dibutuhkan</b>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">a. </td>
                                        <td style="width: 95% ">Apakah spesifikasi sudah memuat ruang lingkup Pekerjaan
                                            Konstruksi yang
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;">Spesilikasi <b>sudah</b>
                                    memuat
                                    ruang lingkup Pekerjaan.</td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">b. </td>
                                        <td style="width: 95% ">Di bagian dokumen apa dimuat ruang lingkup Pekerjaan
                                            Konstruksi yang dibutuhkan?
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b>Sudah,</b> terdapat di
                                    Bagian
                                    metode pelaksanaan pada dokumen spesifikasi teknis yang telah dibuat oleh PPK</td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">c. </td>
                                        <td style="width: 95% ">Apakah sudah mencamtumkan kriteria kinerja produk
                                            <i>(output performance)</i> yang diinginkan?
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b>Sudah</td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">d. </td>
                                        <td style="width: 95% ">Apakah sudah mencamtumkan tata cara pengukuran dan tata
                                            cara pembayaran?
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b>Sudah</td>
                            </tr>

                        </table>
                    </div>

                    <div>
                        <p style="padding:16px 8px 8px 8px;"><b>Reviu klarifikasi tambahan dari Pokja Pemilihan terkalt
                                Spesifikasi
                                Teknis</b></p>

                        <table class="table-border" style="width:100%">
                            <tr>
                                <th style="width: 6%">No.</th>
                                <th style="width: 42%">Uraian / Pertanyaan</th>
                                <th style="width: 42%">Catatan / Pembahasan</th>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center">1</td>
                                <td></td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b></td>
                            </tr>
                            <tr>
                                <td style="width: 6% " class="text-center">2</td>
                                <td></td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b></td>
                            </tr>

                        </table>
                    </div>

                    <div>
                        <p style="padding:16px 8px 8px 8px;"><b>Rekomendasi / Catatan Hasil Reviu:</b></p>

                        <div class="table-border" style="width:100%; height:50px"></div>
                    </div>

                </div>
                {{-- /end 1.A --}}

                {{-- 1.B --}}
                <div style="padding: 8px;">
                    <li type="A" value="2" style="padding: 0 8px; font-weight: bold;">
                        Reviu Harga Perkiraan Sendiri (HPS)
                    </li>
                    <div>
                        <table class="table-border" style="width:100%">
                            <tr>
                                <th style="width: 6%">No.</th>
                                <th style="width: 42%">Uraian / Pertanyaan</th>
                                <th style="width: 42%">Catatan / Pembahasan</th>
                            </tr>

                            <tr>
                                <td style="vertical-align: top;" class="text-center"><b>1</b></td>
                                <td style="padding:0 8px;"><b>Ruang lingkup Pekerjaan Konstruksi yang dibutuhkan</b>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">a. </td>
                                        <td style="width: 95% ">Apakah spesifikasi sudah memuat ruang lingkup Pekerjaan
                                            Konstruksi yang
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;">Spesilikasi <b>sudah</b>
                                    memuat
                                    ruang lingkup Pekerjaan.</td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">b. </td>
                                        <td style="width: 95% ">Di bagian dokumen apa dimuat ruang lingkup Pekerjaan
                                            Konstruksi yang dibutuhkan?
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b>Sudah,</b> terdapat di
                                    Bagian
                                    metode pelaksanaan pada dokumen spesifikasi teknis yang telah dibuat oleh PPK</td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">c. </td>
                                        <td style="width: 95% ">Apakah sudah mencamtumkan kriteria kinerja produk
                                            <i>(output performance)</i> yang diinginkan?
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b>Sudah</td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">d. </td>
                                        <td style="width: 95% ">Apakah sudah mencamtumkan tata cara pengukuran dan tata
                                            cara pembayaran?
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b>Sudah</td>
                            </tr>

                        </table>
                    </div>

                    <div>
                        <p style="padding:16px 8px 8px 8px;"><b>Reviu klarifikasi tambahan dari Pokja Pemilihan terkalt
                                Spesifikasi
                                Teknis</b></p>

                        <table class="table-border" style="width:100%">
                            <tr>
                                <th style="width: 6%">No.</th>
                                <th style="width: 42%">Uraian / Pertanyaan</th>
                                <th style="width: 42%">Catatan / Pembahasan</th>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center">1</td>
                                <td></td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b></td>
                            </tr>
                            <tr>
                                <td style="width: 6% " class="text-center">2</td>
                                <td></td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b></td>
                            </tr>

                        </table>
                    </div>

                    <div>
                        <p style="padding:16px 8px 8px 8px;"><b>Rekomendasi / Catatan Hasil Reviu:</b></p>

                        <div class="table-border" style="width:100%; height:50px"></div>
                    </div>

                </div>
                {{-- /end 1.B --}}

                {{-- 1.C --}}
                <div style="padding: 8px;">
                    <li type="A" value="3" style="padding: 0 8px; font-weight: bold;">
                        Reviu Rancangan Kontrak / Perjanjian
                    </li>

                    <div style="padding: 8px;">
                        <p><i>Reviu Rancangan Kontrak untuk memastikan bahwa draft kontrak telah sesuai dengan ruang
                                lingkup pekerjaan. Reviu rancangan kontrak memperhatikan:
                                <br>
                                1) Naskah Perjanjian;
                                <br>
                                2) Syarat-syarat Umum Kontrak;
                            </i>
                        </p>
                    </div>

                    <div style="padding: 8px 0;">
                        <table class="table-border" style="width:100%">
                            <tr>
                                <th class="text-center" style="border: 1px solid width: 6%">No.</th>
                                <th style="width: 42%">Uraian / Pertanyaan</th>
                                <th style="width: 42%">Catatan / Pembahasan</th>
                            </tr>

                            <tr>
                                <td style="vertical-align: top;" class="text-center"><b>1</b></td>
                                <td style="padding:0 8px;"><b>Ruang lingkup Pekerjaan Konstruksi yang dibutuhkan</b>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">a. </td>
                                        <td style="width: 95% ">Apakah spesifikasi sudah memuat ruang lingkup Pekerjaan
                                            Konstruksi yang
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;">Spesilikasi <b>sudah</b>
                                    memuat
                                    ruang lingkup Pekerjaan.</td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">b. </td>
                                        <td style="width: 95% ">Di bagian dokumen apa dimuat ruang lingkup Pekerjaan
                                            Konstruksi yang dibutuhkan?
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b>Sudah,</b> terdapat di
                                    Bagian
                                    metode pelaksanaan pada dokumen spesifikasi teknis yang telah dibuat oleh PPK</td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">c. </td>
                                        <td style="width: 95% ">Apakah sudah mencamtumkan kriteria kinerja produk
                                            <i>(output performance)</i> yang diinginkan?
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b>Sudah</td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">d. </td>
                                        <td style="width: 95% ">Apakah sudah mencamtumkan tata cara pengukuran dan tata
                                            cara pembayaran?
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b>Sudah</td>
                            </tr>

                        </table>
                    </div>

                    <div>
                        <p style="padding:16px 8px 8px 8px;"><b>Reviu klarifikasi tambahan dari Pokja Pemilihan terkalt
                                Spesifikasi
                                Teknis</b></p>

                        <table class="table-border" style="width:100%">
                            <tr>
                                <th style="width: 6%">No.</th>
                                <th style="width: 42%">Uraian / Pertanyaan</th>
                                <th style="width: 42%">Catatan / Pembahasan</th>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center">1</td>
                                <td></td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b></td>
                            </tr>
                            <tr>
                                <td style="width: 6% " class="text-center">2</td>
                                <td></td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b></td>
                            </tr>

                        </table>
                    </div>

                    <div>
                        <p style="padding:16px 8px 8px 8px;"><b>Rekomendasi / Catatan Hasil Reviu:</b></p>

                        <div class="table-border" style="width:100%; height:50px"></div>
                    </div>

                </div>
                {{-- /end 1.C --}}

                {{-- 1.I --}}
                <div style="padding: 8px;">
                    <li type="A" value="9" style="padding: 0 8px; font-weight: bold;">
                        Masukan/Usulan Pejabat Pembuat Komitmen terkait persyaratan penyedia
                    </li>

                    <div style="padding: 8px 0;">
                        <table style="width:100%;">
                            <tr>
                                <td style="vertical-align: top; width:4%;"><b>1)</b></td>
                                <td style="">
                                    <b>Persyaratan Kualifikasi</b><br>
                                    Kualifikasi Administrasi
                                </td>
                            </tr>
                        </table>
                        <table class="table-border" style="width:100%">
                            <tr>
                                <th style="width: 33%">Usulan persyaratan</th>
                                <th style="width: 33%">Alasan PPK</th>
                                <th style="width: 33%">Tanggapan Pokja</th>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                <td style="padding:0 8px">Setuju/tidak setuju</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="height: 18px"></td>
                            </tr>
                        </table>
                    </div>

                    <div style="padding: 8px 0;">
                        <table style="width:100%;">
                            <tr>
                                <td style="vertical-align: top; width:4%;"><b>2)</b></td>
                                <td style="">
                                    <b>Persyaratan Teknis</b>
                                </td>
                            </tr>
                        </table>
                        <table class="table-border" style="width:100%">
                            <tr>
                                <th style="width: 33%">Usulan persyaratan</th>
                                <th style="width: 33%">Alasan PPK</th>
                                <th style="width: 33%">Tanggapan Pokja</th>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                <td style="padding:0 8px">Setuju/tidak setuju</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="height: 18px"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                {{-- /end 1.I --}}

            </div>
            {{-- /end sub bagian 1 --}}
        </div>
        {{-- /end bagian 1 --}}

        {{-- bagian 1 --}}
        <div>
            <p style="padding: 8px; text-align: center;"><b>BAGIAN KEDUA</b></p>

            {{-- sub bagian 2 --}}
            <div>
                <div style="padding: 4px;">
                    <table>
                        <tr>
                            <td style="padding: 0 8px; vertical-align: top; width: 100%;" colspan="4">
                                Telah
                                mengadakan Reviu Dokumen Persiapan Pengadaan untuk :
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0 8px; vertical-align: top; width: 2%">1. </td>
                            <td style="padding: 0 8px; vertical-align: top; width: 33%;">Hari / Tanggal
                            </td>
                            <td style="padding: 0 8px; vertical-align: top; width: 5%;">:</td>
                            <td style="padding: 0 8px; vertical-align: top; width: 75%;">
                                <b>REKONSTRUKSI JALAN DESA DESA BATU - BATU - DESA SALO CELLA ( BANKEU )</b>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 0 8px; vertical-align: top; width: 2%">2. </td>
                            <td style="padding: 0 8px; vertical-align: top; width: 33%;">Tempat
                            </td>
                            <td style="padding: 0 8px; vertical-align: top; width: 5%;">:</td>
                            <td style="padding: 0 8px; vertical-align: top; width: 75%;">
                                Sekertariat Daerah Kab Kutai, Kartanegara, Bagian Pengadaan Barang dan Jasa Gedung F
                            </td>
                        </tr>

                    </table>
                </div>

                {{-- 2.A --}}
                <div style="padding: 8px;">

                    <li type="A" value="1" style="padding: 0 8px; font-weight: bold;">
                        Reviu Spesifikasi Teknis
                    </li>
                    <div>
                        <p style="padding: 0 8px;">Spesifikasi teknis untuk pengadaan Pekerjaan Konstruksi
                            meliputi:
                        </p>

                        <table class="table-border" style="width:100%">
                            <tr>
                                <th style="width: 6%">No.</th>
                                <th style="width: 42%">Uraian / Pertanyaan</th>
                                <th style="width: 42%">Catatan / Pembahasan</th>
                            </tr>

                            <tr>
                                <td style="vertical-align: top;" class="text-center"><b>1</b></td>
                                <td style="padding:0 8px;"><b>Ruang lingkup Pekerjaan Konstruksi yang dibutuhkan</b>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">a. </td>
                                        <td style="width: 95% ">Apakah spesifikasi sudah memuat ruang lingkup Pekerjaan
                                            Konstruksi yang
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;">Spesilikasi <b>sudah</b>
                                    memuat
                                    ruang lingkup Pekerjaan.</td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">b. </td>
                                        <td style="width: 95% ">Di bagian dokumen apa dimuat ruang lingkup Pekerjaan
                                            Konstruksi yang dibutuhkan?
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b>Sudah,</b> terdapat di
                                    Bagian
                                    metode pelaksanaan pada dokumen spesifikasi teknis yang telah dibuat oleh PPK</td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">c. </td>
                                        <td style="width: 95% ">Apakah sudah mencamtumkan kriteria kinerja produk
                                            <i>(output performance)</i> yang diinginkan?
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b>Sudah</td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">d. </td>
                                        <td style="width: 95% ">Apakah sudah mencamtumkan tata cara pengukuran dan tata
                                            cara pembayaran?
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b>Sudah</td>
                            </tr>

                        </table>
                    </div>

                    <div>
                        <p style="padding:16px 8px 8px 8px;"><b>Reviu klarifikasi tambahan dari Pokja Pemilihan terkalt
                                Spesifikasi
                                Teknis</b></p>

                        <table class="table-border" style="width:100%">
                            <tr>
                                <th style="width: 6%">No.</th>
                                <th style="width: 42%">Uraian / Pertanyaan</th>
                                <th style="width: 42%">Catatan / Pembahasan</th>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center">1</td>
                                <td></td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b></td>
                            </tr>
                            <tr>
                                <td style="width: 6% " class="text-center">2</td>
                                <td></td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b></td>
                            </tr>

                        </table>
                    </div>

                    <div>
                        <p style="padding:16px 8px 8px 8px;"><b>Rekomendasi / Catatan Hasil Reviu:</b></p>

                        <div class="table-border" style="width:100%; height:50px"></div>
                    </div>

                </div>
                {{-- /end 2.A --}}

                {{-- 2.C --}}
                <div style="padding: 8px;">

                    <li type="A" value="3" style="padding: 0 8px; font-weight: bold;">
                        Reviu Spesifikasi Teknis
                    </li>
                    <div>
                        <p style="padding: 0 8px;">Spesifikasi teknis untuk pengadaan Pekerjaan Konstruksi
                            meliputi:
                        </p>

                        <table class="table-border" style="width:100%">
                            <tr>
                                <th style="width: 6%">No.</th>
                                <th style="width: 42%">Uraian / Pertanyaan</th>
                                <th style="width: 42%">Catatan / Pembahasan</th>
                            </tr>

                            <tr>
                                <td style="vertical-align: top;" class="text-center"><b>1</b></td>
                                <td style="padding:0 8px;"><b>Ruang lingkup Pekerjaan Konstruksi yang dibutuhkan</b>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">a. </td>
                                        <td style="width: 95% ">Apakah spesifikasi sudah memuat ruang lingkup Pekerjaan
                                            Konstruksi yang
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;">Spesilikasi <b>sudah</b>
                                    memuat
                                    ruang lingkup Pekerjaan.</td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">b. </td>
                                        <td style="width: 95% ">Di bagian dokumen apa dimuat ruang lingkup Pekerjaan
                                            Konstruksi yang dibutuhkan?
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b>Sudah,</b> terdapat di
                                    Bagian
                                    metode pelaksanaan pada dokumen spesifikasi teknis yang telah dibuat oleh PPK</td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">c. </td>
                                        <td style="width: 95% ">Apakah sudah mencamtumkan kriteria kinerja produk
                                            <i>(output performance)</i> yang diinginkan?
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b>Sudah</td>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center"></td>
                                <td>
                                    <table class="table-clear">
                                        <td style="padding:0 8px; width: 5%">d. </td>
                                        <td style="width: 95% ">Apakah sudah mencamtumkan tata cara pengukuran dan tata
                                            cara pembayaran?
                                        </td>
                                    </table>
                                </td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b>Sudah</td>
                            </tr>

                        </table>
                    </div>

                    <div>
                        <p style="padding:16px 8px 8px 8px;"><b>Reviu klarifikasi tambahan dari Pokja Pemilihan terkalt
                                Spesifikasi
                                Teknis</b></p>

                        <table class="table-border" style="width:100%">
                            <tr>
                                <th style="width: 6%">No.</th>
                                <th style="width: 42%">Uraian / Pertanyaan</th>
                                <th style="width: 42%">Catatan / Pembahasan</th>
                            </tr>

                            <tr>
                                <td style="width: 6% " class="text-center">1</td>
                                <td></td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b></td>
                            </tr>
                            <tr>
                                <td style="width: 6% " class="text-center">2</td>
                                <td></td>
                                <td style="padding:0 8px; vertical-align: top; width: 42%;"><b></td>
                            </tr>

                        </table>
                    </div>

                    <div>
                        <p style="padding:16px 8px 8px 8px;"><b>Rekomendasi / Catatan Hasil Reviu:</b></p>

                        <div class="table-border" style="width:100%; height:50px"></div>
                    </div>

                </div>
                {{-- /end 2.A --}}

            </div>
            {{-- /end sub bagian 2 --}}
        </div>
        {{-- /end bagian 1 --}}

    </div>

    <footer>
        <table width="100%">
            <tr>
                <td width="15%">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(base_path('public/img/logo-bsre.png'))) }}"
                        width="100" alt="">
                </td>
                <td>
                    Dokumen Ini Ditandatangani Secara Elektronik Menggunakan Sertifikat Elektronik Yang Diterbitkan
                    Oleh Balai Sertifikasi Elektronik (BSRE), Badan Siber dan Sandi Negara (BSSN)
                </td>
            </tr>
        </table>
    </footer>
</body>

</html>
