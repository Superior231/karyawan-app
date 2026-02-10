{{-- Success --}}
@if (session()->has('success'))
    <div class="p-3 position-fixed" id="toast-success" style="z-index: 99999;">
        <div class="toast align-items-center" id="toast-success-content" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="gap-1 toast-body d-flex align-items-center">
                    <i class='bx bxs-check-circle text-success fs-2'></i>
                    <span class="py-0 my-0 fw-medium">{{ session('success') }}</span>
                </div>
                <button type="button" class="m-auto btn-close me-3" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

{{-- Error --}}
@if (session()->has('error'))
    <div class="p-3 position-fixed" id="toast-error" style="z-index: 99999;">
        <div class="toast align-items-center" id="toast-error-content" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="gap-1 toast-body d-flex align-items-center">
                    <i class='bx bxs-x-circle text-danger fs-2'></i>
                    <span class="py-0 my-0 fw-medium">{{ session('error') }}</span>
                </div>
                <button type="button" class="m-auto btn-close me-3" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif


@foreach (['name', 'username', 'email', 'password', 'avatar'] as $errorType)
    @if ($errors->has($errorType))
        <div class="p-3 position-fixed" id="toast-error-{{ $errorType }}" style="z-index: 99999;">
            <div class="toast toast-error align-items-center" id="toast-error-content-{{ $errorType }}" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="gap-1 toast-body d-flex align-items-center">
                        <i class='bx bxs-x-circle text-danger fs-2'></i>
                        <span class="py-0 my-0 fw-medium">{{ $errors->first($errorType) }}</span>
                    </div>
                    <button type="button" class="m-auto btn-close me-3" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
@endforeach


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            var toastList = toastElList.map(function (toastEl) {
                return new bootstrap.Toast(toastEl)
            })
            toastList.forEach(toast => toast.show());
        });
    </script>
@endpush
