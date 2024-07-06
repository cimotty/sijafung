<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-12">
            <div class="bg-white border rounded-4">
                {{-- Alert Error --}}
                {{-- <div class="mx-3 mt-4 mb-3">
                    @include('partials.alert-error')
                </div> --}}

                {{-- Head Table --}}
                <div class="row align-items-center mx-3 mt-4 mb-3">
                    <div class="col-md-3 mb-2 mb-md-0">
                        <div class="input-group input-group-sm">
                            <input wire:model.debounce.500ms="search"
                                class="form-control focus-ring focus-ring-light border rounded-3 p-2" type="text"
                                placeholder="Cari barang...">
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
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{-- @if (empty($selectedRows)) disabled @endif> --}}
                            Aksi Massal
                        </button>
                        <ul class="dropdown-menu">
                            <li><a wire:click.prevent="confirmDeleteSelectedRows" class="dropdown-item"
                                    href="#">Hapus</a></li>
                        </ul>
                    </div>
                    <div class="d-grid d-md-flex justify-content-md-end col-md">
                        <button wire:click.prevent="confirmImport" type="button"
                            class="btn btn-sm btn-outline-dark fw-medium rounded-3 p-2 mb-2 mb-md-0 ms-0 ms-md-2"
                            data-bs-toggle="modal" data-bs-target="#importModal">
                            <span>Import</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-success rounded-3 p-2 mb-2 mb-md-0 ms-0 ms-md-2"
                            data-bs-toggle="modal" data-bs-target="#createModal">
                            <span>Tambah Data</span>
                        </button>
                    </div>
                </div>

                {{-- Main Table --}}
                <div class="table-responsive">
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
                                {{-- <th scope="col" class="text-center">
                                    <span
                                        @if ($items->count() > 0) wire:click="orderBy('kode')" style="cursor: pointer" @endif>KODE
                                        @if ($orderBy === 'kode' && $orderDirection === 'asc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-1-9 fa-lg"></i>
                                        @elseif ($orderBy === 'kode' && $orderDirection === 'desc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-9-1 fa-lg"></i>
                                        @endif
                                    </span>
                                </th> --}}
                                <th scope="col" class="text-center">
                                    <span>NAMA
                                        {{-- @if ($items->count() > 0) wire:click="orderBy('nama')" style="cursor: pointer" @endif>NAMA
                                        @if ($orderBy === 'nama' && $orderDirection === 'asc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-a-z fa-lg"></i>
                                        @elseif ($orderBy === 'nama' && $orderDirection === 'desc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-z-a fa-lg"></i>
                                        @endif --}}
                                    </span>
                                </th>
                                <th scope="col" class="text-center">
                                    <span>NIP
                                        {{-- @if ($items->count() > 0) wire:click="orderBy('nomorRegister')" style="cursor: pointer" @endif>NOMOR
                                        REGISTER
                                        @if ($orderBy === 'nomorRegister' && $orderDirection === 'asc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-1-9 fa-lg"></i>
                                        @elseif ($orderBy === 'nomorRegister' && $orderDirection === 'desc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-9-1 fa-lg"></i>
                                        @endif --}}
                                    </span>
                                </th>
                                <th scope="col" class="text-center">
                                    <span>JABATAN
                                        {{-- @if ($items->count() > 0) wire:click="orderBy('kategori')" style="cursor: pointer" @endif>KATEGORI
                                        @if ($orderBy === 'kategori' && $orderDirection === 'asc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-a-z fa-lg"></i>
                                        @elseif ($orderBy === 'kategori' && $orderDirection === 'desc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-z-a fa-lg"></i>
                                        @endif --}}
                                    </span>
                                </th>
                                <th scope="col" class="text-center">
                                    <span>UNIT KERJA
                                        {{-- @if ($items->count() > 0) wire:click="orderBy('tahunBeli')" style="cursor: pointer" @endif>TAHUN
                                        PEMBELIAN
                                        @if ($orderBy === 'tahunBeli' && $orderDirection === 'asc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-1-9 fa-lg"></i>
                                        @elseif ($orderBy === 'tahunBeli' && $orderDirection === 'desc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-9-1 fa-lg"></i>
                                        @endif --}}
                                    </span>
                                </th>
                                <th scope="col" class="text-center">AKSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- @forelse ($items as $index => $item) --}}
                            <tr class="align-middle">
                                <td class="text-center ps-4">
                                    <div class="form-check">
                                        <input wire:model="selectedRows"
                                            class="form-check-input focus-ring focus-ring-light" type="checkbox"
                                            {{-- value="{{ $item->id }}" id="{{ $item->id }}" --}} style="cursor: pointer">
                                    </div>
                                </td>
                                <td class="text-center">1
                                    {{-- {{ $items->firstItem() + $index }} --}}
                                </td>
                                {{-- <td wire:click.prevent="readItem({{ $item }})" class="text-center"
                                    data-bs-toggle="tooltip" data-bs-title="Detail" style="cursor: pointer">
                                    {{ $item->kode }}
                                </td> --}}
                                <td {{-- wire:click.prevent="readItem({{ $item }})" --}} data-bs-toggle="tooltip" data-bs-title="Detail">
                                    <a class="btn btn-link link-dark link-underline-opacity-0"
                                        data-bs-toggle="offcanvas" href="#readOffcanvas" role="button"
                                        aria-controls="readOffcanvas" style="cursor: pointer">RIZKY
                                        CAKRA MANDALA</a>

                                </td>
                                <td class="text-center">12345678910</td>
                                <td class="text-center">KETUA</td>
                                <td class="text-center">KANDANG LIMUN</td>
                                {{-- <td class="text-center">{{ $item->kondisi }}</td>
                                <td class="text-end pe-3">Rp
                                    {{ number_format($item->harga, 2, ',', '.') }}</td> --}}
                                <td class="text-center">
                                    <button type="button"
                                        class="btn btn-sm btn-outline-primary rounded-3 py-1 px-2 my-1 ms-1"
                                        data-bs-toggle="modal" data-bs-target="#updateModal">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    <button {{-- wire:click.prevent="confirmEmployeeDelete()" --}} type="button"
                                        class="btn btn-sm btn-outline-danger rounded-3 py-1 px-2 my-1 ms-1"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>

                            {{-- @empty --}}
                            <tr>
                                <td colspan="10" class="text-center py-5">Data barang tidak ditemukan</td>
                            </tr>
                            {{-- @endforelse --}}
                        </tbody>
                    </table>
                </div>

                {{-- Paginate --}}
                {{-- {{ $items->links() }} --}}

                {{-- CRUD Modal & Offcanvas --}}
                @include('partials.create-modal')
                @include('partials.read-off-canvas')
                @include('partials.update-modal')
                @include('partials.delete-modal')

                {{-- Import Modal --}}
                @include('partials.import')

                {{-- Alert Success --}}
                {{-- @include('partials.alert-success') --}}
            </div>
        </div>
    </div>
</div>
