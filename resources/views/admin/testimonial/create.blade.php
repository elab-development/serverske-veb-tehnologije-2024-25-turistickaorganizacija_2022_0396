@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Kreiraj Iskustvo</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_testimonial_index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Pogledaj Sve</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_testimonial_create_submit') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Fotografija *</label>
                                    <div><input type="file" name="photo"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ime i Prezime *</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Pozicija *</label>
                                    <input type="text" class="form-control" name="designation" value="{{ old('designation') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Komentar *</label>
                                    <textarea name="comment" class="form-control h_100" cols="30" rows="10">{{ old('comment') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Pošalji</button>
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