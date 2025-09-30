
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>ILoveNYC</title>


        <!-- All CSS -->
        <link rel="stylesheet" href="{{ asset('dist-front/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/bootstrap-datepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/select2-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/meanmenu.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/iziToast.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/spacing.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/iziToast.min.css') }}">
        
        <!-- All Javascripts -->
        <script src="{{ asset('dist-front/js/jquery-3.6.1.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/wow.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/select2.full.js') }}"></script>
        <script src="{{ asset('dist-front/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/moment.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/counterup.min.js') }}"></script>
        <script src="{{ asset('dist/js/iziToast.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/multi-countdown.js') }}"></script>
        <script src="{{ asset('dist-front/js/jquery.meanmenu.js') }}"></script>
        <script src="{{ asset('dist/js/iziToast.min.js') }}"></script>

        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 left-side">
                        <ul>
                            <li class="phone-text"><i class="fas fa-phone"></i>nesto broj </li>
                            <li class="email-text"><i class="fas fa-envelope"></i> nesto</li>
                        </ul>
                    </div>
                    <div class="col-md-6 right-side">
                        <ul class="right">
                            @if(Auth::guard('web')->check())
                            <li class="menu">
                                <a href="{{ route('user_dashboard') }}"><i class="fas fa-sign-in-alt"></i> Dashboard</a>
                            </li>
                            @else
                            <li class="menu">
                                <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                            </li>
                            <li class="menu">
                                <a href="{{ route('registration') }}"><i class="fas fa-user"></i> Sign Up</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>


     @include('front.layout.nav')
     @yield('main_content')

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="copyright">
                            Copyright &copy; 2025, DVA. All Rights Reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="scroll-top">
            <i class="fas fa-angle-up"></i>
        </div>

       
        <script src="{{ asset('dist-front/js/custom.js') }}"></script>
     
                @if($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    iziToast.show({
                        message: '{{ $error }}',
                        color: 'red',
                        position: 'topRight',
                    });
                </script>
            @endforeach
        @endif
        @if(session('success'))
            <script>
                iziToast.show({
                    message: '{{ session("success") }}',
                    color: 'green',
                    position: 'topRight',
                });
            </script>
        @endif

        @if(session('error'))
            <script>
                iziToast.show({
                    message: '{{ session("error") }}',
                    color: 'red',
                    position: 'topRight',
                });
            </script>
        @endif

    </body>
</html>
