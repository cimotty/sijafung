<!-- Create Modal -->
<div class="modal fade @if($isModalCreate) show @endif" id="createModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true" style="@if($isModalCreate) display: block; @endif">
    <div class="modal-dialog modal-dialog-centered">
        <form wire:submit.prevent="store">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">
                        <span>Tambah Data Pegawai</span>
                    </h1>
                    <button wire:click="closeModalCreate" type="button" class="btn-close focus-ring focus-ring-light" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <label for="nama" class="form-label ms-1">Nama</label>
                            <div class="input-group input-group-sm">
                                <input name="nama" type="text" wire:model="nama" class="form-control focus-ring focus-ring-light border rounded-2 @error('nama') is-invalid @enderror" placeholder="Masukkan Nama">
                                @error('nama')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label for="NIP" class="form-label ms-1">NIP</label>
                            <div class="input-group input-group-sm">
                                <input name="NIP" type="text" wire:model="NIP" class="form-control focus-ring focus-ring-light border rounded-2 @error('NIP') is-invalid @enderror" placeholder="Masukkan NIP">
                                @error('NIP')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <label for="divisi" class="form-label ms-1">OPD</label>
                            <select id="divisi" class="form-control" wire:model="divisi">
                                <option value="">Pilih OPD</option>
                                @foreach($divisiList as $divisi)
                                    <option value="{{ $divisi }}">{{ $divisi }}</option>
                                @endforeach
                            </select>
                            @error('divisi') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label for="jabatan" class="form-label ms-1">Jabatan Fungsional</label>
                            <div class="input-group input-group-sm">
                                <input name="jabatan" type="text" wire:model="jabatan" class="form-control focus-ring focus-ring-light border rounded-2 @error('jabatan') is-invalid @enderror" placeholder="Masukkan Jabatan Fungsional">
                                @error('jabatan')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <label for="unitKerja" class="form-label ms-1">Unit Kerja</label>
                            <div class="input-group input-group-sm">
                                <input name="unitKerja" type="text" wire:model="unitKerja" class="form-control focus-ring focus-ring-light border rounded-2 @error('unitKerja') is-invalid @enderror" placeholder="Masukkan Unit Kerja">
                                @error('unitKerja')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <label for="sertifikat" class="form-label ms-1">Upload Sertifikat</label>
                        <input type="file" name="sertifikat[]" class="form-control focus-ring focus-ring-light border rounded-2 @error('sertifikat') is-invalid @enderror" wire:model="sertifikat" multiple>
                        @error('sertifikat')
                            <div class="invalid-feedback ms-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-12 mb-4">
                            <label for="keterangan" class="form-label ms-1">Pelatihan yang Diikuti</label>
                            <textarea id="keterangan" wire:model="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="4" placeholder="Masukkan Pelatihan yang Diikuti"></textarea>
                            @error('keterangan')
                                <div class="invalid-feedback ms-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-grid d-md-flex justify-content-md-end mb-2 mt-2">
                        <button wire:click.prevent="store()" type="submit" class="btn btn-success">
                            <span>Tambah</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
