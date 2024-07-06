@if (session()->has('successMessage'))
    <div class="d-flex position-fixed bottom-0 end-0 me-2" id="alert">
        <div class="shadow alert alert-success alert-dismissible" role="alert">
            <div>
                <i class="fa-solid fa-circle-check fa-bounce me-1"></i>
                <strong>Berhasil</strong>
                <button type="button" class="btn-close focus-ring focus-ring-light" data-bs-dismiss="alert"></button>
            </div>
            <div class="pt-2 lh-lg">
                {!! session('successMessage') !!}
            </div>
        </div>
    </div>
@endif
