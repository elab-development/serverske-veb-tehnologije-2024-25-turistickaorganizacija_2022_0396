@extends('front.layout.master')

@section('main_content')

<div class="page-top" style="background-image: url({{ asset('uploads/banner.jpg') }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Napravi nalog</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Početna</a></li>
                        <li class="breadcrumb-item active">Napravi nalog</li>
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
                    <form action="{{ route('registration_submit') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Ime *</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email adresa *</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lozinka *</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Potvrdi lozinku *</label>
                            <input type="password" class="form-control" name="retype_password" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary bg-website w-100">
                                Napravi nalog
                            </button>
                        </div>
                    </form>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="primary-color">Već imate nalog? Ulogujte se!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
