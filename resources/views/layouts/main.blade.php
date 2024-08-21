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
            {{-- @auth --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
                aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <button class="btn dropdown-toggle border-0" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <button type="button" class="btn border-0">
                                    <a href="/user/profile" class="link-dark link-underline-opacity-0">
                                        <i class="fa-regular fa-user me-2"></i>Profil</a>
                                </button>
                            </li>
                            <li class="nav-item">
                                <form action="{{ url('logout') }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn border-0">
                                        <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            {{-- @endauth --}}
        </div>
    </nav>

    @yield('content')


    <footer class="main-footer bg-body-tertiary mt-auto">
        <div class="text-secondary text-center pt-3">
            <p>Copyright &copy; 2024 <strong>SIJAFUNG - Sistem Informasi Pelatihan Jabatan Fungsional</strong></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://kit.fontawesome.com/4718f9ef11.js" crossorigin="anonymous"></script>

    <script src="{{ asset('js/app.js') }}"></script>

    @livewireScripts
</body>

</html>
