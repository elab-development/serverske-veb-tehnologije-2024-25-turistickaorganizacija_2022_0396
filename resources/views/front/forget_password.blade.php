@extends('front.layout.master')

@section('main_content')

        <div class="page-top" style="background-image: url({{ asset('uploads/banner.jpg')}})">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Zaboravljena lozinka</h2>
                        <div class="breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Početna</a></li>
                                <li class="breadcrumb-item active">Zaboravljena lozinka</li>
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
                            <div class="mb-3">
                                <label for="" class="form-label">Email adresa</label>
                                <input type="text" class="form-control">
                            </div>
                            <form action="" method="post">
                                @csrf
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary bg-website">
                                    Pošalji
                                </button>
                                <a href="{{ route('login') }}" class="primary-color">Nazad na login stranicu</a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection