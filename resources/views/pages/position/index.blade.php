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
            <h3 class="py-0 my-0 fw-semibold">Semua Pekerjaan</h3>
            <a href="#" data-bs-toggle="modal" data-bs-target="#add-position-modal"
                class="gap-1 px-3 py-2 rounded-20 btn btn-primary d-flex align-items-center">
                <i class='bx bx-plus'></i>
                Tambah
            </a>
        </div>
        <hr>
        <table class="table table-striped table-hover" id="positionTable">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Name</th>
                    <th>Updated_at</th>
                    <th>Created_at</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($positions as $index => $position)
                    <tr class="align-middle">
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            <div style="min-width: 250px;">
                                {{ $position->name }}
                            </div>
                        </td>
                        <td>{{ Carbon\Carbon::parse($position->updated_at)->translatedFormat('d F Y, H:i') }} WIB</td>
                        <td>{{ Carbon\Carbon::parse($position->created_at)->translatedFormat('d F Y, H:i') }} WIB</td>
                        <td>
                            <div class="gap-2 actions d-flex align-items-center justify-content-center pe-3">
                                <a style="cursor: pointer;"
                                    onclick="editPosition('{{ $position->id }}', '{{ $position->name }}')"
                                    data-bs-toggle="modal" data-bs-target="#edit-position-modal"
                                    class="p-2 rounded btn btn-primary d-flex align-items-center justify-content-center">
                                    <i class='p-0 m-0 bx bxs-pencil'></i>
                                </a>
                                <form id="delete-position-form-{{ $position->id }}"
                                    action="{{ route('position.destroy', $position->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')

                                    <button type="button" style="cursor: pointer;"
                                        class="p-2 rounded btn btn-danger d-flex align-items-center justify-content-center"
                                        onclick="confirmDeletePosition({{ $position->id }})">
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


    <!-- Add Position Modal -->
    <div class="modal fade" id="add-position-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('position.store') }}" method="POST">
                @csrf

                <div class="modal-content">
                    <div class="pb-0 mb-0 border-0 modal-header d-flex align-items-center justify-content-between">
                        <h4 class="modal-title" id="add-position-label">Tambah pekerjaan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr class="mb-0">
                    <div class="modal-body">
                        <label for="name" class="mb-1">Nama pekerjaan</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan nama pekerjaan" required>
                    </div>
                    <div class="border-0 modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="add-position-btn">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Position Modal -->
    <div class="modal fade" id="edit-position-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="pb-0 mb-0 border-0 modal-header d-flex align-items-center justify-content-between">
                    <h4 class="modal-title" id="edit-position-label">Edit pekerjaan</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form id="edit-position-form" method="POST">
                    @csrf @method('PUT')

                    <div class="modal-body">
                        <label for="edit-name" class="mb-1">Nama pekerjaan</label>
                        <input type="text" name="name" class="form-control" id="edit-name" placeholder="Masukkan nama pekerjaan" required>
                    </div>
                    <div class="border-0 modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="edit-position-btn" class="btn btn-primary">Simpan</button>
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
            $('#positionTable').DataTable({
                "language": {
                    "searchPlaceholder": "Search..."
                }
            });
        });

        function editPosition(id, name) {
            $('#edit-name').val(name);

            $('#edit-position-form').attr('action', "{{ route('position.update', '') }}" + '/' + id);
            $('#edit-position-modal').modal('show');
        }

        function confirmDeletePosition(positionId) {
            Swal.fire({
                icon: 'question',
                title: 'Anda Yakin?',
                text: 'Apakah Anda yakin ingin menghapus pekerjaan ini?',
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
                    document.getElementById('delete-position-form-' + positionId).submit();
                }
            });
        }
    </script>
@endpush
