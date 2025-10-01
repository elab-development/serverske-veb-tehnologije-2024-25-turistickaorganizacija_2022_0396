@extends('front.layout.master')

@section('main_content')

<div class="page-top" style="background-image: url({{ asset('uploads/banner.jpg') }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Lista želja</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Početna</a></li>
                        <li class="breadcrumb-item active">Lista želja</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-content user-panel pt_70 pb_70">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <div class="card">
                    @include('user.sidebar')
                </div>
            </div>
            <div class="col-lg-9 col-md-12">
                @if($wishlist->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Redni broj</th>
                                <th>Fotografija</th>
                                <th>Paket</th>
                                <th class="w-100">Akcija</th>
                            </tr>
                            @foreach($wishlist as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('uploads/'.$item->package->featured_photo) }}" alt="" class="w-200">
                                </td>
                                <td>
                                    {{ $item->package->name }}
                                </td>
                                <td>
                                    <a href="{{ route('package',$item->package->slug) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('user_wishlist_delete',$item->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('Da li ste sigurni?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-danger">
                    <h4 class="alert-heading mb_0">Nema podataka</h4>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
