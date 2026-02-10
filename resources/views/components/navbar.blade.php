<nav class="py-1 navbar sticky-top navbar-expand-lg bg-soft-blue">
    <div class="container">
        <a href="{{ route('home.index') }}" class="navbar-brand logo text-primary">
            <img src="{{ url('assets/img/logo.png') }}" style="width: 40px; height: 40px;" alt="logo">
            {{ config('app.name') }}
        </a>
        <button class="border-0 shadow-none navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="mx-auto navbar-nav" id="navbarNav1">
                <li class="nav-item">
                    <a href="{{ route('home.index') }}" class="nav-link {{ $active == 'home' ? 'active fw-semibold' : '' }} px-4">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center text-dark" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar">
                            @if (!empty(Auth::user()->avatar))
                                <img class="img" src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}">
                            @else
                                <img class="img" src="https://ui-avatars.com/api/?background=random&name={{ urlencode(Auth::user()->name) }}">
                            @endif
                        </div>
                        <span class="nav-text text-dark username-count">&nbsp;{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="mt-2 dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item {{ $active == 'profile' ? 'active fw-semibold' : '' }}" href="#">Profile</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault(); logout();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

@push('scripts')
    <script>
        function logout() {
            Swal.fire({
                icon: 'question',
                title: 'Anda Yakin?',
                text: 'Apakah Anda yakin ingin logout?',
                showCancelButton: true,
                confirmButtonText: 'Logout',
                customClass: {
                    popup: 'sw-popup',
                    title: 'sw-title',
                    htmlContainer: 'sw-text',
                    icon: 'border-primary text-primary',
                    closeButton: 'bg-secondary border-0 shadow-none',
                    confirmButton: 'bg-danger border-0 shadow-none',
                },
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
@endpush
