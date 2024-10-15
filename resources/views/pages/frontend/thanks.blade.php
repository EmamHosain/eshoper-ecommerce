<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h2>Thank You for Your Order!</h2>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Your Order is Confirmed</h4>
                        <p class="card-text">
                            We appreciate your business! Your order has been successfully placed.
                        </p>
                        <p class="card-text">
                            <strong>Order ID:</strong> {{ $order_code }}
                        </p>
                        <p class="card-text">
                            A confirmation email has been sent to your registered email address with all the details of
                            your order.
                        </p>
                        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Continue Shopping</a>
                    </div>
                    <div class="card-footer text-muted">
                        If you have any questions, feel free to <a href="{{ url('/') }}">contact us</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>