@extends('front.layout.master')

@section('main_content')
<div class="page-top" style="background-image: url({{ asset('uploads/banner.jpg') }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Profil</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Početna</a></li>
                        <li class="breadcrumb-item active">Izmeni profil</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content user-panel pt_70 pb_70">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <div class="card">
                    @include('user.sidebar')
                </div>
            </div>

            <div class="col-lg-9 col-md-12">
                <form action="{{ route('user_profile_submit') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Profilna fotografija</label>
                            <div class="form-group">
                                @if(Auth::guard('web')->user()->photo != '')
                                    <img src="{{ asset('uploads/'.Auth::guard('web')->user()->photo) }}" alt="" class="user-photo">
                                @else
                                    <img src="{{ asset('uploads/default.png') }}" alt="" class="user-photo">
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Promeni profilnu fotografiju</label>
                            <div class="form-group">
                                <input type="file" name="photo">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ime i prezime *</label>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" value="{{ Auth::guard('web')->user()->name }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email adresa *</label>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" value="{{ Auth::guard('web')->user()->email }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Broj telefona *</label>
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control" value="{{ Auth::guard('web')->user()->phone }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Država *</label>
                            <div class="form-group">
                                <input type="text" name="country" class="form-control" value="{{ Auth::guard('web')->user()->country }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Adresa *</label>
                            <div class="form-group">
                                <input type="text" name="address" class="form-control" value="{{ Auth::guard('web')->user()->address }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pokrajina/Regija *</label>
                            <div class="form-group">
                                <input type="text" name="state" class="form-control" value="{{ Auth::guard('web')->user()->state }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Grad *</label>
                            <div class="form-group">
                                <input type="text" name="city" class="form-control" value="{{ Auth::guard('web')->user()->city }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">ZIP kod *</label>
                            <div class="form-group">
                                <input type="text" name="zip" class="form-control" value="{{ Auth::guard('web')->user()->zip }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nova lozinka</label>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Ostavite prazno ako ne menjate">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ponovite lozinku</label>
                            <div class="form-group">
                                <input type="password" name="retype_password" class="form-control" placeholder="Ponovo unesite lozinku">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="form_update" type="submit" class="btn btn-primary" value="Sačuvaj izmene">
                            </div>
                        </div>
                    </div>
                </form>
            </div> <!-- /.col-lg-9 -->
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
</div> <!-- /.page-content -->
@endsection
