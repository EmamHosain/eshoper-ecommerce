<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper - @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">



    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"> </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.js') }}"> </script> bootstrap version
    problem --}}


    {{-- sweet alert --}}
    <link rel="stylesheet" href="{{ asset('assets/sweet-alert/sweetalert2.min.css') }}">
    <script type="text/javascript" src="{{ asset('assets/sweet-alert/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/sweet-alert/custom.sweetalert.js') }}"></script>


    {{-- another confirm dialouge for response --}}
    <script type="text/javascript" src="{{ asset('assets/sweetalert2@10/sweetalert2@10.js') }}"></script>

</head>
<body>


    @yield('header')




    @yield('content')





    @include('pages.frontend.component.footer')
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"> </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.js') }}"> </script> bootstrap version
    problem --}}

    {{-- <script src="lib/easing/easing.min.js"></script> --}}
    <script type="text/javascript" src="{{ asset('assets/easing/easing.min.js') }}"></script>

    {{-- <script src="lib/owlcarousel/owl.carousel.min.js"></script> --}}
    <script type="text/javascript" src="{{ asset('assets/owlcarousel/owl.carousel.min.js') }}"></script>


    <!-- Contact Javascript File -->
    <script type="text/javascript" src="{{ asset('assets/eshoper/mail/jqBootstrapValidation.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/eshoper/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script type="text/javascript" src="{{ asset('assets/js/template.js') }}"></script>
</body>

</html>