@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Iskustva Korisnika</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_testimonial_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Dodaj Novo</a>
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
                                            <th>Fotografija</th>
                                            <th>Ime i Prezime</th>
                                            <th>Pozicija</th>
                                            <th>Akcije</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($testimonials as $testimonial)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/'.$testimonial->photo) }}" alt="" class="w_100">
                                            </td>
                                            <td>{{ $testimonial->name }}</td>
                                            <td>{{ $testimonial->designation }}</td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin_testimonial_edit',$testimonial->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin_testimonial_delete',$testimonial->id) }}" class="btn btn-danger" onClick="return confirm('Da li ste sigurni?');"><i class="fas fa-trash"></i></a>
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