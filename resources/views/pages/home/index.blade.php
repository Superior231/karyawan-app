@extends('layouts.main')

@section('content')
    <section class="dashboard">
        <h1 class="text-center">Selamat Datang Di Aplikasi Karyawan</h1>

        <div class="mt-4 row g-3">
            <a href="{{ route('employee.index') }}" class="col">
                <div class="card h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="gap-2 d-flex">
                            <div class="p-0 m-0 bg-icon-employee">
                                <i class='p-3 fas fa-users fs-3'></i>
                            </div>
                            <div class="gap-1 d-flex flex-column justify-content-center align-items-start">
                                <h5 class="py-0 my-0 text-nowrap text-secondary">Total Karyawan</h5>
                                <h4 class="py-0 my-0 fw-bold">{{ $employees->count() }}</h4>
                            </div>
                        </div>
                        <i class='p-3 bx bx-chevron-right fs-2'></i>
                    </div>
                </div>
            </a>
            <a href="{{ route('position.index') }}" class="col">
                <div class="card h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="gap-2 d-flex">
                            <div class="p-0 m-0 bg-icon-position">
                                <i class='p-3 bx bxs-label fs-2'></i>
                            </div>
                            <div class="gap-1 d-flex flex-column justify-content-center align-items-start">
                                <h5 class="py-0 my-0 text-nowrap text-secondary">Total Jabatan</h5>
                                <h4 class="py-0 my-0 fw-bold">{{ $positions->count() }}</h4>
                            </div>
                        </div>
                        <i class='p-3 bx bx-chevron-right fs-2'></i>
                    </div>
                </div>
            </a>
            <div class="col">
                <div class="card card-active h-100">
                    <div class="card-body">
                        <div class="gap-2 d-flex">
                            <div class="p-0 m-0 bg-icon-active text-success">
                                <i class='p-3 bx bxs-check-circle fs-2'></i>
                            </div>
                            <div class="gap-1 d-flex flex-column justify-content-center align-items-start">
                                <h5 class="py-0 my-0 text-nowrap text-secondary">Total Karyawan Aktif</h5>
                                <h4 class="py-0 my-0 fw-bold">{{ $activeEnployees->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-inactive h-100">
                    <div class="card-body">
                        <div class="gap-2 d-flex">
                            <div class="p-0 m-0 bg-icon-inactive text-danger">
                                <i class='p-3 bx bxs-x-circle fs-2'></i>
                            </div>
                            <div class="gap-1 d-flex flex-column justify-content-center align-items-start">
                                <h5 class="py-0 my-0 text-nowrap text-secondary">Total Karyawan Tidak Aktif</h5>
                                <h4 class="py-0 my-0 fw-bold">{{ $inactiveEnployees->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
