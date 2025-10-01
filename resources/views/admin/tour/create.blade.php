@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Kreiraj Turu</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_tour_index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Pogledaj Sve</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_tour_create_submit') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Izaberi Paket *</label>
                                            <select name="package_id" class="form-select">
                                                @foreach($packages as $package)
                                                <option value="{{ $package->id }}">{{ $package->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Ukupno Mesta *</label>
                                            <input type="text" name="total_seat" class="form-control" value="{{ old('total_seat') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Početak Ture *</label>
                                            <input id="datepicker1" type="text" name="tour_start_date" class="form-control" value="{{ old('tour_start_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Kraj Ture *</label>
                                            <input id="datepicker2" type="text" name="tour_end_date" class="form-control" value="{{ old('tour_end_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Kraj Rezervacija *</label>
                                            <input id="datepicker3" type="text" name="booking_end_date" class="form-control" value="{{ old('booking_end_date') }}">
                                        </div>
                                    </div>
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