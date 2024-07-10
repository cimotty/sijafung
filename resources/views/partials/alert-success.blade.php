@if (session()->has('success'))
    <div class="d-flex position-fixed bottom-0 end-0 me-2" id="alert">
        <div class="shadow alert alert-success alert-dismissible" role="alert">
            <div>
                <i class="fa-solid fa-circle-check fa-bounce me-1"></i>
                <strong>Berhasil</strong>
                <button type="button" class="btn-close focus-ring focus-ring-light" data-bs-dismiss="alert" id="alertCloseButton"></button>
            </div>
            <div class="pt-2 lh-lg">
                {!! session('success') !!}
            </div>
        </div>
    </div>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        if ($('#alert').length) {
            setTimeout(function() {
                $('#alertCloseButton').click();
            }, 5000);
        }
    });
</script>
