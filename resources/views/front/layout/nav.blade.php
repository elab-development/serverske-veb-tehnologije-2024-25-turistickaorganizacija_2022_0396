<div class="navbar-area" id="stickymenu">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('uploads/logo.jpg') }}" alt="">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('uploads/logo.jpg') }}" alt="">
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
                            <a href="{{ route('home') }}" class="nav-link">Početna</a>
                        </li>
                        <li class="nav-item {{ Route::is('about') ? 'active' : '' }}">
                            <a href="{{ route('about') }}" class="nav-link">O nama</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('destinations') }}" class="nav-link">Destinacije</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('packages') }}" class="nav-link">Paketi</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('team_members') }}" class="nav-link">Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('faq') }}" class="nav-link">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('blog') }}" class="nav-link">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Kontakt</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>