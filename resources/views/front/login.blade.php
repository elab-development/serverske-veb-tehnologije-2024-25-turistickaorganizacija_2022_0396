@extends('front.layout.master')

@section('main_content')

<div class="page-top" style="background-image: url({{ asset('uploads/banner.jpg')}})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Prijava</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Početna</a></li>
                        <li class="breadcrumb-item active">Prijava</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content pt_70 pb_70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="login-form">
                    <form action="{{ route('login_submit') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Email adresa</label>
                            <input type="text" class="form-control" name="email" placeholder="Unesite svoju email adresu">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Lozinka</label>
                            <input type="password" class="form-control" name="password" placeholder="Unesite lozinku">
                        </div>
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary bg-website">
                                Prijavi se
                            </button>
                            <a href="{{ route('forget_password') }}" class="primary-color">Zaboravljena lozinka?</a>
                        </div>
                    </form>
                    <div class="mb-3 text-center">
                        <a href="{{ route('registration') }}" class="primary-color">Nemate nalog? Registrujte se!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
