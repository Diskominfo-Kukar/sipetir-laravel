<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Portal SiPETIR - UKPBJ Kab. Kukar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/portal.css') }}" />

    <style>
        body {
            background-image: url('{{ asset('images/tenggarong.jpg') }}') !important;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }
    </style>
</head>

<body>
    <!-- Main container -->
    <div class="container">
        <div class="header-content">
            <div class="logo-wrapper">
                <img class="main-logo" src="{{ asset('images/kukar-logo.png') }}" alt="logo-kukarkab" />
                <img class="main-logo" style="width: 250px; height: auto;" src="{{ asset('images/ukpbj-only.png') }}"
                    alt="logo-ukpbj" />
            </div>

            <div class="title-wrapper">
                <p class="intro-text">
                    Portal Resmi <br />
                    Sistem Informasi Pengadaan Terintegrasi (SIPETIR)
                </p>
                <p class="intro-sub-text">Bagian Pengadaan Barang dan Jasa, Kabupaten Kutai Kartanegara, Kalimantan
                    Timur</p>
            </div>
        </div>
        <!-- main content -->
        <div class="main-content">
            <div class="main-content-wrapper">
                <a class="menu-item-wrapper" href="{{ route('login') }}" target="__blank">
                    <img class="menu-logo" src="{{ asset('images/sipetir.png') }}" alt="" />
                    <p class="menu-title fw-bold">Login SIPETIR</p>
                </a>
            </div>
        </div>
        <!-- /main content -->

        <!-- footer -->
        <div class="footer-content">
            <p>
                © 2024 Unit Kerja Pengadaan Barang dan Jasa - Dikembangkan oleh
                Diskominfo Kukar
            </p>
        </div>
        <!-- /footer -->

        <!-- bacround-bottom-wrapper -->
        <div class="backround-bottom-wrapper">
            <div class="bg-image-wrapper">
            </div>
        </div>
    </div>
    <!-- /Main container -->
    <!-- /bacround-bottom-wrapper -->

    <!-- portal js -->
    <script src="{{ asset('js/portal.js') }}"></script>
</body>

</html>
