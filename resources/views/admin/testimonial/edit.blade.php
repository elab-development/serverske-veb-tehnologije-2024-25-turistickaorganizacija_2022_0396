@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Izmeni iskustvo</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_testimonial_index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Pogledaj sve</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_testimonial_edit_submit',$testimonial->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Trenutna fotografija</label>
                                    <div><img src="{{ asset('uploads/'.$testimonial->photo) }}" alt="" class="w_200"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Promeni fotografiju</label>
                                    <div><input type="file" name="photo"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ime i prezime *</label>
                                    <input type="text" class="form-control" name="name" value="{{ $testimonial->name }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Pozicija *</label>
                                    <input type="text" class="form-control" name="designation" value="{{ $testimonial->designation }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Komentar *</label>
                                    <textarea name="comment" class="form-control h_100" cols="30" rows="10">{{ $testimonial->comment }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Ažuriraj</button>
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