@extends('front.layout.master')

@section('main_content')

 <div class="page-top" style="background-image: url({{asset ('uploads/banner.jpg') }})">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>About Us</h2>
                        <div class="breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active">About Us</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="special pt_70 pb_70">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="full-section">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="left-side">
                                        <div class="inner">
                                            <h3>Welcome to TripSummit</h3>
                                            <p>
                                                At TripSummit, our mission is to turn travel dreams into reality by providing personalized and memorable experiences. We leverage our expertise and trusted partners to ensure every trip is seamless and enjoyable.
                                            </p>
                                            <p>
                                                We believe travel fosters personal growth and cultural understanding. Our goal is to help clients explore new destinations and connect with diverse cultures. We promote sustainable travel to positively impact communities and preserve our planet’s beauty.
                                            </p>
                                            <div class="button-style-1 mt_20">
                                                <a href="">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="right-side" style="background-image: url(uploads/about-1.jpg);">
                                        <a class="video-button" href="https://www.youtube.com/watch?v=S4DI3Bve_bQ"><span></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="why-choose pt_70">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="inner pb_70">
                            <div class="icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="text">
                                <h2>Explore Destinations</h2>
                                <p>
                                    Discover amazing places to visit, from bustling cities to serene beaches, and plan your perfect adventure with our expert guides.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner pb_70">
                            <div class="icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="text">
                                <h2>Custom Travel Packages</h2>
                                <p>
                                    Create custom travel packages designed to your accommodations, activities & transportation for a smooth journey.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner pb_70">
                            <div class="icon">
                                <i class="fas fa-share-alt"></i>
                            </div>
                            <div class="text">
                                <h2>Travel Deals & Discounts</h2>
                                <p>
                                    Take advantage of our exclusive travel deals and discounts, ensuring you get the best value for your dream vacation.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="counter-section pt_70 pb_70">
            <div class="container">
                <div class="row counter-items">
                    <div class="col-md-3 counter-item">
                        <div class="counter">40</div>
                        <div class="text">Destinations</div>
                    </div>
                    <div class="col-md-3 counter-item">
                        <div class="counter">1200</div>
                        <div class="text">Clients</div>
                    </div>
                    <div class="col-md-3 counter-item">
                        <div class="counter">130</div>
                        <div class="text">Packages</div>
                    </div>
                    <div class="col-md-3 counter-item">
                        <div class="counter">60</div>
                        <div class="text">Feedbacks</div>
                    </div>
                </div>
            </div>
        </div>


        
        
        <div class="footer pt_70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="item pb_50">
                            <h2 class="heading">Important Pages</h2>
                            <ul class="useful-links">
                                <li><a href="index.html"><i class="fas fa-angle-right"></i> Home</a></li>
                                <li><a href="destinations.html"><i class="fas fa-angle-right"></i> Destinations</a></li>
                                <li><a href="packages.html"><i class="fas fa-angle-right"></i> Packages</a></li>
                                <li><a href="blog.html"><i class="fas fa-angle-right"></i> Blog</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="item pb_50">
                            <h2 class="heading">Useful Links</h2>
                            <ul class="useful-links">
                                <li><a href="faq.html"><i class="fas fa-angle-right"></i> FAQ</a></li>
                                <li><a href="terms.html"><i class="fas fa-angle-right"></i> Terms of Use</a></li>
                                <li><a href="privacy.html"><i class="fas fa-angle-right"></i> Privacy Policy</a></li>
                                <li><a href="contact.html"><i class="fas fa-angle-right"></i> Contact</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="item pb_50">
                            <h2 class="heading">Contact</h2>
                            <div class="list-item">
                                <div class="left">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="right">
                                    34 Antiger Lane, USA, 12937
                                </div>
                            </div>
                            <div class="list-item">
                                <div class="left">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="right">contact@example.com</div>
                            </div>
                            <div class="list-item">
                                <div class="left">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="right">122-222-1212</div>
                            </div>
                            <ul class="social">
                                <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                <li><a href=""><i class="fab fa-youtube"></i></a></li>
                                <li><a href=""><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href=""><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="item pb_50">
                            <h2 class="heading">Newsletter</h2>
                            <p>
                                To get the latest news from our website, please
                                subscribe us here:
                            </p>
                            <form action="" method="post">
                                <div class="form-group">
                                    <input type="text" name="" class="form-control" placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Subscribe Now">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection