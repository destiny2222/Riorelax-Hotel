<nav class="sidebar sidebar-bunker">
    <div class="sidebar-header">
        <a href="{{ route('admin.home') }}" class="sidebar-brand">
            <img class="sidebar-brand_icon" src="{{ asset('images/logo.PNG') }}" width="100" alt="">
        </a>
    </div>
    <!--/.sidebar header-->
    <div class="profile-element d-flex align-items-center flex-shrink-0">
        <div class="avatar online">
            <img src="{{ asset('images/logo.PNG') }}" class="img-fluid rounded-circle" alt="">
        </div>
        <div class="profile-text">
            <h6 class="m-0">{{ auth()->guard('admin')->name }}</h6>
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

                <li class="{{ Route::is('admin.scan.index') ? 'mm-active' : ''}}">
                    <a class=" material-ripple" href="{{ route('admin.booking.scan') }}">
                        <i class='ti-bag'></i>
                        Scan Code
                    </a>
                </li>
                <!-- end if -->
                <!-- end foreach -->
                <li class="{{ Route::is('admin.customer.index') ? 'mm-active' : ''}}">
                    <a class="material-ripple" href="{{ route('admin.customer.index') }}">
                        <i class='fa fa-user'></i>
                        Registered Users
                    </a>
                </li>
                <li class="{{ Route::is('admin.customer.guests') ? 'mm-active' : ''}}">
                    <a class="material-ripple" href="{{ route('admin.customer.guests') }}">
                        <i class='ti-id-badge'></i>
                        Guest Users
                    </a>
                </li>
                <!-- end if -->
                <!-- end foreach -->
                {{-- <li class="{{ Route::is('admin.amenities.index') ? 'mm-active' : ''}}">
                    <a class="has-arrow material-ripple" href="#"><i class='ti-view-grid'></i>
                        Room Facilities<span class=""></span></a>
                    <ul class="nav-second-level ">
                        <!-- endforeach -->
                        <li class="">
                            <a href="{{ route('admin.amenities.index') }}">Facility  List </a>
                        </li>
                        <!-- endforeach -->
                    </ul>
                </li> --}}
                <!-- end if -->
                <!-- end foreach -->
                <li class="{{ Route::is('admin.roomListing.index') ? 'mm-active' : ''}}">
                    <a class="has-arrow material-ripple" href="#"><i class='fa fa-book'></i>
                        Room Setting<span class=""></span></a>
                    <ul class="nav-second-level ">
                        <li class="">
                            <a href="{{ route('admin.roomListing.index') }}">Room List </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.booking.index') }}">Booking List </a>
                        </li>
                        @if (Auth::guard('admin')->user()->canApproveBookingEdits())
                        <li class="{{ Route::is('admin.booking.pending-edits') ? 'mm-active' : ''}}">
                            <a href="{{ route('admin.booking.pending-edits') }}">Pending Edits
                                @if (isset($pendingEditRequestsCount) && $pendingEditRequestsCount > 0)
                                    <span class="badge badge-warning">{{ $pendingEditRequestsCount }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="{{ Route::is('admin.booking.acknowledged-requests') ? 'mm-active' : ''}}">
                            <a href="{{ route('admin.booking.acknowledged-requests') }}">Acknowledged Edits</a>
                        </li>
                        @endif
                        @if (Auth::guard('admin')->user()->isFrontDesk())
                        <li class="{{ Route::is('admin.booking.my-rejected-requests') ? 'mm-active' : ''}}">
                            <a href="{{ route('admin.booking.my-rejected-requests') }}">Rejected Edits
                                @if (isset($rejectedEditRequestsCount) && $rejectedEditRequestsCount > 0)
                                    <span class="badge badge-danger">{{ $rejectedEditRequestsCount }}</span>
                                @endif
                            </a>
                        </li>
                        @endif
                        <li class="">
                            <a href="{{ route('admin.bookings.create') }}">Book Reservation</a>
                        </li>
                        @if (Auth::guard('admin')->user()->hasAnyRole(['super-admin', 'supervisor']))
                        <li class="{{ Route::is('admin.family-friends.*') ? 'mm-active' : ''}}">
                            <a href="{{ route('admin.family-friends.index') }}">Family & Friends</a>
                        </li>
                        @endif
                    </ul>
                </li>
                <!-- end if -->
                @if (Auth::guard('admin')->user()->hasRole('super-admin'))
                <li class="{{ Route::is('admin.roles.*') ? 'mm-active' : ''}}">
                    <a class="material-ripple" href="{{ route('admin.roles.index') }}">
                        <i class='fa fa-user-shield'></i>
                        Role Management
                    </a>
                </li>
                @endif
                <li class=""><a href="{{ route('admin.profile.edit') }}"><i class="ti-settings"></i>Settings</a></li>
                <li class="">
                    <a href="#" style="color: red;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ti-power-off"></i>Logout
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div><!-- sidebar-body -->
</nav>
