@extends('layouts.auth', ['title' => 'Login - Karyawan App | PT Maju Jaya'])

@push('styles')
    <link rel="stylesheet" href="{{ url('assets/css/auth.css') }}">
@endpush

@section('content')
    <div class="row w-100" style="height: 100svh;">
        <div class="col col-12 col-md-6 col-lg-7 d-flex flex-column justify-content-center" id="hero">
            <div class="gap-2 logo d-flex align-items-center">
                <img src="{{ url('assets/img/logo.png') }}" alt="Logo"
                    style="width: 50px; height: auto;">
                <h4 class="text-center text-color fw-bold">Karyawan App</h4>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <img src="{{ url('assets/img/hero.gif') }}" alt="Login"
                    style="width: 75%; height: auto;">
            </div>
        </div>
        <div class="col col-12 col-sm-12 col-md-6 col-lg-5 d-flex flex-column justify-content-center bg-color">
            <div class="d-flex flex-column justify-content-between h-100">
                <div class="container d-flex flex-column justify-content-center px-auto px-md-5 h-100">
                    <div class="d-flex flex-column align-items-center">
                        <div class="mb-4 d-flex flex-column align-items-center d-none" id="logo-mobile">
                            <img src="{{ url('assets/img/logo.png') }}" alt="Logo" style="width: 80px; height: auto;">
                        </div>
                        <h2 class="fw-bold">Sign in</h2>
                        <p class="fs-6 text-secondary">Masuk Karyawan App</p>
                    </div>
    
                    <form method="POST" action="{{ route('login') }}" class="mt-4 auth">
                        @csrf
    
                        <div class="mb-3 content">
                            <div class="pass-logo">
                                <i class='bx bx-user'></i>
                            </div>
                            <input type="text" name="username" id="username"
                                class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                                value="{{ old('username') }}" required autocomplete="username" autofocus>
    
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
    
                        <div class="mb-3 content">
                            <div class="pass-logo">
                                <i class='bx bx-lock-alt'></i>
                            </div>
                            <div class="d-flex align-items-center position-relative">
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" style="padding-right: 45px;"
                                    placeholder="Password" required>
                                <div class="showPass d-flex align-items-center justify-content-center position-absolute end-0 h-100"
                                    id="showPass" style="cursor: pointer; width: 50px; border-radius: 0px 10px 10px 0px;"
                                    onclick="showPass()">
                                    <i class="fa-regular fa-eye-slash"></i>
                                </div>
                            </div>
    
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="mt-4 btn btn-primary d-block fw-semibold w-100" type="submit">Login</button>
                    </form>
                </div>
                <div class="py-5 footer d-flex justify-content-center" style="height: 20px">
                    <p class="mb-0 text-center text-secondary fs-7">
                        Copyright &copy;{{ date('Y') }} <a href="https://hikmal-falah.com" class="fs-7" target="_blank">Hikmal Falah</a>. Seluruh hak cipta dilindungi.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
