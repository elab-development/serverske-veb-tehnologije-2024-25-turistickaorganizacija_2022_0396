<ul class="list-group list-group-flush">
                                <li class="list-group-item active {{ Route::is('user_dashboard') ? 'active' : '' }}">
                                    <a href="{{ route('user_dashboard') }}">Kontrolna tabla</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="user-order.html">Porudžbine</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="user-wishlist.html">Lista želja</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="user-message.html">Poruke</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="user-review.html">Ocene</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('user_profile') }}">Izmeni profil</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('logout') }}">Izloguj se</a>
                                </li>
                            </ul>