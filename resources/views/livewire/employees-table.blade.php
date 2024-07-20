<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-12">
            <div class="bg-white border rounded-4">
                @if (session()->has('error'))
                <div class="mx-3 mt-4 mb-3">
                    @include('partials.alert-error')
                </div>
                @endif

                {{-- Head Table --}}
                <div class="row align-items-center mx-3 mt-4 mb-3">
                    <div class="col-md-3 mb-2 mb-md-0">
                        <div class="input-group input-group-sm">
                            <input wire:model.debounce.500ms="search"
                                class="form-control focus-ring focus-ring-light border rounded-3 p-2" type="text"
                                placeholder="Pencarian">
                        </div>
                    </div>
                    <div class="col-md-1 mb-2 mb-md-0">
                        <select wire:model.lazy="perPage"
                            class="form-select form-select-sm focus-ring focus-ring-light border rounded-3 p-2">
                            <option value="25" class="">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                        </select>
                    </div>

                    <div class="dropdown-center d-grid col-md-1 mb-2 mb-md-0 me-md-5 me-lg-5 me-xl-4">
                        <button class="btn btn-sm btn-light border dropdown-toggle rounded-3 p-2" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false" @if (empty($selectedRows)) disabled @endif>   
                            Aksi Massal
                        </button>
                        <ul class="dropdown-menu">
                            <li><a wire:click.prevent="confirmDeleteSelectedRows" class="dropdown-item" href="#">Hapus</a></li>
                        </ul>
                    </div>

                    <div class="d-grid d-md-flex justify-content-md-end col-md">
                        <button wire:click.prevent="openModalImport" type="button"
                            class="btn btn-sm btn-outline-dark fw-medium rounded-3 p-2 mb-2 mb-md-0 ms-0 ms-md-2"
                            data-bs-toggle="modal" data-bs-target="#importModal">
                            <span>Import</span>
                        </button>
                        <button wire:click="ConfirmCreate()" type="button" class="btn btn-sm btn-success rounded-3 p-2 mb-2 mb-md-0 ms-0 ms-md-2"
                            >
                            <span>Tambah Data</span>
                        </button>
                    </div>
                </div>

                {{-- Main Table --}}
                <div class="table-responsive mt-4">
                    <table class="table table-hover">
                        <thead class="bg-body-tertiary">
                            <tr>
                                <th scope="col" class="text-center ps-4">
                                    <div class="form-check">
                                        <input wire:model="selectPageRows"
                                            class="form-check-input focus-ring focus-ring-light" type="checkbox"
                                            value="" id="" style="cursor: pointer">
                                    </div>
                                </th>

                                <th scope="col" class="text-center">NO</th>
                                    <th scope="col" class="text-center">
                                        <a href="#" wire:click.prevent="sortBy('nama')" 
                                            class="text-dark" style="background-color: transparent; text-decoration: none;">
                                            Nama
                                        </a>
                                        @if($sortBy == 'nama')
                                            @if($sortDirection == 'asc')
                                                <i class="fa fa-sort-alpha-up"></i>
                                            @else
                                                <i class="fa fa-sort-alpha-down"></i>
                                            @endif
                                        @endif
                                </th>
                                <th scope="col" class="text-center">
                                    <a href="#" wire:click.prevent="sortBy('NIP')" 
                                        class="text-dark" style="background-color: transparent; text-decoration: none;">
                                        NIP
                                    </a>
                                    @if($sortBy == 'NIP')
                                        @if($sortDirection == 'asc')
                                            <i class="fa fa-sort-numeric-up"></i>
                                        @else
                                            <i class="fa fa-sort-numeric-down"></i>
                                        @endif
                                    @endif
                                </th>
                                <th scope="col" class="text-center">
                                    <a href="#" wire:click.prevent="sortBy('jabatan')" 
                                        class="text-dark" style="background-color: transparent; text-decoration: none;">
                                        Jabatan
                                    </a>
                                    @if($sortBy == 'jabatan')
                                        @if($sortDirection == 'asc')
                                            <i class="fa fa-sort-alpha-up"></i>
                                        @else
                                            <i class="fa fa-sort-alpha-down"></i>
                                        @endif
                                    @endif
                                </th>
                                <th scope="col" class="text-center">
                                    <a href="#" wire:click.prevent="sortBy('unitKerja')" 
                                        class="text-dark" style="background-color: transparent; text-decoration: none;">
                                        Unit Kerja
                                    </a>
                                    @if($sortBy == 'unitKerja')
                                        @if($sortDirection == 'asc')
                                            <i class="fa fa-sort-alpha-up"></i>
                                        @else
                                            <i class="fa fa-sort-alpha-down"></i>
                                        @endif
                                    @endif
                                </th>
                                <th scope="col" class="text-center">AKSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($employee as $index => $employees)
                                <tr class="align-middle">
                                    <td class="text-center ps-4">
                                        <div class="form-check">
                                            <input wire:model="selectedRows" class="form-check-input focus-ring focus-ring-light" type="checkbox" value="{{ $employees->id }}" id="employees_{{ $employees->id }}" style="cursor: pointer">
                                        </div>
                                    </td>
                                    <td class="text-center">{{ ($employee->currentPage() - 1) * $employee->perPage() + $loop->iteration }}</td>
                                    <td>{{ $employees->nama }}</td>
                                    <td class="text-center">{{ $employees->NIP }}</td>
                                    <td class="text-center">{{ $employees->jabatan }}</td>
                                    <td class="text-center">{{ $employees->unitKerja }}</td>
                                    <td class="text-center">
                                        <button wire:click="openModalUpdate({{ $employees->id }})" type="button" class="btn btn-sm btn-outline-primary rounded-3 py-1 px-2 my-1 ms-1" data-bs-toggle="modal" data-bs-target="#updateModal">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button wire:click.prevent="openModalDelete({{ $employees->id }})" type="button" class="btn btn-sm btn-outline-danger rounded-3 py-1 px-2 my-1 ms-1">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">Data pegawai tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $employee->links('vendor.livewire.bootstrap') }}
                </div>

                <div>
                </div>


                {{-- CRUD Modal & Offcanvas --}}
                @if($isModalCreate)
                    @include('partials.create-modal')
                @endif
                @if($isModalUpdate)
                    @include('partials.update-modal')
                @endif
                @if($isModalDelete)
                    @include('partials.delete-modal')
                @endif
                @include('partials.read-off-canvas')

                {{-- Import Modal --}}
                @if($isModalImport)
                    @include('partials.import')
                @endif
                

                @if (session()->has('success'))
                    @include('partials.alert-success')
                @endif
            </div>
        </div>
    </div>
</div>
