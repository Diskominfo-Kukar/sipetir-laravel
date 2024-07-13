<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Surat Tugas</title>
  <style>
    @page { margin: 0px; }
    *{
      margin: 0;
      padding: 0;
    }
    body{
      margin: 1cm 2cm 2cm 2cm;
      padding: 0;
      font-size: 11pt;
      font-family: 'Arial', sans-serif;
    }
    .tanggal-loc {
      position: absolute;
      bottom: 4.5cm;
      right: 3cm;
      text-align: right;
    }
    .text-left{
      text-align: left;
    }
    .table-head td{
      padding: 4px;
    }
    .text-center{
      text-align: center;
    }
    .text-left{
      text-align: left;
    }
    .text-right{
      text-align: right;
    }
    .capital{
      text-transform: uppercase;
    }
    h3{
      font-size: 14pt;
    }
    hr.double {
      border-top: 3px double #000;
    }
    .mb-1{
      margin-bottom: 1cm;
    }
    .mb-half{
      margin-bottom: .5cm;
    }
    .ml-half{
      margin-left: .5cm;
    }
    .mt-1{
      margin-top: 1cm;
    }
    .body{
      margin-top: 1cm;
    }
    .table-content td {
      padding: 5px;
    }
    .text-capital{
      text-transform: capitalize;
    }
    footer {
      position: fixed;
      bottom:0;
      left: 1cm;
      right: 1cm;
      height: 70px;
      color: rgb(120, 120, 120);
      text-align: left;
      font-size: 10pt;
    }
    .barcode{
      width: 110px;
      height: 110px;
    }
    .keterangan-tte{
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
  </style>
</head>
<body>
  <table width="100%" class="table-head">
    <tr>
      <td width="10%">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(base_path('public/img/logo.png'))) }}" width="80" alt="">
      </td>
      <td width="100%" class="text-center">
        <h3 class="capital">PEMERINTAH KABUPATEN KUTAI KARTANEGARA</h3>
        <h1 class="capital">SEKRETARIAT DAERAH</h1>
        <address>Jalan Wolter Monginsidi Nomor : 01 Telp. (0541)2090020-28 Fax (0541)2090029 </address>
        <address class="address-normal">Website : http://humas.kutaikartanegarakab.go.id E.Mail: setda@kutaikartanegarakab.go.id Tenggarong 75511</address>
    </td>
    </tr>
  </table>
  <hr class="double" />

  <div class="body">
    <p class="text-center">
      <strong>SURAT TUGAS KELOMPOK PEMILIHAN (POKMIL)</strong><br>
      NOMOR : 323/ST-POKMIL/BPBJ/{{ $tglkop }}
    </p>&nbsp;
  <table style="border-collapse: collapse; width: 100%;">
    <tr>
      <td style="padding: 8px; vertical-align: top;">Dasar</td>
      <td style="padding: 8px; vertical-align: top;">:</td>
      <td style="padding: 8px; vertical-align: top;">1</td>
      <td style="padding: 8px; text-align: justify;">Peraturan Daerah Nomor 9 Tahun 2016 tentang Pembentukan dan Susunan Perangkat Daerah Kabupaten Kutai Kartanegara;</td>
    </tr>
    <tr>
      <td></td>
      <td style="padding: 8px; vertical-align: top;"></td>
      <td style="padding: 8px; vertical-align: top;">2</td>
      <td style="padding: 8px; text-align: justify;">Peraturan Bupati Nomor 2 Tahun 2019 tentang Kedudukan Susunan Organisasi, Tugas dan Fungsi serta Tata Kerja Perangkat Daerah pada Sekretariat Daerah;</td>
    </tr>
    <tr>
      <td></td>
      <td style="padding: 8px; vertical-align: top;"></td>
      <td style="padding: 8px; vertical-align: top;">3</td>
      <td style="padding: 8px; text-align: justify;">Berdasarkan Keputusan Kepala Bagian Pengadaan Barang/Jasa Nomor : P-243/PPBJ/BPBJ/SK-POKMIL/04/2024 Perubahan atas keputusan Kepala Bagian Pengadaan Barang/Jasa Nomor : 655/PNA/BPBJ/SK/04/2023 Tentang Penetapan Pejabat Pengelola Pengadaan Barang/Jasa Kedalam Kelompok Kerja Pemilihan Penyedia Barang/Jasa Pada Bagian Pengadaan Barang dan Jasa Sekretariat Daerah Kabupaten Kutai Kartanegara.</td>
    </tr>
  </table>&nbsp;

  <p class="text-center">
    <strong>MENUGASKAN :</strong>
  </p>
<table style="border-collapse: collapse;">
  <tr>
    <td style="padding: 8px; vertical-align: top;">Kepada</td>
    <td style="padding: 8px; vertical-align: top;">:</td>
    <td style="padding: 8px; vertical-align: top;">{{ $paket->pokmil->nama }}</td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td style="padding: 8px;">Dengan Susunan Personil :</td>
  </tr>
  @foreach($panitia as $p)
  <tr>
    <td colspan="2"></td>
    <td style="padding: 0 8px;">{{ $p->nama }}</td>
  </tr>
  @endforeach
</table>&nbsp;&nbsp;


    <p>Untuk melaksanakan proses pengadaan barang/jasa untuk pekerjaan sebagai berikut :</p>&nbsp;&nbsp;
<table style="border-collapse: collapse; width: 100%;">
  <tr>
    <td style="width: 10%;"></td>
    <td style="padding: 0 8px; vertical-align: top; width: 30%;">1. Jenis Pekerjaan</td>
    <td style="padding: 0 8px; vertical-align: top; width: 5%;">:</td>
    <td style="padding: 0 8px; vertical-align: top; width: 55%;">{{ $paket->nama }}</td>
    <td style="padding: 0 8px;"></td>
  </tr>
  <tr>
    <td style="width: 10%;"></td>
    <td style="padding: 0 8px; vertical-align: top; width: 30%;">2. Paket Pekerjaan</td>
    <td style="padding: 0 8px; vertical-align: top; width: 5%;">:</td>
    <td style="padding: 0 8px; vertical-align: top; width: 55%;">Peningkatan Jalan Lingkungan Desa Panca Jaya Kec. Muara Kaman</td>
    <td style="padding: 0 8px;"></td>
  </tr>
  <tr>
    <td style="width: 10%;"></td>
    <td style="padding: 0 8px; vertical-align: top; width: 30%;">3. Nama OPD</td>
    <td style="padding: 0 8px; vertical-align: top; width: 5%;">:</td>
    <td style="padding: 0 8px; vertical-align: top; width: 55%;"></td>
    <td style="padding: 0 8px;"></td>
  </tr>
  <tr>
    <td style="width: 10%;"></td>
    <td style="padding: 0 8px; vertical-align: top; width: 30%;">4. Sumber Dana</td>
    <td style="padding: 0 8px; vertical-align: top; width: 5%;">:</td>
    <td style="padding: 0 8px; vertical-align: top; width: 55%;">APBD</td>
    <td style="padding: 0 8px;"></td>
  </tr>
  <tr>
    <td style="width: 10%;"></td>
    <td style="padding: 0 8px; vertical-align: top; width: 30%;">5. Pagu Dana</td>
    <td style="padding: 0 8px; vertical-align: top; width: 5%;">:</td>
    <td style="padding: 0 8px; vertical-align: top; width: 55%;">Rp {{ $paket->pagu }}</td>
    <td style="padding: 0 8px;"></td>
  </tr>
  <tr>
    <td style="width: 10%;"></td>
    <td style="padding: 0 8px; vertical-align: top; width: 30%;">6. HPS</td>
    <td style="padding: 0 8px; vertical-align: top; width: 5%;">:</td>
    <td style="padding: 0 8px; vertical-align: top; width: 55%;">Rp {{ $paket->hps }}</td>
    <td style="padding: 0 8px;"></td>
  </tr>
  <tr>
    <td style="width: 10%;"></td>
    <td style="padding: 0 8px; vertical-align: top; width: 30%;">7. Nomor DPA</td>
    <td style="padding: 0 8px; vertical-align: top; width: 5%;">:</td>
    <td style="padding: 0 8px; vertical-align: top; width: 55%;">1.04.05.2.01</td>
    <td style="padding: 0 8px;"></td>
  </tr>
  <tr>
    <td style="width: 10%;"></td>
    <td style="padding: 0 8px; vertical-align: top; width: 30%;">8. Tahun Anggaran</td>
    <td style="padding: 0 8px; vertical-align: top; width: 5%;">:</td>
    <td style="padding: 0 8px; vertical-align: top; width: 55%;">{{ $paket->tahun }}</td>
    <td style="padding: 0 8px;"></td>
  </tr>
</table>&nbsp;&nbsp;

    <p class="tanggal-loc">Dikeluarkan di : Tenggarong<br>
    Pada Tanggal : {{ $tanggal }}</p>
  </div>

  <footer>
    <table width="100%">
      <tr>
        <td width="15%">
          <img src="data:image/png;base64,{{ base64_encode(file_get_contents(base_path('public/img/logo-bsre.png'))) }}" width="100" alt="">
        </td>
        <td>
          Dokumen Ini Ditandatangani Secara Elektronik Menggunakan Sertifikat Elektronik Yang Diterbitkan Oleh Balai Sertifikasi Elektronik (BSRE), Badan Siber dan Sandi Negara (BSSN)
        </td>
      </tr>
    </table>
  </footer>
</body>
</html>
