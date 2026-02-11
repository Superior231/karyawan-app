<div>
    <div class="p-4 mb-3 card card-not-hover position-relative">
        <div class="actions d-flex justify-content-between align-items-center">
            <h3 class="py-0 my-0 fw-semibold">Semua Karyawan</h3>
            <a href="{{ route('employee.create') }}" class="gap-1 px-3 py-2 rounded-20 btn btn-primary d-flex align-items-center">
                <i class='bx bx-plus'></i>
                Tambah
            </a>
        </div>
        <hr>
        <div class="gap-2 mb-2 actions d-column d-md-flex align-items-center justify-content-between">
            <!-- Filters -->
            <div class="gap-2 py-2 container-filters d-flex position-relative">
                <div class="btn-group">
                    <button type="button" class="bg-transparent border-0 dropdown-toggle" data-bs-toggle="dropdown"
                        data-bs-display="static" aria-expanded="false">{{ $currentType }}</button>
                    <ul class="dropdown-menu dropdown-menu-lg-start" style="max-height: 200px; overflow-y: auto;">
                        <li>
                            <a class="dropdown-item {{ $typeFilter == 'All Positions' ? 'bg-primary text-light' : '' }}"
                                wire:click="typeBy('All Positions')" style="cursor: pointer;">
                                All Positions
                            </a>
                        </li>
                        @forelse ($positions as $position)
                            <li>
                                <a class="dropdown-item {{ $typeFilter == $position->name ? 'bg-primary text-light' : '' }}"
                                    wire:click="typeBy('{{ $position->name }}')" style="cursor: pointer;">
                                    {{ $position->name }}
                                </a>
                            </li>
                        @empty
                            <li>
                                <span class="dropdown-item text-muted">No positions available.</span>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Search -->
            <div class="search-box">
                <i class='bx bx-search'></i>
                <input class="ms-0 ps-2" type="search" id="search" placeholder="Search project..."
                    autocomplete="off" wire:model.live="search" style="outline: none !important; border: none;">

                <div class="dropdown dropup">
                    <a class="p-0 m-0 d-flex align-items-center justify-content-center text-decoration-none"
                        style="cursor: pointer;" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='p-0 m-0 bx bx-slider'></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item {{ $currentFilter == 'Terbaru' ? 'bg-primary text-light' : '' }}"
                                wire:click="sortBy('latest')" style="cursor: pointer;">Latest</a></li>
                        <li><a class="dropdown-item {{ $currentFilter == 'Terlama' ? 'bg-primary text-light' : '' }}"
                                wire:click="sortBy('longest')" style="cursor: pointer;">Terlama</a></li>
                        <li><a class="dropdown-item {{ $currentFilter == 'A - Z' ? 'bg-primary text-light' : '' }}"
                                wire:click="sortBy('az')" style="cursor: pointer;">(A-Z) Nama</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Alamat</th>
                        <th class="text-center">Status</th>
                        <th>Joined_at</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $index => $employee)
                        <tr class="align-middle">
                            <td class="text-center">
                                {{ ($employees->currentPage() - 1) * $employees->perPage() + $loop->iteration }}
                            </td>
                            <td>
                                <a href="{{ route('employee.show', $employee->id) }}" class="username d-flex justify-content-start"
                                    style="width: max-content;">
                                    <div class="gap-2 username-info d-flex justify-content-center align-items-center">
                                        <div class="profile-image">
                                            @if (!empty($employee->avatar))
                                                <img class="img"
                                                    src="{{ asset('storage/avatars/' . $employee->avatar) }}">
                                            @else
                                                <img class="img"
                                                    src="https://ui-avatars.com/api/?background=random&name={{ urlencode($employee->name) }}">
                                            @endif
                                        </div>
                                        <div class="gap-0 d-flex flex-column">
                                            <span class="py-0 my-0 fw-normal text-truncate" style="max-width: 150px;">
                                                {{ $employee->name }}
                                            </span>
                                            <small class="py-0 my-0 text-secondary text-truncate fs-8"
                                                style="max-width: 150px;">
                                                {{ $employee->email }}
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td>{{ $employee->position }}</td>
                            <td>{{ $employee->address }}</td>
                            <td>
                                <div class="status-info d-flex align-items-center justify-content-center">
                                    @if ($employee->status == 'active')
                                        <i class='bx bxs-check-circle text-success fs-3'></i>
                                    @else
                                        <i class='bx bxs-x-circle text-danger fs-3'></i>
                                    @endif
                                </div>
                            </td>
                            <td>{{ Carbon\Carbon::parse($employee->joined_at)->translatedFormat('d F Y') }}</td>
                            <td>
                                <div class="actions d-flex align-items-center justify-content-center">
                                    <div class="dropdown">
                                        <i class="bx bx-cog fs-4" id="action-{{ $employee->id }}"
                                            data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"
                                            title="Actions"></i>

                                        <ul class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="action-{{ $employee->id }}">
                                            <li>
                                                <a href="{{ route('employee.show', $employee->id) }}" class="gap-1 dropdown-item d-flex align-items-center">
                                                    <i class='bx bx-show fs-5'></i>
                                                    Lihat detail
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('employee.edit', $employee->id) }}" class="gap-1 dropdown-item d-flex align-items-center">
                                                    <i class='bx bx-pencil fs-5'></i>
                                                    Edit data
                                                </a>
                                            </li>
                                            <li>
                                                <form id="delete-employee-form-{{ $employee->id }}" action="{{ route('employee.destroy', $employee->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf @method('DELETE')

                                                    <a style="cursor: pointer;"
                                                        class="gap-1 dropdown-item d-flex align-items-center"
                                                        onclick="confirmDeleteEmployee('{{ $employee->id }}')">
                                                        <i class='bx bx-trash fs-5'></i>
                                                        Hapus
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center">
                <p class="py-0 my-0">
                    Showing {{ $employees->firstItem() }} to {{ $employees->lastItem() }} of {{ $employees->total() }} entries
                </p>
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</div>
