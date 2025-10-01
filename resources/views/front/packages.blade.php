@extends('front.layout.master')

@section('main_content')

<div class="page-top" style="background-image: url({{ asset('uploads/banner.jpg') }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Paketi</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Početna</a></li>
                        <li class="breadcrumb-item active">Paketi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="package pt_70 pb_50">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="package-sidebar">
                    <form action="{{ route('packages') }}" method="get">
                        <div class="widget">
                            <h2>Pretraga paketa</h2>
                            <div class="box">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="name" class="form-control" placeholder="Naziv paketa..." value="{{ $form_name }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget">
                            <h2>Filter po ceni</h2>
                            <div class="box">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="min_price" class="form-control" placeholder="Min" value="{{ $form_min_price }}">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="max_price" class="form-control" placeholder="Max" value="{{ $form_max_price }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget">
                            <h2>Filter po destinaciji</h2>
                            <div class="box">
                                <select name="destination_id" class="form-select">
                                    <option value="">Sve</option>
                                    @foreach($destinations as $destination)
                                        <option value="{{ $destination->id }}" @if($form_destination_id == $destination->id) selected @endif>{{ $destination->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="widget">
                            <h2>Filter po oceni</h2>
                            <div class="box">
                                <div class="form-check form-check-review form-check-review-1">
                                    <input name="review" class="form-check-input" type="radio" id="reviewRadiosAll" value="all" @if($form_review == 'all' || $form_review == null) checked @endif>
                                    <label class="form-check-label" for="reviewRadiosAll">
                                        Sve
                                    </label>
                                </div>
                                <div class="form-check form-check-review">
                                    <input name="review" class="form-check-input" type="radio" id="reviewRadios1" value="5" @if($form_review == '5') checked @endif>
                                    <label class="form-check-label" for="reviewRadios1" title="5 zvezdica">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </label>
                                </div>
                                <div class="form-check form-check-review">
                                    <input name="review" class="form-check-input" type="radio" id="reviewRadios2" value="4.5" @if($form_review == '4.5') checked @endif>
                                    <label class="form-check-label" for="reviewRadios2" title="4.5 zvezdica">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    </label>
                                </div>
                                <div class="form-check form-check-review">
                                    <input name="review" class="form-check-input" type="radio" id="reviewRadios3" value="4" @if($form_review == '4') checked @endif>
                                    <label class="form-check-label" for="reviewRadios3" title="4 zvezdice">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </label>
                                </div>
                                <div class="form-check form-check-review">
                                    <input name="review" class="form-check-input" type="radio" id="reviewRadios4" value="3.5" @if($form_review == '3.5') checked @endif>
                                    <label class="form-check-label" for="reviewRadios4" title="3.5 zvezdice">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    </label>
                                </div>
                                <div class="form-check form-check-review">
                                    <input name="review" class="form-check-input" type="radio" id="reviewRadios5" value="3" @if($form_review == '3') checked @endif>
                                    <label class="form-check-label" for="reviewRadios5" title="3 zvezdice">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </label>
                                </div>
                                <div class="form-check form-check-review">
                                    <input name="review" class="form-check-input" type="radio" id="reviewRadios6" value="2.5" @if($form_review == '2.5') checked @endif>
                                    <label class="form-check-label" for="reviewRadios6" title="2.5 zvezdice">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    </label>
                                </div>
                                <div class="form-check form-check-review">
                                    <input name="review" class="form-check-input" type="radio" id="reviewRadios7" value="2" @if($form_review == '2') checked @endif>
                                    <label class="form-check-label" for="reviewRadios7" title="2 zvezdice">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </label>
                                </div>
                                <div class="form-check form-check-review">
                                    <input name="review" class="form-check-input" type="radio" id="reviewRadios8" value="1.5" @if($form_review == '1.5') checked @endif>
                                    <label class="form-check-label" for="reviewRadios8" title="1.5 zvezdica">
                                        <i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    </label>
                                </div>
                                <div class="form-check form-check-review">
                                    <input name="review" class="form-check-input" type="radio" id="reviewRadios9" value="1" @if($form_review == '1') checked @endif>
                                    <label class="form-check-label" for="reviewRadios9" title="1 zvezdica">
                                        <i class="fas fa-star"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="filter-button">
                            <button class="btn btn-primary">Primeni filter</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-8 col-md-6">
                <div class="row">
                    @foreach($packages as $item)
                    <div class="col-lg-6 col-md-6">
                        <div class="item pb_25">
                            <div class="photo">
                                <a href="{{ route('package',$item->slug) }}"><img src="{{ asset('uploads/'.$item->featured_photo) }}" alt=""></a>
                                <div class="wishlist">
                                    <a href="{{ route('wishlist',$item->id) }}"><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="text">
                                <div class="price">
                                    ${{ $item->price }} @if($item->old_price != '')<del>${{ $item->old_price }}</del>@endif
                                </div>
                                <h2>
                                    <a href="{{ route('package',$item->slug) }}">{{ $item->name }}</a>
                                </h2>

                                @if($item->total_score || $item->total_rating)
                                <div class="review">
                                    @php
                                    $rating = $item->total_score/$item->total_rating;
                                    @endphp
                                    @for($i=1; $i<=5; $i++)
                                        @if($i <= $rating)
                                            <i class="fas fa-star"></i>
                                        @elseif($i-0.5 <= $rating)
                                            <i class="fas fa-star-half-alt"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                    ({{ $item->reviews->count() }} recenzija)
                                </div>
                                @else
                                <div class="review">
                                    @for($i=1; $i<=5; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                    ({{ $item->reviews->count() }} recenzija)
                                </div>
                                @endif

                                <div class="element">
                                    <div class="element-left">
                                        <i class="fas fa-plane-departure"></i> {{ $item->destination->name }}
                                    </div>
                                    <div class="element-right">
                                        <i class="fas fa-th-large"></i> {{ $item->package_amenities->count() }} sadržaja
                                    </div>
                                </div>
                                <div class="element">
                                    <div class="element-left">
                                        <i class="fas fa-users"></i> {{ $item->tours->count() }} tura
                                    </div>
                                    <div class="element-right">
                                        <i class="fas fa-clock"></i> {{ $item->package_itineraries->count() }} dana
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{ $packages->appends($_GET)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
