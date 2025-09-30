<ul class="list-group list-group-flush">
    <li class="list-group-item {{ Route::is('user_dashboard') ? 'active' : '' }}">
        <a href="{{ route('user_dashboard') }}">Dashboard</a>
    </li>
    <li class="list-group-item {{ Route::is('user_booking')||Request::is('user/invoice/*') ? 'active' : '' }}">
        <a href="{{ route('user_booking') }}">Kupovine</a>
    </li>
    <li class="list-group-item {{ Route::is('user_wishlist') ? 'active' : '' }}">
        <a href="{{ route('user_wishlist') }}">Wishlist</a>
    </li>
    <li class="list-group-item {{ Route::is('user_message') ? 'active' : '' }}">
        <a href="{{ route('user_message') }}">Poruke</a>
    </li>
    <li class="list-group-item {{ Route::is('user_review') ? 'active' : '' }}">
        <a href="{{ route('user_review') }}">Recenzije</a>
    </li>
    <li class="list-group-item {{ Route::is('user_profile') ? 'active' : '' }}">
        <a href="{{ route('user_profile') }}">Izmeni profil</a>
    </li>
    <li class="list-group-item">
        <a href="{{ route('logout') }}">Izloguj se</a>
    </li>
</ul>