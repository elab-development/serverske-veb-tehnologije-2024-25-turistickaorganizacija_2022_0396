<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin_dashboard') }}">Admin Panel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin_dashboard') }}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_dashboard') }}"><i class="fas fa-hand-point-right"></i> <span>Kontrolna tabla</span></a></li>

            <li class="{{ Request::is('admin/setting/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_setting_index') }}"><i class="fas fa-hand-point-right"></i> <span>Podešavaja</span></a></li>

            <li class="{{ Request::is('admin/slider/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_slider_index') }}"><i class="fas fa-hand-point-right"></i> <span>Karousel</span></a></li>

            <li class="{{ Request::is('admin/welcome-item/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_welcome_item_index') }}"><i class="fas fa-hand-point-right"></i> <span>Dobrodošli stavka</span></a></li>

            <li class="{{ Request::is('admin/feature/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_feature_index') }}"><i class="fas fa-hand-point-right"></i> <span>Funkicje stavka</span></a></li>

            <li class="{{ Request::is('admin/counter-item/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_counter_item_index') }}"><i class="fas fa-hand-point-right"></i> <span>Brojač stavka</span></a></li>

            <li class="{{ Request::is('admin/testimonial/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_testimonial_index') }}"><i class="fas fa-hand-point-right"></i> <span>Iskustvo korisnika stavka</span></a></li>

            <li class="{{ Request::is('admin/team-member/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_team_member_index') }}"><i class="fas fa-hand-point-right"></i> <span>Članovi tima</span></a></li>

            <li class="{{ Request::is('admin/faq/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_faq_index') }}"><i class="fas fa-hand-point-right"></i> <span>FAQ</span></a></li>

            <li class="nav-item dropdown {{ Request::is('admin/blog-category/*')||Request::is('admin/post/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Blog sekcija</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/blog-category/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_blog_category_index') }}"><i class="fas fa-angle-right"></i> Kategorija</a></li>
                    <li class="{{ Request::is('admin/post/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_post_index') }}"><i class="fas fa-angle-right"></i> Objava</a></li>
                </ul>
            </li>

            <li class="{{ Request::is('admin/destination/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_destination_index') }}"><i class="fas fa-hand-point-right"></i> <span>Destinacija</span></a></li>

            <li class="{{ Request::is('admin/package/*')||Request::is('admin/package-itineraries/*')||Request::is('admin/package-itinerary-*')||Request::is('admin/package-amenities/*')||Request::is('admin/package-amenity-*')||Request::is('admin/package-photos/*')||Request::is('admin/package-photo-*')||Request::is('admin/package-videos/*')||Request::is('admin/package-video-*')||Request::is('admin/package-faqs/*')||Request::is('admin/package-faq-*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_package_index') }}"><i class="fas fa-hand-point-right"></i> <span>Paket</span></a></li>

            <li class="{{ Request::is('admin/tour/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_tour_index') }}"><i class="fas fa-hand-point-right"></i> <span>Tura</span></a></li>

            <li class="nav-item dropdown {{ Request::is('admin/message')||Request::is('admin/users') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Korisnik sekcija</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/users') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_users') }}"><i class="fas fa-angle-right"></i> Korisnik</a></li>
                    <li class="{{ Request::is('admin/message') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_message') }}"><i class="fas fa-angle-right"></i> Poruka</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ Request::is('admin/subscribers')||Request::is('admin/subscriber-send-email') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Subscriber sekcija</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/subscribers') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_subscribers') }}"><i class="fas fa-angle-right"></i> Svi subscriberi</a></li>
                    <li class="{{ Request::is('admin/subscriber-send-email') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_subscriber_send_email') }}"><i class="fas fa-angle-right"></i> Pošalji email</a></li>
                </ul>
            </li>

            <li class="{{ Request::is('admin/review/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_review_index') }}"><i class="fas fa-hand-point-right"></i> <span>Recenzije</span></a></li>

            <li class="{{ Request::is('admin/amenity/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_amenity_index') }}"><i class="fas fa-hand-point-right"></i> <span>Pogodnisti</span></a></li>

            <li class="{{ Request::is('admin/home-item/index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_home_item_index') }}"><i class="fas fa-hand-point-right"></i> <span>Početna stavka</span></a></li>

            <li class="{{ Request::is('admin/about-item/index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_about_item_index') }}"><i class="fas fa-hand-point-right"></i> <span>O nama stavka</span></a></li>

            <li class="{{ Request::is('admin/contact-item/index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_contact_item_index') }}"><i class="fas fa-hand-point-right"></i> <span>Kontakt stavka</span></a></li>

            <li class="{{ Request::is('admin/term-privacy-item/index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_term_privacy_item_index') }}"><i class="fas fa-hand-point-right"></i> <span>Uslovi & Privatnost stavka</span></a></li>

            <li class="{{ Request::is('admin/profile') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_profile') }}"><i class="fas fa-hand-point-right"></i> <span>Profil</span></a></li>

        </ul>
    </aside>
</div>