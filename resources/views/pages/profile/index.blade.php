@extends('layouts.main')

@section('content')
    <section class="profile">
        <div class="row row-cols-1 row-cols-md-2 g-3">
            <div class="col-12 col-md-4">
                <div class="card user-info">
                    <div class="card-body">
                        <div class="user-avatar">
                            <div class="avatar">
                                @if (!empty(Auth::user()->avatar))
                                    <img class="img" src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}">
                                @else
                                    <img class="img" src="https://ui-avatars.com/api/?background=random&name={{ urlencode(Auth::user()->name) }}">
                                @endif
                            </div>
                            <h4 class="text-center username fw-bold">{{ Auth::user()->name }}</h4>
                        </div>

                        <div class="table-responsive">
                            <table>
                                <tr>
                                    <td>Username</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td>{{ Auth::user()->username }}</td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td>{{ Str::ucfirst(Auth::user()->roles) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gap-2 col-12 col-md-8 d-flex flex-column actions">
                <a href="#" class="card text-dark" data-bs-toggle="modal" data-bs-target="#edit-profile">
                    <div class="gap-2 card-body d-flex align-items-center">
                        <i class='bx bxs-user fs-4'></i>
                        <span class="fw-bold">Edit profile</sp>
                    </div>
                </a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); logout();" class="card logout">
                    <div class="gap-2 card-body d-flex align-items-center text-danger">
                        <i class='bx bx-arrow-from-left fs-3'></i>
                        <span class="fw-bold">Logout</sp>
                    </div>
                </a>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="edit-profile" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-body-light">
            <div class="modal-content">
                <div class="border-0 modal-header d-flex align-items-center justify-content-between">
                    <h4 class="modal-title" id="edit-profile-label">Edit profile</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="delete-avatar-btn">
                    <form id="delete-avatar-form-{{ Auth::user()->id }}" action="{{ route('profile.delete.avatar', Auth::user()->id) }}" method="POST">
                        @csrf @method('DELETE') 
                        <button type="button" onclick="deleteAvatar({{ Auth::user()->id }})">Hapus avatar</button>
                    </form>
                </div>
                
                <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="modal-body">
                        <div class="user-avatar">
                            <div class="avatar">
                                @if (!empty(Auth::user()->avatar))
                                    <img class="img" src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" id="image-preview">
                                @else
                                    <img class="img" src="https://ui-avatars.com/api/?background=random&name={{ urlencode(Auth::user()->name) }}" id="image-preview">
                                @endif
                            </div>
                        </div>

                        <div class="mt-4 mb-3">
                            <label for="image">Upload foto <small class="text-color fst-italic">(jpg, jpeg, png, dan webp)</small></label>
                            <input type="file" class="form-control" name="avatar" id="image" accept=".jpg, .jpeg, .png, .webp">
                        </div>

                        <div class="mb-3">
                            <label for="edit-name">Nama lengkap <small class="text-color fst-italic">(max 30 karakter)</small></label>
                            <input type="text" class="form-control" name="name" id="edit-name" placeholder="Edit nama" value="{{ Auth::user()->name }}" autocomplete="off" required>
                            <p class="py-0 my-0 text-size text-danger fw-bolder" id="edit-name-error-message"></p>
                        </div>

                        <div class="mb-3">
                            <label for="edit-username">Username <small class="text-color fst-italic">(max 20 karakter)</small></label>
                            <input type="text" class="form-control" name="username" id="edit-username" placeholder="Edit username" value="{{ Auth::user()->username }}" autocomplete="off" required>
                            <p class="py-0 my-0 text-size text-danger fw-bolder" id="edit-username-error-message"></p>
                        </div>

                        <div class="mb-3">
                            <label for="edit-password">Ubah password</label>
                            <div class="d-flex align-items-center position-relative">
                                <input type="password" id="edit-password" name="password"
                                    class="form-control"
                                    style="padding-right: 45px;" placeholder="Masukkan password baru">
                                <div class="showPass d-flex align-items-center justify-content-center position-absolute end-0 h-100"
                                    id="showPass" style="cursor: pointer; width: 50px; border-radius: 0px 10px 10px 0px;"
                                    onclick="showPass()">
                                    <i class="fa-regular fa-eye-slash"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-0 mt-0 border-0 modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="simpan-edit-profile-btn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal End -->
@endsection

@push('scripts')
    <script>
        function deleteAvatar(userId) {
            Swal.fire({
                icon: 'question',
                title: 'Anda Yakin?',
                text: 'Apakah Anda yakin ingin menghapus avatar ini?',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
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
                    document.getElementById('delete-avatar-form-' + userId).submit();
                }
            });
        }

        function showPass() {
            const passwordInput = document.getElementById("edit-password");
            const passwordType = passwordInput.type;

            if (passwordType === "password") {
                passwordInput.type = "text";
                document.getElementById("showPass").innerHTML = '<i class="fa-regular fa-eye"></i>';
            } else {
                passwordInput.type = "password";
                document.getElementById("showPass").innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
            }
        }
    </script>
@endpush
