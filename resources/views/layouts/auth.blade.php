<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('components.style')
    <title>{{ $title }}</title>
</head>

<body class="bg-soft-blue">
    <div class="d-flex justify-content-end">
        @include('components.toast')
    </div>
    <div class="px-0 mx-0 d-flex justify-content-center w-100">
        @yield('content')
    </div>
    <script src="{{ url('/assets/js/script.js') }}"></script>
    @include('components.script')
</body>

</html>
