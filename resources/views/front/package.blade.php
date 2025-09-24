@extends('front.layout.master')

@section('main_content')
<div class="page-top page-top-package" style="background-image: url({{ asset('uploads/'.$package->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $package->name }}</h2>
                <h3><i class="fas fa-plane-departure"></i> {{ $package->destination->name }}</h3>

                @if($package->total_score || $package->total_rating)
                <div class="review">
                    <div class="set">
                        @php
                        $package_rating = $package->total_score/$package->total_rating;
                        @endphp
                        @for($i=1; $i<=5; $i++)
                            @if($i <= $package_rating)
                                <i class="fas fa-star"></i>
                            @elseif($i-0.5 <= $package_rating)
                                <i class="fas fa-star-half-alt"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <span>({{ $package_rating }} out of 5)</span>
                </div>
                @else
                <div class="review">
                    <div class="set">
                        @for($i=1; $i<=5; $i++)
                            <i class="far fa-star"></i>
                        @endfor
                    </div>
                    <span>(No Rating Found)</span>
                </div>
                @endif
                
                <div class="price">
                    ${{ $package->price }} @if($package->old_price != '')<del>${{ $package->old_price }}</del>@endif
                </div>
                <div class="person">
                    per person
                </div>
            </div>
        </div>
    </div>
</div>


<div class="package-detail pt_50 pb_50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">


                <div class="main-item mb_50">

                    <ul class="nav nav-tabs d-flex justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab-1" data-bs-toggle="tab" data-bs-target="#tab-1-pane" type="button" role="tab" aria-controls="tab-1-pane" aria-selected="true">Detail</button>
                        </li>

                        @if($package_itineraries->count() > 0)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-2" data-bs-toggle="tab" data-bs-target="#tab-2-pane" type="button" role="tab" aria-controls="tab-2-pane" aria-selected="false">Itinerary</button>
                        </li>
                        @endif

                        @if($package->map != '')
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-3" data-bs-toggle="tab" data-bs-target="#tab-3-pane" type="button" role="tab" aria-controls="tab-3-pane" aria-selected="false">Location</button>
                        </li>
                        @endif

                        @if($package_photos->count() > 0 || $package_videos->count() > 0)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-4" data-bs-toggle="tab" data-bs-target="#tab-4-pane" type="button" role="tab" aria-controls="tab-4-pane" aria-selected="false">Gallery</button>
                        </li>
                        @endif

                        @if($package_faqs->count() > 0)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-5" data-bs-toggle="tab" data-bs-target="#tab-5-pane" type="button" role="tab" aria-controls="tab-5-pane" aria-selected="false">FAQ</button>
                        </li>
                        @endif
                        
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-6" data-bs-toggle="tab" data-bs-target="#tab-6-pane" type="button" role="tab" aria-controls="tab-6-pane" aria-selected="false">Review</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-7" data-bs-toggle="tab" data-bs-target="#tab-7-pane" type="button" role="tab" aria-controls="tab-7-pane" aria-selected="false">Enquery</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-8" data-bs-toggle="tab" data-bs-target="#tab-8-pane" type="button" role="tab" aria-controls="tab-8-pane" aria-selected="false">Booking</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        
                        <div class="tab-pane fade show active" id="tab-1-pane" role="tabpanel" aria-labelledby="tab-1" tabindex="0">
                            <!-- Detail -->
                            <h2 class="mt_30">Detail</h2>
                            <p>
                                {!! $package->description !!}
                            </p>

                            @if($package_amenities_include->count() > 0)
                            <h2 class="mt_30">Includes</h2>
                            <div class="amenity">
                                <div class="row">
                                    @foreach($package_amenities_include as $item)
                                    <div class="col-lg-3 mb_15">
                                        <i class="fas fa-check"></i> {{ $item->amenity->name }}
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if($package_amenities_exclude->count() > 0)
                            <h2 class="mt_30">Excludes</h2>
                            <div class="amenity">
                                <div class="row">
                                    @foreach($package_amenities_exclude as $item)
                                    <div class="col-lg-3 mb_15">
                                        <i class="fas fa-times"></i> {{ $item->amenity->name }}
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            <!-- // Detail -->

                            
                        </div>

                        <div class="tab-pane fade" id="tab-2-pane" role="tabpanel" aria-labelledby="tab-2" tabindex="0">
                            <!-- Itinerary -->
                            <h2 class="mt_30">Itinerary</h2>
                            <div class="tour-plan">
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        @foreach($package_itineraries as $item)
                                        <tr>
                                            <td><b>{{ $item->name }}</b></td>
                                            <td>
                                                {!! $item->description !!}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <!-- // Itinerary -->
                        </div>
                        

                        <div class="tab-pane fade" id="tab-3-pane" role="tabpanel" aria-labelledby="tab-3" tabindex="0">
                            <!-- Location -->
                            <h2 class="mt_30">Location Map</h2>
                            <div class="location-map">
                                {!! $package->map !!}
                            </div>
                            <!-- // Location -->
                        </div>

                        <div class="tab-pane fade" id="tab-4-pane" role="tabpanel" aria-labelledby="tab-4" tabindex="0">
                            <!-- Gallery -->

                            @if($package_photos->count() > 0)
                            <h2 class="mt_30">
                                Photos
                            </h2>
                            <div class="photo-all">
                                <div class="row">
                                    @foreach($package_photos as $item)
                                    <div class="col-md-6 col-lg-3">
                                        <div class="item">
                                            <a href="{{ asset('uploads/'.$item->photo) }}" class="magnific">
                                                <img src="{{ asset('uploads/'.$item->photo) }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif


                            @if($package_videos->count() > 0)
                            <h2 class="mt_30">
                                Videos
                            </h2>
                            <div class="video-all">
                                <div class="row">
                                    @foreach($package_videos as $item)
                                    <div class="col-md-6 col-lg-6">
                                        <div class="item">
                                            <a class="video-button" href="http://www.youtube.com/watch?v={{ $item->video }}">
                                                <img src="http://img.youtube.com/vi/{{ $item->video }}/0.jpg" alt="">
                                                <div class="icon">
                                                    <i class="far fa-play-circle"></i>
                                                </div>
                                                <div class="bg"></div>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif


                            <!-- // Gallery -->
                        </div>


                        <div class="tab-pane fade" id="tab-5-pane" role="tabpanel" aria-labelledby="tab-5" tabindex="0">
                            <!-- FAQ -->
                            <h2 class="mt_30">Frequently Asked Questions</h2>
                            <div class="faq-package">
                                <div class="accordion" id="accordionExample">
                                    @foreach($package_faqs as $item)
                                    <div class="accordion-item mb_30">
                                        <h2 class="accordion-header" id="heading_{{ $loop->iteration }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse_{{ $loop->iteration }}">
                                                {{ $item->question }}
                                            </button>
                                        </h2>
                                        <div id="collapse_{{ $loop->iteration }}" class="accordion-collapse collapse" aria-labelledby="heading_{{ $loop->iteration }}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                {!! $item->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- // FAQ -->
                        </div>


                   



                        <div class="tab-pane fade" id="tab-7-pane" role="tabpanel" aria-labelledby="tab-7" tabindex="0">
                            <!-- Enquery -->
                            <h2 class="mt_30">Ask Your Question</h2>
                            <div class="enquery-form">
                                <form action="{{ route('enquery_form_submit',$package->id) }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Full Name" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="Email Address" name="email">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Phone Number" name="phone">
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control h-150" rows="3" placeholder="Message" name="message"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">
                                            Send Message
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- // Enquery -->
                        </div>


                        
                    
                </div>
                    

            </div>
        </div>
    </div>
</div>
@endsection