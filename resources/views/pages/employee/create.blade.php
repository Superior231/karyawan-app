@extends('layouts.main')

@push('styles')
    <style>
        .navbar {
            display: none;
        }
    </style>
@endpush

@section('content')
    <div class="py-3 px-md-3 px-lg-5 employee">
        <div class="gap-2 mb-4 title d-flex align-items-center">
            <a href="{{ route('employee.index') }}" class="text-dark d-flex align-items-center" title="Back">
                <i class='bx bx-arrow-back fs-3'></i>
            </a>
            <h3 class="py-0 my-0 text-dark fw-bold">{{ $navTitle }}</h3>
        </div>

        <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data"
            class="gap-3 d-flex flex-column">
            @csrf

            <!-- Assets -->
            <div class="card card-not-hover">
                <div class="p-3 card-body p-lg-4">
                    <h4 class="card-title">Assets</h4>
                    <hr class="bg-secondary">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="avatar">
                            <img class="img" src="{{ asset('assets/img/user.jpg') }}" id="image-preview" alt="Avatar">
                        </div>
                    </div>
                    <div class="my-3">
                        <label for="image">Upload avatar <small class="text-color fst-italic">(jpg, jpeg, png, dan webp)</small></label>
                        <input type="file" name="avatar" id="image"
                            class="form-control @error('thumbnail') is-invalid @enderror" accept=".jpg, .jpeg, .png, .webp">
                        @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Data -->
            <div class="card card-not-hover">
                <div class="p-3 card-body p-lg-4">
                    <h4 class="card-title">Data</h4>
                    <hr class="bg-secondary">
                    <div class="mb-3">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="gap-0 gap-md-3 d-flex flex-column flex-md-row">
                        <div class="mb-3 w-100">
                            <label for="positions">Pekerjaan</label>
                            <select class="form-select" name="position" aria-label="Default select example" id="positions" required>
                                @forelse ($positions as $position)
                                    <option value="{{ $position->name }}">{{ $position->name }}</option>
                                @empty
                                    <option selected>No positions available.</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-3 w-100">
                            <label for="status">Status</label>
                            <select class="form-select" name="status" aria-label="Default select example" id="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="gap-0 gap-md-3 d-flex flex-column flex-md-row">
                        <div class="mb-3 w-100">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" placeholder="Masukkan email" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 w-100">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ old('phone') }}" placeholder="Masukkan no telepon" required>
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 w-100">
                            <label for="joined_at">Joined At</label>
                            <input type="date" name="joined_at" class="form-control @error('joined_at') is-invalid @enderror" id="joined_at" value="{{ old('joined_at') }}" placeholder="Masukkan tanggal bergabung" required>
                            @error('joined_at')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Alamat</label>
                        <textarea name="address" rows="4" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Masukkan alamat" required>{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-grid d-md-flex justify-content-md-end w-100">
                <button class="px-4 py-2 rounded btn btn-primary" type="submit">Tambah</button>
            </div>
        </form>
    </div>
@endsection
