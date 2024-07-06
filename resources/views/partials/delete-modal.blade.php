<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close focus-ring focus-ring-light" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body text-center text-secondary">
                <div class="row mx-2">
                    {{-- @if ($showDeleteModal) --}}
                    <div class="col">
                        <i class="fa-solid fa-trash-can fs-1"></i>
                    </div>
                    <span class="mt-4 fs-6">Apakah anda yakin ingin menghapus ini?</span>
                    {{-- @else
                        <div class="col">
                            <i class="fa-solid fa-trash-can fs-1"></i>
                        </div>
                        <span class="mt-4 fs-6">Apakah anda yakin ingin menghapus data yang dipilih?</span>
                    @endif --}}
                </div>
                <div class="d-grid d-md-flex justify-content-md-center mb-3 mt-4 mx-3">
                    {{-- @if ($showDeleteModal) --}}
                    <button wire:click.prevent="deleteItem" type="button" class="btn btn-danger mb-2">
                        <span>Hapus</span>
                    </button>
                    {{-- @else
                        <button wire:click.prevent="deleteSelectedRows" type="button" class="btn btn-danger mb-2">
                            <span>Hapus</span>
                        </button>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
