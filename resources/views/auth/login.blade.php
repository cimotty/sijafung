@extends('layouts.main')

@section('content')
    <div class="px-2 py-3 mt-auto">
        <div class="d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card rounded-3">
                    <div class="card-body mx-4 my-4">
                        <h3 class="card-title text-center mb-5">Masuk</h3>

                        {{-- Alert Error --}}
                        {{-- @include('partials.alert-error') --}}

                        <form action="/login" method="POST">
                            @csrf
                            <div class="input-group mb-4">
                                <input name="email" type="text" class="form-control focus-ring focus-ring-light border"
                                    placeholder="Alamat email" autofocus required>
                            </div>
                            <div class="input-group mb-5">
                                <input name="password" id="password" type="password"
                                    class="form-control focus-ring focus-ring-light border border-end-0"
                                    placeholder="Kata sandi">
                                <span class="input-group-text bg-light-subtle"><i id="toogle-visibility"
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
@endsection
