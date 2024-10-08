<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Admin - @yield('title')</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous">
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css"
        integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous">
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/adminLte/css/adminlte.css') }}">

    <!--end::Required Plugin(AdminLTE)-->
    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/adminLte/js/adminlte.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>



    {{-- summernote text editor --}}
    <link rel="stylesheet" href="{{ asset('assets/summernote-0.9.0-dist/summernote-bs5.css') }}">
    <script type="text/javascript" src="{{ asset('assets/summernote-0.9.0-dist/summernote-bs5.js') }}"></script>

    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    {{-- datatable --}}
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <script type="text/javascript" src="{{ asset('assets/js/datatables.min.js') }}"></script>

    {{-- sweet alert --}}
    <link rel="stylesheet" href="{{ asset('assets/sweet-alert/sweetalert2.min.css') }}">
    <script type="text/javascript" src="{{ asset('assets/sweet-alert/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/sweet-alert/custom.sweetalert.js') }}"></script>


    {{-- custom js --}}
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>

</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">


        {{-- hosain nav here --}}
        @include('layouts.admin.dashboard.header')


        {{-- hossain sidebar here --}}
        @include('layouts.admin.dashboard.sidebar')


        <!--begin::App Main-->
        @yield('content')
        <!--end::App Main-->


        {{-- hossain footer here --}}
        @include('layouts.admin.dashboard.footer')


    </div>




</body>
<!--end::Body-->
</html>