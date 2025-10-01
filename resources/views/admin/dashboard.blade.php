@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kontrolna tabla</h1>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Ukupno slajdera</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_slider }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Ukupno utisaka</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_testimonial }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Ukupno članova tima</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_team_members }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Ukupno objava</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_posts }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Ukupno destinacija</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_destinations }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Ukupno paketa</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_packages }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Ukupno korisnika</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_users }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Ukupno pretplatnika</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_subscribers }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Ukupno tura</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_tours }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
