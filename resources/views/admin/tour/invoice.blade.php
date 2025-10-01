@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="invoice">
                <h3>Faktura Broj: {{ $booking->invoice_no }}</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Broj fakture: </td>
                                <td>{{ $booking->invoice_no }}</td>
                            </tr>
                            <tr>
                                <td>Kupac: </td>
                                <td>
                                    Ime: {{ $booking->user->name }}<br>
                                    Email: {{ $booking->user->email }}<br>
                                    Telefon: {{ $booking->user->phone }}
                                </td>
                            </tr>
                            <tr>
                                <td>Prodavac: </td>
                                <td>
                                    Ime: {{ Auth::guard('admin')->user()->name }}<br>
                                    Email: {{ Auth::guard('admin')->user()->email }}
                                </td>
                            </tr>
                            <tr>
                                <td>Informacije o putovanju: </td>
                                <td>
                                    Datum početka: {{ $booking->tour->tour_start_date }}<br>
                                    Datum završetka: {{ $booking->tour->tour_end_date }}<br>
                                </td>
                            </tr>
                            <tr>
                                <td>Informacije o paketu: </td>
                                <td>
                                    Naziv: {{ $booking->package->name }}<br>
                                </td>
                            </tr>
                            <tr>
                                <td>Datum rezervacije: </td>
                                <td>{{ $booking->created_at->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <td>Način plaćanja: </td>
                                <td>{{ $booking->payment_method }}</td>
                            </tr>
                            <tr>
                                <td>Status plaćanja: </td>
                                <td>
                                    @if($booking->payment_status == 'Completed')
                                    Završeno
                                    @else
                                    Na čekanju
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Ukupno osoba: </td>
                                <td>{{ $booking->total_person }}</td>
                            </tr>
                            <tr>
                                <td>Plaćeni iznos: </td>
                                <td>${{ $booking->paid_amount }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-md-right">
                    <a href="javascript:window.print();" class="btn btn-warning btn-icon icon-left text-white print-invoice-button"><i class="fas fa-print"></i> Štampaj</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection