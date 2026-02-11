@extends('layouts.main')

@section('content')
    <section class="profile">
        <div class="row row-cols-1 row-cols-md-2 g-3">
            <div class="col-12 col-md-4">
                <div class="card user-info">
                    <div class="card-body">
                        <div class="user-avatar">
                            <div class="avatar">
                                @if (!empty($employee->avatar))
                                    <img class="img" src="{{ asset('storage/avatars/' . $employee->avatar) }}">
                                @else
                                    <img class="img" src="https://ui-avatars.com/api/?background=random&name={{ urlencode($employee->name) }}">
                                @endif
                            </div>
                            <h4 class="text-center username fw-bold">{{ $employee->name }}</h4>
                        </div>

                        <div class="table-responsive">
                            <table>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td>{{ $employee->position }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td>{{ $employee->email }}</td>
                                </tr>
                                <tr>
                                    <td>No Telepon</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td>{{ $employee->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td>{{ $employee->address }}</td>
                                </tr>
                                <tr>
                                    <td>Joined at</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td>{{ Carbon\Carbon::parse($employee->joined_at)->translatedFormat('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($employee->status == 'active')
                                                <i class='bx bxs-check-circle text-success fs-4'></i>
                                            @else
                                                <i class='bx bxs-x-circle text-danger fs-4'></i>
                                            @endif
                                            {{ $employee->status == 'active' ? 'Active' : 'Inactive' }}
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gap-2 col-12 col-md-8 d-flex flex-column actions">
                <a href="{{ route('employee.edit', $employee->id) }}" class="card text-dark">
                    <div class="gap-2 card-body d-flex align-items-center">
                        <i class='bx bxs-user fs-4'></i>
                        <span class="fw-bold">Edit karyawan</sp>
                    </div>
                </a>
                <form id="delete-employee-form-{{ $employee->id }}" action="{{ route('employee.destroy', $employee->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <a style="cursor: pointer;" class="card text-dark employee-delete" onclick="confirmDeleteEmployee('{{ $employee->id }}')">
                        <div class="gap-2 card-body d-flex align-items-center text-danger">
                            <i class='bx bxs-trash fs-4'></i>
                            <span class="fw-bold">Hapus karyawan</span>
                        </div>
                    </a>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function confirmDeleteEmployee(employeeId) {
            Swal.fire({
                icon: 'question',
                title: 'Anda Yakin?',
                text: 'Apakah Anda yakin ingin menghapus karyawan ini?',
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
                    document.getElementById('delete-employee-form-' + employeeId).submit();
                }
            });
        }
    </script>
@endpush
