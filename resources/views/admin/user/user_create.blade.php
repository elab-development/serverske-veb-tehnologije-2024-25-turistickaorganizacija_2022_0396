@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Kreiraj Korisnika</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_users') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Pogledaj Sve</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_user_create_submit') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Fotografija *</label>
                                    <div><input type="file" name="photo"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ime *</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Telefon *</label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Država *</label>
                                    <input type="text" class="form-control" name="country" value="{{ old('country') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Adresa *</label>
                                    <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Pokrajina *</label>
                                    <input type="text" class="form-control" name="state" value="{{ old('state') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Grad *</label>
                                    <input type="text" class="form-control" name="city" value="{{ old('city') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Poštanski broj *</label>
                                    <input type="text" class="form-control" name="zip" value="{{ old('zip') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lozinka *</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status *</label>
                                    <select name="status" class="form-control">
                                        <option value="1">Aktivan</option>
                                        <option value="0">Na čekanju</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Potvrdi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection