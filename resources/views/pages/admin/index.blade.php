@extends('layouts.main')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        .row.dt-row {
            overflow-x: auto !important;
        }
    </style>
@endpush

@section('content')
    <div class="p-4 mb-3 card card-not-hover">
        <div class="actions d-flex justify-content-between align-items-center">
            <h3 class="py-0 my-0 fw-semibold">Semua Admin</h3>
            <a href="#" data-bs-toggle="modal" data-bs-target="#add-admin-modal"
                class="gap-1 px-3 py-2 rounded-20 btn btn-primary d-flex align-items-center">
                <i class='bx bx-plus'></i>
                Tambah
            </a>
        </div>
        <hr>
        <table class="table table-striped table-hover" id="adminTable">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Name</th>
                    <th>Roles</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr class="align-middle">
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            <div class="username d-flex justify-content-start" style="width: max-content;">
                                <div class="gap-2 username-info d-flex justify-content-center align-items-center">
                                    <div class="profile-image">
                                        @if (!empty($user->avatar))
                                            <img class="img" src="{{ asset('storage/avatars/' . $user->avatar) }}">
                                        @else
                                            <img class="img"
                                                src="https://ui-avatars.com/api/?background=random&name={{ urlencode($user->name) }}">
                                        @endif
                                    </div>
                                    <div class="gap-0 d-flex flex-column">
                                        <span class="py-0 my-0 fw-normal text-truncate" style="max-width: 150px;">
                                            {{ $user->name }}
                                        </span>
                                        <small class="py-0 my-0 text-secondary text-truncate fs-8"
                                            style="max-width: 150px;">
                                            {{ '@' . $user->username }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $user->roles }}</td>
                        <td>{{ Carbon\Carbon::parse($user->created_at)->translatedFormat('d F Y, H:i') }} WIB</td>
                        <td>{{ Carbon\Carbon::parse($user->updated_at)->translatedFormat('d F Y, H:i') }} WIB</td>
                        <td>
                            <div class="gap-2 actions d-flex align-items-center justify-content-center">
                                <a style="cursor: pointer;"
                                    onclick="editAdmin(
                                        @js($user->id),
                                        @js($user->name),
                                        @js($user->username),
                                        @js($user->roles),
                                        @js($user->avatar),
                                        @js($user->password)
                                    )"
                                    data-bs-toggle="modal" data-bs-target="#edit-admin-modal"
                                    class="p-2 rounded btn btn-primary d-flex align-items-center justify-content-center">
                                    <i class='p-0 m-0 bx bxs-pencil'></i>
                                </a>
                                <form id="delete-admin-form-{{ $user->id }}"
                                    action="{{ route('admin.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')

                                    <button type="button" style="cursor: pointer;"
                                        class="p-2 rounded btn btn-danger d-flex align-items-center justify-content-center"
                                        onclick="confirmDeleteAdmin({{ $user->id }})">
                                        <i class='p-0 m-0 bx bxs-trash'></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- Add Admin Modal -->
    <div class="modal fade" id="add-admin-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-body-light">
            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-content">
                    <div class="pb-0 mb-0 border-0 modal-header d-flex align-items-center justify-content-between">
                        <h4 class="modal-title" id="add-admin-label">Tambah Admin</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr class="mb-0">
                    <div class="modal-body">
                        <div class="user-avatar d-flex justify-content-center">
                            <div class="avatar" style="width:100px; height: 100px;">
                                <img class="img" src="{{ url('assets/img/user.jpg') }}" id="image-preview">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="image">Upload foto <small class="text-secondary fst-italic">(jpg, jpeg, png, dan webp)</small></label>
                            <input type="file" class="form-control" name="avatar" id="image" accept=".jpg, .jpeg, .png, .webp">
                        </div>
                        <div class="mb-3">
                            <label for="add-name">Nama lengkap <small class="text-secondary fst-italic">(max 30 karakter)</small></label>
                            <input type="text" name="name" class="form-control" id="add-name" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-username">Username <small class="text-secondary fst-italic">(max 20 karakter)</small></label>
                            <input type="text" name="username" class="form-control" id="add-username" placeholder="Masukkan username" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-password">Password <small class="text-secondary fst-italic">(min 8 karakter)</small></label>
                            <div class="d-flex align-items-center position-relative">
                                <input type="password" id="password" name="password" class="form-control" style="padding-right: 45px;" placeholder="Masukkan password" required>
                                <div class="showPassAdd d-flex align-items-center justify-content-center position-absolute end-0 h-100" style="cursor: pointer; width: 50px; border-radius: 0px 10px 10px 0px;" onclick="showPassAdd()" id="showPassAdd">
                                    <i class="fa-regular fa-eye-slash"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-0 modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Admin Modal -->
    <div class="modal fade" id="edit-admin-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-body-light">
            <div class="modal-content">
                <div class="border-0 modal-header d-flex align-items-center justify-content-between">
                    <h4 class="modal-title" id="edit-admin-label">Edit Admin</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <hr class="py-0 my-0">
                <form id="edit-admin-form" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="modal-body">
                        <div class="user-avatar d-flex justify-content-center">
                            <div class="avatar" style="width:100px; height: 100px;">
                                <img class="img" src="" id="edit-avatar">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit-avatar">Upload foto <small class="text-secondary fst-italic">(jpg, jpeg, png, dan webp)</small></label>
                            <input type="file" class="form-control" name="avatar" id="edit-avatar-input" accept=".jpg, .jpeg, .png, .webp">
                        </div>
                        <div class="mb-3">
                            <label for="edit-name">Nama lengkap <small class="text-secondary fst-italic">(max 30 karakter)</small></label>
                            <input type="text" class="form-control" name="name" id="edit-name" placeholder="Edit nama" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-username">Username <small class="text-secondary fst-italic">(max 20 karakter)</small></label>
                            <input type="text" class="form-control" name="username" id="edit-username" placeholder="Edit username" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-password">Ubah password <small class="text-secondary fst-italic">(kosongkan jika tidak ingin mengubah)</small></label>
                            <div class="d-flex align-items-center position-relative">
                                <input type="password" id="edit-password" name="password" class="form-control" style="padding-right: 45px;" placeholder="Masukkan password baru">
                                <div class="showPassEdit d-flex align-items-center justify-content-center position-absolute end-0 h-100" style="cursor: pointer; width: 50px; border-radius: 0px 10px 10px 0px;" onclick="showPassEdit()" id="showPassEdit">
                                    <i class="fa-regular fa-eye-slash"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-0 mt-0 border-0 modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#adminTable').DataTable({
                "language": {
                    "searchPlaceholder": "Search..."
                }
            });
        });

        function editAdmin(id, name, username, roles, avatar, password) {
            var avatarUrl = avatar ? '{{ asset('storage/avatars/') }}/' + avatar : 
                    "https://ui-avatars.com/api/?background=random&name=" + encodeURIComponent(name);
                    
            $('#edit-avatar').attr('src', avatarUrl);
            $('#edit-avatar-input').val('');
            $('#edit-name').val(name);
            $('#edit-username').val(username);
            $('#edit-password').val('');

            $('#edit-admin-form').attr('action', "{{ route('admin.update', '') }}" + '/' + id);
            $('#edit-admin-modal').modal('show');
        }

        function confirmDeleteAdmin(adminId) {
            Swal.fire({
                icon: 'question',
                title: 'Anda Yakin?',
                text: 'Apakah Anda yakin ingin menghapus admin ini?',
                confirmButtonText: 'Delete',
                showCancelButton: true,
                customClass: {
                    popup: 'sw-popup',
                    title: 'sw-title',
                    htmlContainer: 'sw-text',
                    icon: 'sw-icon',
                    closeButton: 'bg-secondary border-0 shadow-none',
                    confirmButton: 'bg-danger border-0 shadow-none',
                },
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-admin-form-' + adminId).submit();
                }
            });
        }

        function showPassAdd() {
            const passwordInputAdd = document.getElementById("password");
            const passwordTypeAdd = passwordInputAdd.type;

            if (passwordTypeAdd === "password") {
                passwordInputAdd.type = "text";
                document.getElementById("showPassAdd").innerHTML = '<i class="fa-regular fa-eye"></i>';
            } else {
                passwordInputAdd.type = "password";
                document.getElementById("showPassAdd").innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
            }
        }

        function showPassEdit() {
            const passwordInputEdit = document.getElementById("edit-password");
            const passwordTypeEdit = passwordInputEdit.type;

            if (passwordTypeEdit === "password") {
                passwordInputEdit.type = "text";
                document.getElementById("showPassEdit").innerHTML = '<i class="fa-regular fa-eye"></i>';
            } else {
                passwordInputEdit.type = "password";
                document.getElementById("showPassEdit").innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
            }
        }
    </script>
@endpush
