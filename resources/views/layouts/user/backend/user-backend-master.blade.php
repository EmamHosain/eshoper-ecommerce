<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SeoDash Free Bootstrap Admin Template by Adminmart</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/user-backend/images/logos/seodashlogo.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/user-backend/css/styles.min.css') }}" />
    
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">


        {{-- sidebar here --}}
        @include('layouts.user.backend.dashboard.sidebar')



        {{-- main content here --}}
        @yield('content')



        <script src="{{ asset('assets/user-backend/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/user-backend/libs/bootstrap/dist/js/bootstrap.bundle.js') }}"></script>

        {{-- <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script> --}}

        <script src="{{ asset('assets/user-backend/libs/simplebar/dist/simplebar.js') }}"></script>
        <script src="{{ asset('assets/user-backend/js/sidebarmenu.js') }}"></script>
        <script src="{{ asset('assets/user-backend/js/app.min.js') }}"></script>
        <script src="{{ asset('assets/user-backend/js/dashboard.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>