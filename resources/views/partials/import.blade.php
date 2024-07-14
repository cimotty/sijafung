<div wire:ignore.self class="modal fade @if($isModalImport) show @endif" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true" style="@if($isModalImport) display: block; @endif">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    <span>Import</span>
                </h1>
                <button type="button" class="btn-close focus-ring focus-ring-light" data-bs-dismiss="modal"
                    aria-label="Close" wire:click="closeModalImport"></button>
            </div>
            <form wire:submit.prevent="importItems">
                <div class="modal-body">
                    <div class="input-group input-group-sm mt-2">
                        <input wire:model="fileImport" name="fileImport" type="file"
                            class="form-control focus-ring focus-ring-light border rounded-2 @error('fileImport') is-invalid @enderror"
                            id="fileImport">
                        @error('fileImport')
                            <div class="invalid-feedback ms-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-text ms-1 mt-2" id="basic-addon4">
                        Unduh <a class="link-body-emphasis link-underline link-underline-opacity-0"
                            href="{{ asset('storage/docs/contoh-format-import.xls') }}">contoh format excel</a>
                    </div>
                    <div class="d-grid d-md-flex justify-content-md-end mb-2 mt-3">
                        <button type="submit" class="btn btn-success">
                            <span>Import</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>