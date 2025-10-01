@extends('front.layout.master')

@section('main_content')

<div class="page-top" style="background-image: url({{ asset('uploads/banner.jpg') }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Kupovine</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Početna</a></li>
                        <li class="breadcrumb-item active">Kupovine</li>
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
                                <th>Redni broj</th>
                                <th>Broj računa</th>
                                <th>Ukupno osoba</th>
                                <th>Uplaćen iznos</th>
                                <th>Način plaćanja</th>
                                <th>Status plaćanja</th>
                                <th class="w-100">Akcije</th>
                            </tr>
                            @foreach($all_data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->invoice_no }}</td>
                                <td>{{ $item->total_person }}</td>
                                <td>${{ $item->paid_amount }}</td>
                                <td>{{ $item->payment_method }}</td>
                                <td>
                                    @if($item->payment_status == 'Completed')
                                    <div class="badge bg-success">Završeno</div>
                                    @else
                                    <div class="badge bg-danger">Na čekanju</div>
                                    @endif
                                </td>
                                <td>
                                    <a href="" class="btn btn-secondary btn-sm mb-1 w-100-p" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $loop->iteration }}">Detalji</a>
                                    <a href="{{ route('user_invoice',$item->invoice_no) }}" class="btn btn-secondary btn-sm w-100-p">Račun</a>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detalji kupovine</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zatvori"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3 row modal-seperator">
                                                <div class="col-md-5"><b>Broj računa:</b></div>
                                                <div class="col-md-7">{{ $item->invoice_no }}</div>
                                            </div>
                                            <div class="mb-3 row modal-seperator">
                                                <div class="col-md-5"><b>Paket:</b></div>
                                                <div class="col-md-7">
                                                    <b>Naziv:</b> {{ $item->package->name }}<br>
                                                    <a href="{{ route('package',$item->package->slug) }}" target="_blank">Prikaži detalje</a>
                                                </div>
                                            </div>
                                            <div class="mb-3 row modal-seperator">
                                                <div class="col-md-5"><b>Tura:</b></div>
                                                <div class="col-md-7">
                                                    <b>Početak:</b> {{ $item->tour->tour_start_date }}<br>
                                                    <b>Kraj:</b> {{ $item->tour->tour_end_date }}
                                                </div>
                                            </div>
                                            <div class="mb-3 row modal-seperator">
                                                <div class="col-md-5"><b>Ukupno osoba:</b></div>
                                                <div class="col-md-7">{{ $item->total_person }}</div>
                                            </div>
                                            <div class="mb-3 row modal-seperator">
                                                <div class="col-md-5"><b>Uplaćen iznos:</b></div>
                                                <div class="col-md-7">${{ $item->paid_amount }}</div>
                                            </div>
                                            <div class="mb-3 row modal-seperator">
                                                <div class="col-md-5"><b>Način plaćanja:</b></div>
                                                <div class="col-md-7">{{ $item->payment_method }}</div>
                                            </div>
                                            <div class="mb-3 row modal-seperator">
                                                <div class="col-md-5"><b>Status plaćanja:</b></div>
                                                <div class="col-md-7">
                                                    @if($item->payment_status == 'Completed')
                                                    <div class="badge bg-success">Završeno</div>
                                                    @else
                                                    <div class="badge bg-danger">Na čekanju</div>
                                                    @endif
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
