@extends('front.layout.master')

@section('main_content')

<div class="page-top" style="background-image: url({{ asset('uploads/banner.jpg') }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Recenzije</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Početna</a></li>
                        <li class="breadcrumb-item active">Recenzije</li>
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
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>RB</th>
                                <th>Fotografija</th>
                                <th>Paket</th>
                                <th>Ocena</th>
                                <th>Komentar</th>
                            </tr>

                            @foreach($reviews as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('uploads/'.$item->package->featured_photo) }}" alt="" class="w-200">
                                </td>
                                <td>
                                    {{ $item->package->name }}<br>
                                    <a href="{{ route('package',$item->package->slug) }}" target="_blank" class="text-decoration-underline">Pogledaj detalje</a>
                                </td>
                                <td>{{ $item->rating }}</td>
                                <td>
                                    <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $loop->iteration }}">Komentar</a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Komentar</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zatvori"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3 row">
                                                <div class="col-md-12">
                                                    {!! $item->comment !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- // Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
