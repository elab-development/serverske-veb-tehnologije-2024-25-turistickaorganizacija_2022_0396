@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Izmeni destinaciju</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_destination_index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Vidi sve</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_destination_edit_submit',$destination->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">a
                                    <label class="form-label">Istaknuta fotografija</label>
                                    <div><img src="{{ asset('uploads/'.$destination->featured_photo) }}" alt="" class="w_200"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Izmeni istaknutu fotografiju</label>
                                    <div><input type="file" name="featured_photo"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Naziv *</label>
                                            <input type="text" class="form-control" name="name" value="{{ $destination->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Slug *</label>
                                            <input type="text" class="form-control" name="slug" value="{{ $destination->slug }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Opis *</label>
                                    <textarea name="description" class="form-control editor" cols="30" rows="10">{{ $destination->description }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Zemlja</label>
                                            <input type="text" class="form-control" name="country" value="{{ $destination->country }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Jezik</label>
                                            <input type="text" class="form-control" name="language" value="{{ $destination->language }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Valuta</label>
                                            <input type="text" class="form-control" name="currency" value="{{ $destination->currency }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Područje</label>
                                            <input type="text" class="form-control" name="area" value="{{ $destination->area }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Vremenska zona</label>
                                            <input type="text" class="form-control" name="timezone" value="{{ $destination->timezone }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Viza</label>
                                    <textarea name="visa_requirement" class="form-control editor" cols="30" rows="10">{{ $destination->visa_requirement }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Aktivnosti</label>
                                    <textarea name="activity" class="form-control editor" cols="30" rows="10">{{ $destination->activity }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Najbolje vreme za posetu</label>
                                    <textarea name="best_time" class="form-control editor" cols="30" rows="10">{{ $destination->best_time }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Zdravlje & Bezbednost</label>
                                    <textarea name="health_safety" class="form-control editor" cols="30" rows="10">{{ $destination->health_safety }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mapa (kod)</label>
                                    <textarea name="map" class="form-control h_100" cols="30" rows="10">{{ $destination->map }}</textarea>
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