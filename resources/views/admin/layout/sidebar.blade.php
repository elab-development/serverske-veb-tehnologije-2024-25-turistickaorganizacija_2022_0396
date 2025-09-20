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
            <li class="{{ Request::is('admin/slider/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_slider_index') }}"><i class="fas fa-hand-point-right"></i> <span>Carousel tabla</span></a></li>
            <li class="{{ Request::is('admin/welcome-item/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_welcome_item_index') }}"><i class="fas fa-hand-point-right"></i> <span>Dobrodošli tabla</span></a></li>
            <li class="{{ Request::is('admin/feature/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_feature_index') }}"><i class="fas fa-hand-point-right"></i> <span>Feature</span></a></li>
            <li class="{{ Request::is('admin/counter-item/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_counter_item_index') }}"><i class="fas fa-hand-point-right"></i> <span>Counter Item</span></a></li>
            <li class="{{ Request::is('admin/testimonial/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_testimonial_index') }}"><i class="fas fa-hand-point-right"></i> <span>Testimonial</span></a></li>
            <li class="{{ Request::is('admin/team-member/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_team_member_index') }}"><i class="fas fa-hand-point-right"></i> <span>Članovi tima</span></a></li>
            <li class="{{ Request::is('admin/faq/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_faq_index') }}"><i class="fas fa-hand-point-right"></i> <span>FAQ</span></a></li>
            
            <li class="nav-item dropdown {{ Request::is('admin/blog-category/*')||Request::is('admin/post/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Blog Section</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/blog-category/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_blog_category_index') }}"><i class="fas fa-angle-right"></i> Category</a></li>
                    <li class=""><a class="nav-link" href=""><i class="fas fa-angle-right"></i> Post</a></li>
                </ul>
            </li>




            <li class="{{ Request::is('admin/profile') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_profile') }}"><i class="fas fa-hand-point-right"></i> <span>Profile</span></a></li>

        </ul>
    </aside>
</div>