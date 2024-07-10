<div class="modal fade @if($isModalDelete) show @endif" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" style="@if($isModalDelete) display: block; @endif">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button wire:click="closeModalDelete()" type="button" class="btn-close focus-ring focus-ring-light" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center text-secondary">
                <div class="row mx-2">
                    <div class="col">
                        <i class="fa-solid fa-trash-can fs-1"></i>
                    </div>
                    <span class="mt-4 fs-6">
                        @if($deleteType == 'single')
                            Apakah anda yakin ingin menghapus data ini?
                        @else
                            Apakah anda yakin ingin menghapus data yang dipilih?
                        @endif
                    </span>
                </div>
                <div class="d-grid d-md-flex justify-content-md-center mb-3 mt-4 mx-3">
                    <button wire:click.prevent="@if($deleteType == 'single') delete() @else deleteSelectedRows() @endif" type="button" class="btn btn-danger mb-2">
                        <span>Hapus</span>
                    </button>
                    <button wire:click="closeModalDelete()" type="button" class="btn btn-secondary mb-2 ms-md-2" data-bs-dismiss="modal" aria-label="Close">
                        <span>Batal</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>