<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Messages
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-message">
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-avatar">
                            <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle">
                            <div class="is-online"></div>
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Kusnaedi</b>
                            <p>Hello, Bro!</p>
                            <div class="time">10 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-avatar">
                            <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle">
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Dedik Sugiharto</b>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                            <div class="time">12 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-avatar">
                            <img alt="image" src="assets/img/avatar/avatar-3.png" class="rounded-circle">
                            <div class="is-online"></div>
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Agung Ardiansyah</b>
                            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <div class="time">12 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-avatar">
                            <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle">
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Ardian Rahardiansyah</b>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                            <div class="time">16 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-avatar">
                            <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle">
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Alfa Zulkarnain</b>
                            <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                            <div class="time">Yesterday</div>
                        </div>
                    </a>
                </div>
                <div class="dropdown-footer text-center">
                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>

        @php
            $notifications = \App\Models\OrderPlacedNotification::where('seen', 0)->latest()->take(10)->get();
        @endphp
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifications
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons rt_notification">
                    @foreach ($notifications as $notification)
                        <a href="{{ route('admin.orders.show', $notification->order_id) }}" class="dropdown-item">
                            <div class="dropdown-item-icon bg-info text-white">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                {{ $notification->message }}
                                <div class="time">Yesterday</div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="dropdown-footer text-center">
                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>

        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @if (auth()->user()->avatar)
                    <img alt="image" src="{{ auth()->user()->avatar }}" class="rounded-circle mr-1">
                @else
                    <i class="fas fa-user" style="font-size:24px;"></i>
                @endif
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="{{ route('admin.profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="{{ route('admin.setting.index') }}" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="#"
                        onclick="event.preventDefault();
                            this.closest('form').submit();"
                        class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">{{ config('settings.site_name') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">FP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ setActive(['admin.dashboard']) }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fire"></i>
                    Dashboard
                </a>
            </li>
            <li class="menu-header">Starter</li>

            <li class="{{ setActive(['admin.slider.*']) }}">
                <a class="nav-link" href="{{ route('admin.slider.index') }}">
                    <i class="far fa-square"></i>
                    <span>Slider</span>
                </a>
            </li>

            <li class="dropdown {{ setActive(['admin.category.*', 'admin.product.*', 'admin.product-reviews.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>Manage Restaurant</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.category.index') }}">Product Categories</a></li>
                    <li class="{{ setActive(['admin.product.*']) }}"><a class="nav-link"
                            href="{{ route('admin.product.index') }}">Products</a></li>
                    <li class="{{ setActive(['admin.product-reviews.*']) }}"><a class="nav-link"
                            href="{{ route('admin.product-reviews.index') }}">Product Reviews</a>
                    </li>
                </ul>
            </li>

            <li
                class="dropdown {{ setActive(['admin.coupon.*', 'admin.delivery-area.*', 'admin.payment-setting.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>Manage Ecommerce</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.coupon.*']) }}"><a class="nav-link"
                            href="{{ route('admin.coupon.index') }}">Coupon</a></li>
                    <li class="{{ setActive(['admin.delivery-area.*']) }}"><a class="nav-link"
                            href="{{ route('admin.delivery-area.index') }}">Delivery Areas</a></li>
                    <li class="{{ setActive(['admin.payment-setting.*']) }}"><a class="nav-link"
                            href="{{ route('admin.payment-setting.index') }}">Payment Gateways</a>
                    </li>
                </ul>
            </li>

            <li class="{{ setActive(['admin.daily-offer.*']) }}">
                <a class="nav-link" href="{{ route('admin.daily-offer.index') }}">
                    <i class="far fa-square"></i>
                    <span>Daily Offer</span>
                </a>
            </li>

            <li
                class="dropdown {{ setActive([
                    'admin.orders.*',
                    'admin.pending-orders',
                    'admin.inProcess-orders',
                    'admin.delivered-orders',
                    'admin.declined-orders',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>Orders</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.orders.*']) }}">
                        <a class="nav-link" href="{{ route('admin.orders.index') }}">All Orders</a>
                    </li>
                    <li class="{{ setActive(['admin.pending-orders']) }}">
                        <a class="nav-link" href="{{ route('admin.pending-orders') }}">Pending Orders</a>
                    </li>
                    <li class="{{ setActive(['admin.inProcess-orders']) }}">
                        <a class="nav-link" href="{{ route('admin.inProcess-orders') }}">In Process Orders</a>
                    </li>
                    <li class="{{ setActive(['admin.delivered-orders']) }}">
                        <a class="nav-link" href="{{ route('admin.delivered-orders') }}">Delivered Orders</a>
                    </li>
                    <li class="{{ setActive(['admin.declined-orders']) }}">
                        <a class="nav-link" href="{{ route('admin.declined-orders') }}">Declined Orders</a>
                    </li>
                </ul>
            </li>


            <li class="dropdown {{ setActive(['admin.blog-category.*', 'admin.blog.*', 'admin.blogs.comments.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>Blog</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.blog-category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.blog-category.index') }}">Categories</a></li>
                    <li class="{{ setActive(['admin.blog.*']) }}"><a class="nav-link"
                            href="{{ route('admin.blog.index') }}">All Blogs</a></li>
                    <li class="{{ setActive(['admin.blogs.comments.*']) }}"><a class="nav-link"
                            href="{{ route('admin.blogs.comments.index') }}">Comments</a></li>
                </ul>
            </li>

            <li
                class="dropdown {{ setActive([
                    'admin.why-choose-us.*',
                    'admin.banner-slider.*',
                    'admin.our-team.*',
                    'admin.app-download.*',
                    'admin.testimonial.*',
                    'admin.counter.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>Sections</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.why-choose-us.*']) }}"><a class="nav-link"
                            href="{{ route('admin.why-choose-us.index') }}">Why Choose Us</a></li>
                    <li class="{{ setActive(['admin.banner-slider.*']) }}"><a class="nav-link"
                            href="{{ route('admin.banner-slider.index') }}">Banner Slider</a></li>
                    <li class="{{ setActive(['admin.our-team.*']) }}"><a class="nav-link"
                            href="{{ route('admin.our-team.index') }}">Our members</a></li>
                    <li class="{{ setActive(['admin.app-download.*']) }}"><a class="nav-link"
                            href="{{ route('admin.app-download.index') }}">App Download Section</a></li>
                    <li class="{{ setActive(['admin.testimonial.*']) }}"><a class="nav-link"
                            href="{{ route('admin.testimonial.index') }}">Testimonial</a></li>
                    <li class="{{ setActive(['admin.counter.*']) }}"><a class="nav-link"
                            href="{{ route('admin.counter.index') }}">Counter</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.footer-info.index']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>Footer</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.footer-info.index']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-info.index') }}">Footer Info</a></li>
                </ul>
            </li>

            <li class="{{ setActive(['admin.setting.index']) }}">
                <a class="nav-link" href="{{ route('admin.setting.index') }}">
                    <i class="far fa-square"></i>
                    <span>Settings</span>
                </a>
            </li>

            <li class="{{ setActive(['admin.clear-database.index']) }}">
                <a class="nav-link" href="{{ route('admin.clear-database.index') }}">
                    <i class="far fa-square"></i>
                    <span>Clear Database</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
