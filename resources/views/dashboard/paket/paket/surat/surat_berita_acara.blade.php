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
                JASA KONSULTAN<br>
                <u>TAHUN ANGGARAN {{ date('Y', strtotime($tanggal)) }}</u>
            </strong><br>
            Nomor: {{ $berita_acara->kode }}/BA.R/25651198/{{ $tglkop }}
        </p>&nbsp;

        {!! $berita_acara->intro !!}

        <table style="border-collapse: collapse; width: 100%;">

            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">Nama Paket Pengadaan</td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%;"><b>{{ $berita_acara->nama_paket }}</b>
                </td>
            </tr>
            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">Satuan Kerja</td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%; ">{{ $berita_acara->satker }}</td>
            </tr>
            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">Tahun Anggaran
                </td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%;">{{ $berita_acara->tahun }}</td>
            </tr>
            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">Lokasi Pekerjaan
                </td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%;">{{ $berita_acara->lokasi }}</td>
            </tr>
            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">Sumber Dana</td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%;">{{ $berita_acara->sumber_dana }}</td>
            </tr>
            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">Nilai Pagu Anggaran</td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%;">Rp. {{ formatRupiah($berita_acara->pagu) }},00 ({{ terbilang($berita_acara->pagu) }} rupiah)</td>
            </tr>
            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">Nilai HPS</td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%;">Rp. {{ formatRupiah($berita_acara->hps) }},00 ({{ terbilang($berita_acara->pagu) }} rupiah)</td>
            </tr>
            <tr>
                <td style="padding: 0 8px; vertical-align: top; width: 35%;">Jenis Pengadaan
                </td>
                <td style="padding: 0 0 0 8px; vertical-align: top; width: 5%;">:</td>
                <td style="padding: 0; vertical-align: top; width: 75%;">{{ $berita_acara->jenis_pekerjaan }}</td>
            </tr>
        </table>&nbsp;

        <p style="margin-top: 10px; margin-left: 10px;">
            Reviu dimulai Pada Pukul {{ $berita_acara->jam_mulai }}. Yang dihadiri Oleh :
        </p>

        <table style="border-collapse: collapse;">
            <tr>
                <td colspan="2" style="padding: 8px; vertical-align: top;">1.</td>
                <td style="padding: 8px; vertical-align: top;">{{ $paket->pokmil->nama }}</td>
            </tr>
            @foreach($panitia as $p)
            <tr>
                <td colspan="2"></td>
                <td style="padding: 0 8px;">- {{ $p->nama }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" style="padding: 8px; vertical-align: top;">2.</td>
                <td style="padding: 8px; vertical-align: top;">Pejabat Pembuat Komitmen Pekerjaan {{ $berita_acara->nama_paket }}
                    <br>Yang diwakili oleh:
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td style="padding: 0 8px;">- {{ $paket->ppk->nama }}</td>
            </tr>
        </table>&nbsp;&nbsp;

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

                @foreach ($kategoris as $kategori)
                    <div style="padding: 8px;">
                        <li type="A" value="{{ $loop->iteration }}" style="padding: 0 8px; font-weight: bold;">
                            {{ $kategori->nama }}&nbsp;<br>&nbsp;
                        </li>
                        <p>
                            {{ $kategori->deskripsi }}
                        </p>
                        <br>&nbsp;
                        <div>
                            <table class="table-border" style="width:100%">
                                <tr>
                                    <th style="width: 6%">No.</th>
                                    <th style="width: 42%">Uraian / Pertanyaan</th>
                                    <th style="width: 42%">Catatan / Pembahasan</th>
                                </tr>

                                @foreach ($kategori->questions as $question)
                                    <tr>
                                        <td style="vertical-align: top;" class="text-center">{{ $loop->iteration }}</td>
                                        <td style="padding:0 8px;">{{ $question->nama }}</td>
                                        <td>
                                            @foreach ($question->answers as $answer)
                                                &nbsp;{{ $answer->review }}
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
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
                            <div class="table-border" style="width:100%; height:50px">
                                @if ($kategori->answerChr->isNotEmpty())
                                    &nbsp;{{ $kategori->answerChr->first()->review }}
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach


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

        <p style="margin-top: 10px; margin-left: 10px; margin-bottom: 10px;">
            Reviu ditutup Pada Pukul {{ $berita_acara->jam_berakhir }}. Dan Berita Acara ini merupakan bagian yang tidak terpisahkan dari Proses Pemilihan
            <br>&nbsp;<br>
            Disusun di : <strong>{{ $berita_acara->lokasi_ba }}</strong> Tanggal: <strong>{{ $tanggal }}</strong>
        </p>

        <table class="table-border" style="width:100%">
            <thead>
                <tr>
                    <th style="padding: 8px; vertical-align: top;">No.</th>
                    <th style="padding: 8px; vertical-align: top;">Nama</th>
                    <th style="padding: 8px; vertical-align: top;">Penugasan/Jabatan</th>
                    <th style="padding: 8px; vertical-align: top;">Tandatangan</th>
                </tr>
            </thead>
            <tbody>
                <tr style="height: 50px;">
                    <td style="padding: 16px; font-size: 16px;">1.</td>
                    <td style="padding: 16px; font-size: 16px;">{{ $paket->ppk->nama }}</td>
                    <td style="padding: 16px; font-size: 16px; vertical-align: top;">PPK</td>
                    <td style="padding: 16px; font-size: 16px; vertical-align: top;">
                        @if (isset($ppk))
                            <img src="{{ asset('storage/'.$ppk->ttd) }}" alt="Tanda Tangan" width="100" height="100">
                        @endif
                    </td>
                </tr>
                @foreach($panitia as $p)
                <tr style="height: 50px;">
                    <td style="padding: 16px; font-size: 16px;">{{ $loop->index + 2 }}.</td>
                    <td style="padding: 16px; font-size: 16px;">{{ $p->nama }}</td>
                    <td style="padding: 16px; font-size: 16px; vertical-align: top;">{{ $paket->pokmil->nama }}</td>
                    <td style="padding: 16px; font-size: 16px; vertical-align: top;">
                        @if ($p->pivot->approve == 1)
                            <img src="{{ asset('storage/'.$p->ttd) }}" alt="Tanda Tangan" width="100" height="100">
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
