<nav class="sidebar sidebar-bunker">
    <div class="sidebar-header">
        <a href="" class="sidebar-brand">
            <img class="sidebar-brand_icon" src="" alt="">
        </a>
    </div>
    <!--/.sidebar header-->
    <div class="profile-element d-flex align-items-center flex-shrink-0">
        <div class="avatar online">
            <img src="" class="img-fluid rounded-circle" alt="">
        </div>
        <div class="profile-text">
            <h6 class="m-0">Super Admin</h6>
        </div>
    </div>
    <!--/.profile element-->
    <div class="sidebar-body">
        <nav class="sidebar-nav">
            <ul class="metismenu">
                <li class="{{ Route::is('admin.home') ? 'mm-active' : ''}}">
                    <a href="{{ route('admin.home') }}"><i class="ti-home"></i>
                        Dashboard
                    </a>
                </li>

                {{-- <li class="">
                    <a class="has-arrow material-ripple" href="#">
                        <i class='ti-bag'></i>
                        Account
                    </a>
                    <ul class="nav-second-level ">
                    </ul>
                </li> --}}
                <!-- end if -->
                <!-- end foreach -->
                <li class="{{ Route::is('admin.customer.index') ? 'mm-active' : ''}}">
                    <a class="has-arrow material-ripple" href="#">
                        <i class='typcn typcn-user'></i>
                        Customer
                    </a>
                    <ul class="nav-second-level ">
                        <!-- endforeach -->
                        <li class="">
                            <a href="{{ route('admin.customer.index') }}">Customer List  </a>
                        </li>
                        <!-- endforeach -->
                    </ul>
                </li>
                <!-- end if -->
                <!-- end foreach -->
                <li class="{{ Route::is('admin.amenities.index') ? 'mm-active' : ''}}">
                    <a class="has-arrow material-ripple" href="#"><i class='ti-view-grid'></i>
                        Room Facilities<span class=""></span></a>
                    <ul class="nav-second-level ">
                        <!-- endforeach -->
                        <li class="">
                            <a href="{{ route('admin.amenities.index') }}">Facility  List </a>
                        </li>
                        <!-- endforeach -->
                    </ul>
                </li>
                <!-- end if -->
                <!-- end foreach -->
                <li class="{{ Route::is('admin.roomListing.index') ? 'mm-active' : ''}}">
                    <a class="has-arrow material-ripple" href="#"><i class='typc typcn-spanner'></i>
                        Room Setting<span class=""></span></a>
                    <ul class="nav-second-level ">
                        <li class="">
                            <a href="{{ route('admin.roomListing.index') }}">Room List </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.booking.index') }}">Booking List </a>
                        </li>
                    </ul>
                </li>
                <!-- end if -->
                <li class=""><a href="#"><i class="ti-settings"></i>Settings</a></li>
            </ul>
        </nav>
    </div><!-- sidebar-body -->
</nav>
