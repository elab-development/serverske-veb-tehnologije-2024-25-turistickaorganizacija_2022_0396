@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Pogodnosti {{ $package->name }}</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_package_index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nazad</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            
                            
                            <h4>Uključuje</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Redni broj</th>
                                            <th>Pogodnost</th>
                                            <th>Akcija</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($package_amenities_include as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $item->amenity->name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_package_amenity_delete',$item->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?')">Obriši</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>



                            <h4>Ne uključuje</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Redni broj</th>
                                            <th>Pogodnost</th>
                                            <th>Akcija</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($package_amenities_exclude as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $item->amenity->name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_package_amenity_delete',$item->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?')">Obriši</a>
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
                            <form action="{{ route('admin_package_amenity_submit',$package->id) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Pogodnost *</label>
                                    <select name="amenity_id" class="form-select">
                                        @foreach($amenities as $amenity)
                                        <option value="{{ $amenity->id }}">{{ $amenity->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <select name="type" class="form-select">
                                        <option value="Include">Uključuje</option>
                                        <option value="Exclude">Ne uključuje</option>
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