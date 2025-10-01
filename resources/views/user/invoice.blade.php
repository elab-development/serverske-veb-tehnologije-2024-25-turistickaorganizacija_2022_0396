@extends('front.layout.master')

@section('main_content')

<div class="page-top" style="background-image: url({{ asset('uploads/banner.jpg') }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Račun: {{ $invoice_no }}</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Početna</a></li>
                        <li class="breadcrumb-item active">Račun: {{ $invoice_no }}</li>
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
                <div class="invoice-container" id="print_invoice">
                    <div class="invoice-top">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-border-0">
                                        <tbody>
                                            <tr>
                                                <td class="w-50">
                                                    <img src="uploads/logo.png" alt="" class="h-60">
                                                </td>
                                                <td class="w-50">
                                                    <div class="invoice-top-right">
                                                        <h4>Račun</h4>
                                                        <h5>Broj računa: {{ $invoice_no }}</h5>
                                                        <h5>Datum: {{ $booking->created_at->format('Y-m-d') }}</h5>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-middle">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-border-0">
                                        <tbody>
                                            <tr>
                                                <td class="w-50">
                                                    <div class="invoice-middle-left">
                                                        <h4>Račun za:</h4>
                                                        <p class="mb_0">{{ Auth::guard('web')->user()->name }}</p>
                                                        <p class="mb_0">{{ Auth::guard('web')->user()->email }}</p>
                                                        <p class="mb_0">{{ Auth::guard('web')->user()->phone }}</p>
                                                        <p class="mb_0">{{ Auth::guard('web')->user()->address }}</p>
                                                        <p class="mb_0">{{ Auth::guard('web')->user()->city }}, {{ Auth::guard('web')->user()->state }}, {{ Auth::guard('web')->user()->country }}, {{ Auth::guard('web')->user()->zip }}</p>
                                                    </div>
                                                </td>
                                                <td class="w-50">
                                                    <div class="invoice-middle-right">
                                                        <h4>Račun izdao:</h4>
                                                        <p class="mb_0">{{ env('APP_NAME') }}</p>
                                                        <p class="mb_0">{{ $admin_data->name }}</p>
                                                        <p class="mb_0 color_6d6d6d">{{ $admin_data->email }}</p>
                                                        <p class="mb_0">Status plaćanja: {{ $booking->payment_status }}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-item">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered invoice-item-table">
                                        <tbody>
                                            <tr>
                                                <th>RB</th>
                                                <th>Paket</th>
                                                <th>Početak ture</th>
                                                <th>Kraj ture</th>
                                                <th>Cena karte</th>
                                                <th>Broj karata</th>
                                                <th>Ukupna cena</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $booking->package->name }}</td>
                                                <td>{{ $booking->tour->tour_start_date }}</td>
                                                <td>{{ $booking->tour->tour_end_date }}</td>
                                                <td>${{ $booking->package->price }}</td>
                                                <td>{{ $booking->total_person }}</td>
                                                <td>${{ $booking->paid_amount }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-bottom">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-border-0">
                                        <tbody>
                                            <td class="w-70 invoice-bottom-payment">
                                                <h4>Način plaćanja</h4>
                                                <p>{{ $booking->payment_method }}</p>
                                            </td>
                                            <td class="w-30 tar invoice-bottom-total-box">
                                                <p class="mb_0"><b>Ukupno: ${{ $booking->paid_amount }}</b></p>
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="print-button mt_25">
                    <a onclick="printInvoice()" href="javascript:;" class="btn btn-primary"><i class="fas fa-print"></i> Štampaj</a>
                </div>
                <script>
                    function printInvoice() {
                        let body = document.body.innerHTML;
                        let data = document.getElementById('print_invoice').innerHTML;
                        document.body.innerHTML = data;
                        window.print();
                        document.body.innerHTML = body;
                    }
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
