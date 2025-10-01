@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Česta pitanja za {{ $package->name }}</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_package_index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nazad na prethodnu</a>
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
                                            <th>RB</th>
                                            <th>Pitanje</th>
                                            <th>Akcija</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($package_faqs as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $item->question }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_package_faq_delete',$item->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('Da li ste sigurni?')">Obriši</a>
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
                            <form action="{{ route('admin_package_faq_submit',$package->id) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Pitanje *</label>
                                    <input type="text" name="question" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Odgovor *</label>
                                    <textarea name="answer" class="form-control h_200" rows="5"></textarea>
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