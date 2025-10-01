@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Paketi</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_package_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Dodaj novi</a>
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
                                            <th>Glavna fotografija</th>
                                            <th>Naziv</th>
                                            <th>Galerija</th>
                                            <th>Akcija</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($packages as $package)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/'.$package->featured_photo) }}" alt="" class="w_200">
                                            </td>
                                            <td>{{ $package->name }}</td>
                                            <td>
                                                <div>
                                                    <a href="{{ route('admin_package_amenities',$package->id) }}" class="btn btn-success mb-2">Sadržaji</a>
                                                    <a href="{{ route('admin_package_itineraries',$package->id) }}" class="btn btn-success mb-2">Itinerar</a>
                                                    <a href="{{ route('admin_package_faqs',$package->id) }}" class="btn btn-success mb-2">Česta pitanja</a>
                                                </div>
                                                <div>
                                                    <a href="{{ route('admin_package_photos',$package->id) }}" class="btn btn-success mb-2">Foto galerija</a>
                                                    <a href="{{ route('admin_package_videos',$package->id) }}" class="btn btn-success mb-2">Video galerija</a>
                                                </div>
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin_package_edit',$package->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin_package_delete',$package->id) }}" class="btn btn-danger" onClick="return confirm('Da li ste sigurni?');"><i class="fas fa-trash"></i></a>
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