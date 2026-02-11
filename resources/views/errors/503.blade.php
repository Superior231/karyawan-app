<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ url('/assets/img/logo.png') }}" type="image/x-icon">
    @include('components.style', ['title' => 'Error 503: Service Unavailable'])
    <style>
        .error-img {
            width: 400px;
        }
        .back:hover span {
            text-decoration: underline !important;
        }
        .message {
            margin-top: -50px;
        }
        @media (max-width: 460px) {
            .error-img {
                width: 300px;
            }
            .message {
                margin-top: 0px;
            }
        }
    </style>
</head>
<body style="background-color: #f1f5fb !important;">
    <div class="gap-1 position-absolute top-50 start-50 translate-middle d-flex flex-column align-items-center justify-content-center">
        <img src="{{ url('assets/img/503.gif') }}" class="error-img" alt="Error gif">
        <div class="message d-flex flex-column">
            <h3 class="text-center fw-bold">Oopss..</h3>
            <span class="mt-2 text-center text-color">This website is currently under maintenance. We will be back soon!</span>
        </div>
    </div>
    @include('components.script')
</body>
</html>
