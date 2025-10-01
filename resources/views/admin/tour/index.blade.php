@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Ture</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_tour_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Dodaj Novu</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="example1">
                                    <thead>
                                        <tr>
                                            <th>RB</th>
                                            <th>Informacije o Paketu</th>
                                            <th>Početak Ture</th>
                                            <th>Kraj Ture</th>
                                            <th>Kraj Rezervacija</th>
                                            <th>Ukupno Mesta</th>
                                            <th>Rezervacije</th>
                                            <th>Akcije</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tours as $tour)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $tour->package->name }}<br>
                                                <a href="{{ route('package',$tour->package->slug) }}" target="_blank">Vidi Detalje</a>
                                            </td>
                                            <td>{{ $tour->tour_start_date }}</td>
                                            <td>{{ $tour->tour_end_date }}</td>
                                            <td>{{ $tour->booking_end_date }}</td>
                                            <td>
                                                @if($tour->total_seat == -1)
                                                Neograničeno
                                                @else
                                                {{ $tour->total_seat }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_tour_booking',[$tour->id,$tour->package->id]) }}" class="btn btn-success btn-sm">Informacije o Rezervacijama</a>
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin_tour_edit',$tour->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin_tour_delete',$tour->id) }}" class="btn btn-danger" onClick="return confirm('Da li ste sigurni?');"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection