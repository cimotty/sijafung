<div class="modal fade" id="updateModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="updateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <span>Ubah Data Pegawai</span>
                    </h1>
                    <button type="button" class="btn-close focus-ring focus-ring-light" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <label for="nama" class="form-label ms-1">Nama</label>
                            <div class="input-group input-group-sm">
                                <input name="nama" type="text"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('nama')) is-invalid @enderror"
                                    id="nama" placeholder="Nama">
                                @error('nama')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label for="nip" class="form-label ms-1">NIP</label>
                            <div class="input-group input-group-sm">
                                <input name="nip" type="text"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('nip') is-invalid @enderror"
                                    id="nip" placeholder="NIP">
                                @error('nip')
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
                                <input name="jabatan" type="text"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('jabatan') is-invalid @enderror"
                                    id="jabatan" placeholder="Jabatan">
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
                                <input name="unitKerja" type="text"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('unitKerja') is-invalid @enderror"
                                    id="unitKerja" placeholder="Unit Kerja">
                                @error('unitKerja')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-grid d-md-flex justify-content-md-end mb-2 mt-2">
                        <button type="submit" class="btn btn-success">
                            <span>Simpan perubahan</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
