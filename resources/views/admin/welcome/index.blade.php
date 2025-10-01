@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Izmeni stranu dobrodošlice</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_welcome_item_update',$welcome_item->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label class="form-label">Postojeća fotografija</label>
                                            <div><img src="{{ asset('uploads/'.$welcome_item->photo) }}" alt="" class="w_300"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Promeni fotografiju</label>
                                            <div><input type="file" name="photo"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Trenutni video</label>
                                            <iframe class="iframe1" width="560" height="315" src="https://www.youtube.com/embed/{{ $welcome_item->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Video (YouTube Id) *</label>
                                            <input type="text" class="form-control" name="video" value="{{ $welcome_item->video }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Naslov *</label>
                                    <input type="text" class="form-control" name="heading" value="{{ $welcome_item->heading }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Opis *</label>
                                    <textarea name="description" class="form-control editor" cols="30" rows="10">{{ $welcome_item->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tekst na dugmetu</label>
                                    <input type="text" class="form-control" name="button_text" value="{{ $welcome_item->button_text }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Link dugmeta</label>
                                    <input type="text" class="form-control" name="button_link" value="{{ $welcome_item->button_link }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Show" {{ $welcome_item->status == 'Show' ? 'selected' : '' }}>Prikaži</option>
                                        <option value="Hide" {{ $welcome_item->status == 'Hide' ? 'selected' : '' }}>Sakrij</option>
                                    </select>
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
