<nav class="py-1 navbar sticky-top navbar-expand-lg bg-soft-blue">
    <div class="container">
        <a href="{{ route('home.index') }}" class="navbar-brand logo text-primary">
            <img src="{{ url('assets/img/logo.png') }}" style="width: 40px; height: 40px;" alt="logo">
            {{ config('app.name') }}
        </a>
        <div class="gap-3 navbar-brand d-flex align-items-center d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#mobileNav" aria-controls="mobileNav">
            <i class='mt-1 bx bx-menu fs-1'></i>
        </div>

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
                        <span class="nav-text text-dark text-truncate" style="max-width: 150px;">&nbsp;{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="mt-2 dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="gap-2 dropdown-item d-flex align-items-center {{ $active == 'profile' ? 'active fw-semibold' : '' }}" href="{{ route('profile.index') }}">
                                <i class='bx bx-user fs-6'></i>
                                Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="gap-2 dropdown-item d-flex align-items-center" href="{{ route('logout') }}"onclick="event.preventDefault(); logout();">
                                <i class='bx bx-log-out fs-6'></i>
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

<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileNav" aria-labelledby="mobileNavLabel">
    <div class="offcanvas-header">
        <div class="d-flex align-items-center">
            <a href="{{ route('home.index') }}">
                <img src="{{ url('/assets/img/logo.png') }}" alt="logo" style="width: 40px; height: 40px;"
                    class="logo" id="logo">
            </a>
            <h3 class="py-0 my-0 nav-name-brand ms-2 fw-bold text-primary" id="navNameBrand">Karyawan App</h3>
        </div>
        <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <hr class="py-0 my-0 border-light">
    <div class="px-0 py-0 mx-0 offcanvas-body">
        <ul class="list-unstyled">
            <li class="{{ $active == 'home' ? 'active' : '' }}">
                <a href="{{ route('home.index') }}" class="gap-2 d-flex align-items-center">
                    <i class='bx bxs-home fs-4'></i>
                    <span class="py-0 my-0">Home</span>
                </a>
            </li>
        </ul>

        <div class="profile">
            <ul class="bottom-0 bg-transparent position-absolute list-unstyled w-100">
                <li class="bg-transparent w-100 d-flex justify-content-between align-items-center">
                    <a href="{{ route('profile.index') }}" class="d-flex align-items-center gap-2 {{ $active == 'setting' ? 'active fw-semibold' : '' }}">
                        <div class="avatar">
                            @if (!empty(Auth::user()->avatar))
                                <img class="img" src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}">
                            @else
                                <img class="img" src="https://ui-avatars.com/api/?background=random&name={{ urlencode(Auth::user()->name) }}">
                            @endif
                        </div>
                        <span class="nav-text text-dark text-truncate" style="max-width: 150px;">&nbsp;{{ Auth::user()->name }}</span>
                    </a>
                    <i class='bg-transparent bx bx-chevron-right fs-3 me-3'></i>
                </li>
            </ul>
        </div>
    </div>
</div>


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
