@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Destinacije</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_destination_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Dodaj</a>
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
                                            <th>Redni broj</th>
                                            <th>Istaknuta fotografija</th>
                                            <th>Naziv</th>
                                            <th>Galerija</th>
                                            <th>Akcija</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($destinations as $destination)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/'.$destination->featured_photo) }}" alt="" class="w_200">
                                            </td>
                                            <td>{{ $destination->name }}</td>
                                            <td>
                                                <a href="{{ route('admin_destination_photos',$destination->id) }}" class="btn btn-success btn-sm">Galerija fotografija</a>
                                                <a href="{{ route('admin_destination_videos',$destination->id) }}" class="btn btn-success btn-sm">Video galerija</a>
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin_destination_edit',$destination->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin_destination_delete',$destination->id) }}" class="btn btn-danger" onClick="return confirm('Da li ste sigurni?');"><i class="fas fa-trash"></i></a>
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