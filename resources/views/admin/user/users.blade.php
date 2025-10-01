@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Korisnici</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_user_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Dodaj novog</a>
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
                                            <th>Fotografija</th>
                                            <th>Ime</th>
                                            <th>Email</th>
                                            <th>Telefon</th>
                                            <th>Adresa</th>
                                            <th>Status</th>
                                            <th>Akcija</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($item->photo != '')
                                                <img src="{{ asset('uploads/'.$item->photo) }}" alt="" class="w_100">
                                                @else
                                                <img src="{{ asset('uploads/default.png') }}" alt="" class="w_100">
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                {{ $item->email }}
                                            </td>
                                            <td>
                                                {{ $item->phone }}
                                            </td>
                                            <td>
                                                Država: {{ $item->country }}<br>
                                                Adresa: {{ $item->address }}<br>
                                                Pokrajina/Region: {{ $item->state }}<br>
                                                Grad: {{ $item->city }}<br>
                                                Poštanski broj: {{ $item->zip }}
                                            </td>
                                            <td>
                                                @if($item->status == 1)
                                                <span class="badge badge-success">Aktivan</span>
                                                @else
                                                <span class="badge badge-danger">Na čekanju</span>
                                                @endif
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin_user_edit',$item->id) }}" class="btn btn-primary" title="Izmeni"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin_user_delete',$item->id) }}" class="btn btn-danger" onClick="return confirm('Da li ste sigurni?');" title="Obriši"><i class="fas fa-trash"></i></a>
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
