<div>
    <!-- Update Modal -->
    <div class="modal fade @if($isModalUpdate) show @endif" id="updateModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true" style="@if($isModalUpdate) display: block; @endif">
        <div class="modal-dialog modal-dialog-centered">
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="updateModalLabel">
                            <span>Update Data Pegawai</span>
                        </h1>
                            <button wire:click="closeModalUpdate" type="button" class="btn-close focus-ring focus-ring-light" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 mb-4">
                                <label for="nama" class="form-label ms-1">Nama</label>
                                <div class="input-group input-group-sm">
                                    <input name="nama" type="text" wire:model="Updatenama" class="form-control focus-ring focus-ring-light border rounded-2 @error('nama') is-invalid @enderror" placeholder="Nama">
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
                                    <input name="NIP" type="text" wire:model="UpdateNIP" class="form-control focus-ring focus-ring-light border rounded-2 @error('NIP') is-invalid @enderror" placeholder="NIP">
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
                                <label for="jabatan" class="form-label ms-1">Jabatan</label>
                                <div class="input-group input-group-sm">
                                    <input name="jabatan" type="text" wire:model="Updatejabatan" class="form-control focus-ring focus-ring-light border rounded-2 @error('jabatan') is-invalid @enderror" placeholder="Jabatan">
                                    @error('jabatan')
                                        <div class="invalid-feedback ms-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <label for="unitKerja" class="form-label ms-1">Unit Kerja</label>
                                <div class="input-group input-group-sm">
                                    <input name="unitKerja" type="text" wire:model="UpdateunitKerja" class="form-control focus-ring focus-ring-light border rounded-2 @error('unitKerja') is-invalid @enderror" placeholder="Unit Kerja">
                                    @error('unitKerja')
                                        <div class="invalid-feedback ms-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-grid d-md-flex justify-content-md-end mb-2 mt-2">
                            <button wire:click.prevent="update()" type="submit" class="btn btn-success">
                            <span>Update</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
