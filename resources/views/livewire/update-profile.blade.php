<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-4">
                <div class="card-body">
                    <p class="ms-1 mb-4">
                        <a href="/data-pegawai"
                            class="link-secondary link-opacity-75-hover link-underline-opacity-0 link-underline-opacity-0-hover">
                            <i class="fa-solid fa-chevron-left me-1"></i>Kembali
                        </a>
                    </p>

                    <div class="row justify-content-center mx-1 mb-1">
                        <div class="col-md-3 border rounded-3 py-4 text-center mb-4 me-md-5">
                            <i class="fa-regular fa-circle-user text-secondary text-opacity-25 mt-2"
                                style="font-size: 6rem;"></i>
                            <p class="mt-3 mb-1"><strong>Admin</strong></p>
                            <p><strong>admin@gmail.com</strong></p>
                        </div>
                        <div class="col-md-8 border rounded-3 px-4 py-2 mb-4">
                            <ul wire:ignore class="nav nav-underline" id="myTab" role="tablist">
                                <li class="nav-item me-2" role="presentation">
                                    <button class="nav-link link-secondary active" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile-tab-pane" type="button" role="tab"
                                        aria-controls="profile-tab-pane" aria-selected="true">
                                        <i class="fa-regular fa-address-card me-1"></i>Perbarui Profil
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link link-secondary" id="password-tab" data-bs-toggle="tab"
                                        data-bs-target="#password-tab-pane" type="button" role="tab"
                                        aria-controls="password-tab-pane" aria-selected="false">
                                        <i class="fa-solid fa-key me-1"></i>Ubah Kata Sandi
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div wire:ignore.self class="tab-pane fade show active rounded-bottom px-2 py-4"
                                    id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                    <form wire:submit.prevent="updateProfile">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-md-2 mb-1 ms-1 mb-md-0 ms-md-0"><strong>Nama</strong></div>
                                            <div class="col-12 col-md-10">
                                                <input wire:model.debounce.500ms="nama" type="text"
                                                    class="form-control focus-ring focus-ring-light border @error('nama') is-invalid @enderror"
                                                    id="inputNama">
                                                @error('nama')
                                                    <div class="invalid-feedback ms-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-3">
                                            <div class="col-md-2 mb-1 ms-1 mb-md-0 ms-md-0"><strong>Email</strong></div>
                                            <div class="col-12 col-md-10">
                                                <input wire:model.debounce.500ms="email" type="text"
                                                    class="form-control focus-ring focus-ring-light border @error('email') is-invalid @enderror"
                                                    id="inputEmail">
                                                @error('email')
                                                    <div class="invalid-feedback ms-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-grid d-md-flex justify-content-md-end">
                                            <button type="submit" class="btn btn-success btn-sm">Simpan
                                                Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                                <div wire:ignore.self class="tab-pane fade show rounded-bottom px-2 py-4"
                                    id="password-tab-pane" role="tabpanel" aria-labelledby="password-tab"
                                    tabindex="0">
                                    <form wire:submit.prevent="changePassword">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-lg-4 mb-1 ms-1 mb-md-0 ms-md-0"><strong>Kata sandi
                                                    lama</strong>
                                            </div>
                                            <div class="col-12 col-lg-8">
                                                <div class="input-group">
                                                    <input wire:model.debounce.500ms="kataSandiLama" type="password"
                                                        class="form-control focus-ring focus-ring-light border border-end-0 @error('kataSandiLama') is-invalid @enderror"
                                                        id="inputCurrentPassword">
                                                    <span wire:click="toggleShowPassword"
                                                        class="input-group-text bg-light-subtle">
                                                        <i class="fa-regular fa-eye" style="cursor: pointer"></i>
                                                    </span>
                                                    @error('kataSandiLama')
                                                        <div class="invalid-feedback ms-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-3">
                                            <div class="col-lg-4 mb-1 ms-1 mb-md-0 ms-md-0"><strong>Kata sandi
                                                    baru</strong>
                                            </div>
                                            <div class="col-12 col-lg-8">
                                                <input wire:model.debounce.500ms="kataSandi" type="password"
                                                    class="form-control focus-ring focus-ring-light border @error('kataSandi') is-invalid @enderror"
                                                    id="inputNewPassword">
                                                @error('kataSandi')
                                                    <div class="invalid-feedback ms-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-3">
                                            <div class="col-lg-4 mb-1 ms-1 mb-md-0 ms-md-0"><strong>Konfirmasi kata
                                                    sandi</strong></div>
                                            <div class="col-12 col-lg-8">
                                                <input wire:model.debounce.500ms="konfirmasiKataSandi" type="password"
                                                    class="form-control focus-ring focus-ring-light border @error('konfirmasiKataSandi') is-invalid @enderror"
                                                    id="inputConfirmPassword">
                                                @error('konfirmasiKataSandi')
                                                    <div class="invalid-feedback ms-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-grid d-lg-flex justify-content-lg-end">
                                            <button type="submit" class="btn btn-success btn-sm">Simpan
                                                Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Alert --}}
    @include('partials.alert-success')

</div>
