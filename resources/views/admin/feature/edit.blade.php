@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Izmeni Funkciju</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_feature_index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Vidi sve</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_feature_edit_submit',$feature->id) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Trenutna ikonica</label>
                                    <div>
                                        <i class="{{ $feature->icon }} fz_30"></i>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Promeni ikonicu *</label>
                                    <input type="text" class="form-control" name="icon" value="{{ $feature->icon }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nalov *</label>
                                    <input type="text" class="form-control" name="heading" value="{{ $feature->heading }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Opis *</label>
                                    <textarea name="description" class="form-control h_100" cols="30" rows="10">{{ $feature->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Sačuvaj</button>
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