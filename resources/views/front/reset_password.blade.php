@extends('front.layout.master')

@section('main_content')

<div class="page-top" style="background-image: url({{ asset('uploads.jpg') }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Resetuj lozinku</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Početna</a></li>
                        <li class="breadcrumb-item active">Resetuj lozinku</li>
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
                    <form action="{{ route('reset_password_submit',[$token,$email]) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Lozinka</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Ponovo unestite lozinku</label>
                            <input type="password" class="form-control" name="retype_password">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary bg-website">
                                Potvrdi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection