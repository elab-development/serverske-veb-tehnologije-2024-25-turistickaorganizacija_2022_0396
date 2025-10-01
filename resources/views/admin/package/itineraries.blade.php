@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Itinerari za {{ $package->name }}</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_package_index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nazad na prethodnu</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Postojeći itinerari</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>RB</th>
                                            <th>Naziv</th>
                                            <th>Opis</th>
                                            <th>Akcija</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($package_itineraries as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                {!! $item->description !!}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_package_itinerary_delete',$item->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('Da li ste sigurni?')">Obriši</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Dodaj itinerar</h4>
                            <form action="{{ route('admin_package_itinerary_submit',$package->id) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Naziv *</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Opis *</label>
                                    <textarea name="description" class="form-control editor" cols="30" rows="10"></textarea>
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