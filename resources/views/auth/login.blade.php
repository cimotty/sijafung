<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIJAFUNG - Sistem Informasi Pelatihan Jabatan Fungsional</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @livewireStyles
</head>

<body class="d-flex flex-column min-vh-100 bg-body-tertiary">
    <nav class="navbar navbar-expand-sm sticky-top bg-white border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand fw-semibold" href="/">
                <img src="{{ asset('img/bengkulu-logo.png') }}" class="img-fluid" style="width: 50px" alt="">
                SIJAFUNG - Sistem Informasi Pelatihan Jabatan Fungsional
            </a>            
        </div>
    </nav>

    <div class="px-2 py-3 mt-auto">
        <div class="d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card rounded-3">
                    <div class="card-body mx-4 my-4">
                        <h3 class="card-title text-center mb-5">Masuk</h3>

                        {{-- Alert Error --}}
                        {{-- @include('partials.alert-error') --}}

                        <form action="{{url('proses_login')}}" method="POST">
                            @csrf
                            <div class="input-group mb-4">
                                <input name="email" type="text" class="form-control focus-ring focus-ring-light border"
                                    placeholder="Alamat email" autofocus required>
                            </div>
                            <div class="input-group mb-5">
                                <input name="password" id="password" type="password"
                                    class="form-control focus-ring focus-ring-light border border-end-0"
                                    placeholder="Kata sandi">
                                <span class="input-group-text bg-light-subtle"><i id="toggle-visibility"
                                        class="fa-regular fa-eye-slash" style="cursor:pointer"></i></span>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="main-footer bg-body-tertiary mt-auto">
        <div class="text-secondary text-center pt-3">
            <p>Copyright &copy; 2023 <strong>SIJAFUNG - Sistem Informasi Pelatihan Jabatan Fungsional</strong></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://kit.fontawesome.com/4718f9ef11.js" crossorigin="anonymous"></script>

    <script src="{{ asset('js/app.js') }}"></script>

    @livewireScripts
</body>

</html>

