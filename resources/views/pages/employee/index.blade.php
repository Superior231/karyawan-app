@extends('layouts.main')

@push('styles')
    @livewireStyles()
@endpush

@section('content')
    @livewire('employee')
@endsection

@push('scripts')
    @livewireScripts()
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
