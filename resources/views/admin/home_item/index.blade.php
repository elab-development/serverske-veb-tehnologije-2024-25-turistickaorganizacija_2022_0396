@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Izmeni Početnu stavku</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_home_item_update',$home_item->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <h4>Sekcija opis</h4>
                                <div class="mb-3">
                                    <label class="form-label">Destinatinacija naslov *</label>
                                    <input type="text" class="form-control" name="destination_heading" value="{{ $home_item->destination_heading }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Destination podnaslov *</label>
                                    <input type="text" class="form-control" name="destination_subheading" value="{{ $home_item->destination_subheading }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Destination status</label>
                                    <select name="destination_status" class="form-select">
                                        <option value="Show" {{ $home_item->destination_status == 'Show' ? 'selected' : '' }}>Prikaži</option>
                                        <option value="Hide" {{ $home_item->destination_status == 'Hide' ? 'selected' : '' }}>Sakrij</option>
                                    </select>
                                </div>

                                <h4>Sekcija Funkcija</h4>
                                <div class="mb-3">
                                    <label class="form-label">Funkcija status</label>
                                    <select name="feature_status" class="form-select">
                                        <option value="Show" {{ $home_item->feature_status == 'Show' ? 'selected' : '' }}>Prikaži</option>
                                        <option value="Hide" {{ $home_item->feature_status == 'Hide' ? 'selected' : '' }}>Sakrij</option>
                                    </select>
                                </div>

                                <h4>Sekcija paket</h4>
                                <div class="mb-3">
                                    <label class="form-label">Paket naslov *</label>
                                    <input type="text" class="form-control" name="package_heading" value="{{ $home_item->package_heading }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Paket podnaslov *</label>
                                    <input type="text" class="form-control" name="package_subheading" value="{{ $home_item->package_subheading }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Paket status</label>
                                    <select name="package_status" class="form-select">
                                        <option value="Show" {{ $home_item->package_status == 'Show' ? 'selected' : '' }}>Prikaži</option>
                                        <option value="Hide" {{ $home_item->package_status == 'Hide' ? 'selected' : '' }}>Sakrij</option>
                                    </select>
                                </div>

                                <h4>Sekcija iskustvo korisnika</h4>
                                <div class="mb-3">
                                    <label class="form-label">Iskustvo korisnika nalsov *</label>
                                    <input type="text" class="form-control" name="testimonial_heading" value="{{ $home_item->testimonial_heading }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Iskustvo korisnika podnaslov *</label>
                                    <input type="text" class="form-control" name="testimonial_subheading" value="{{ $home_item->testimonial_subheading }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Iskustvo korisnika pozadina</label>
                                    <div>
                                        <img src="{{ asset('uploads/'.$home_item->testimonial_background) }}" alt="" class="w_200">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Iskustvo korisnika promeni pozadinu</label>
                                    <div>
                                        <input type="file" name="testimonial_background">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Iskustvo korisnika status</label>
                                    <select name="testimonial_status" class="form-select">
                                        <option value="Show" {{ $home_item->testimonial_status == 'Show' ? 'selected' : '' }}>Prikaži</option>
                                        <option value="Hide" {{ $home_item->testimonial_status == 'Hide' ? 'selected' : '' }}>Sakrij</option>
                                    </select>
                                </div>

                                <h4>Sekcija blog</h4>
                                <div class="mb-3">
                                    <label class="form-label">Blog naslov *</label>
                                    <input type="text" class="form-control" name="blog_heading" value="{{ $home_item->blog_heading }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Blog podnaslov *</label>
                                    <input type="text" class="form-control" name="blog_subheading" value="{{ $home_item->blog_subheading }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Blog status</label>
                                    <select name="blog_status" class="form-select">
                                        <option value="Show" {{ $home_item->blog_status == 'Show' ? 'selected' : '' }}>Prikaži</option>
                                        <option value="Hide" {{ $home_item->blog_status == 'Hide' ? 'selected' : '' }}>Sakrij</option>
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