<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('components.style')
    <title>{{ $title }}</title>
</head>

<body class="bg-soft-blue">
    @include('components.navbar')
    <section class="container py-3">
        @include('components.toast')
        @yield('content')
        @include('components.footer')
    </section>

    @include('components.script')
</body>

</html>
