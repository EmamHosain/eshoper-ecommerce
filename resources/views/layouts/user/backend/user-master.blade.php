<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color: #007bff;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #0056b3;
            text-decoration: none;
        }

        .sidebar a.active {
            background-color: #0056b3;
        }

        .profile-photo {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .dashboard-header {
            padding: 20px 0;
        }

        .dashboard-widget {
            text-align: center;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .widget-icon {
            font-size: 30px;
            color: #007bff;
            margin-bottom: 10px;
        }

        .card img {
            max-width: 100%;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .sidebar {
                height: auto;
            }
        }
    </style>
</head>
<body>

    <div class=" container-fluid" style="background-color: gray">
        <div class=" container px-0 d-flex justify-content-between align-items-center" >
            <img src="{{ asset('assets/empty-image-300x240.jpg') }}" width="100" height="100" alt="">
            <div class="btn-group">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    data-bs-auto-close="true" aria-expanded="false">
                    Default dropdown
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Menu item</a></li>
                    <li><a class="dropdown-item" href="#">Menu item</a></li>
                    <li><a class="dropdown-item" href="#">Menu item</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            @include('layouts.user.backend.component.sidebar')

            <!-- Main Content -->
            <main class="col-md-9 col-lg-10">

                @yield('content')

            </main>
        </div>
    </div>


</body>
</html>