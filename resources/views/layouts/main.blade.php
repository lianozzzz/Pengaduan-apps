<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>Pengaduan Masyarakat</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png" />

    <link href="{{ asset('template/assets') }}/vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template/assets') }}/vendor/nouislider/nouislider.min.css">
    <!-- Style css -->
    <link href="{{ asset('template/assets') }}/css/style.css" rel="stylesheet">
    <link href="{{ asset('template/assets') }}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="waviy">
            <span style="--i:1">L</span>
            <span style="--i:2">o</span>
            <span style="--i:3">a</span>
            <span style="--i:4">d</span>
            <span style="--i:5">i</span>
            <span style="--i:6">n</span>
            <span style="--i:7">g</span>
            <span style="--i:8">.</span>
            <span style="--i:9">.</span>
            <span style="--i:10">.</span>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        {{-- logo disini start --}}
        <div class="nav-header">
            <a href="{{ route('dashboard.admin') }}" class="brand-logo">
                <img src="{{ asset('template/assets/logo/logo-polsek.jpg') }}" width="53" class="logo-abbr"
                    alt="">
                <div class="brand-title" width="124px" height="33px">
                    <h6 style="text-align: center; font-weight: bold; text-transform: uppercase; font-size: 18px;">
                        POLSEK BUKIT KAPUR
                    </h6>

                </div>
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        {{-- logo disini end --}}
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Chat box start
        ***********************************-->
        <!--**********************************
            Chat box End
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        @include('layouts.navbar')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('layouts.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        @yield('content')
        <!--**********************************
            Content body end
        ***********************************-->



        <!--**********************************
            Footer start
        ***********************************-->
        @include('layouts.footer')
        <!--**********************************
            Footer end
        ***********************************-->




    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('template/assets') }}/vendor/global/global.min.js"></script>
    <script src="{{ asset('template/assets') }}/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>


    <!-- Dashboard 1 -->
    <script src="{{ asset('template/assets') }}/js/dashboard/dashboard-1.js"></script>

    <script src="{{ asset('template/assets') }}/js/custom.min.js"></script>
    <script src="{{ asset('template/assets') }}/js/dlabnav-init.js"></script>


    <!-- Datatable -->
    <script src="{{ asset('template/assets') }}/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('template/assets') }}/js/plugins-init/datatables.init.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Toastr Message Handler -->
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif
    </script>

</body>

</html>
