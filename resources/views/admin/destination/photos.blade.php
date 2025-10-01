@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Fotografije {{ $destination->name }}</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_destination_index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nazad</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Redni broj</th>
                                            <th>Fotografija</th>
                                            <th>Akcija</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($destination_photos as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/'.$item->photo) }}" alt="" class="w_100">
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_destination_photo_delete',$item->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('Da li ste sigurni?')">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_destination_photo_submit',$destination->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Fotografija *</label>
                                    <div><input type="file" name="photo"></div>
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