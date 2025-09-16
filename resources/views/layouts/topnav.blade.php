<style>
    .day-close {
        background-color: #d30610;
        margin-left: 5px;
        margin-right: 5px;
    }
</style>

<div id="openregister" class="modal fade  bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="openclosecash">
        </div>
    </div>
</div>
<nav class="navbar-custom-menu navbar navbar-expand-xl m-0">
    <div class="sidebar-toggle-icon" id="sidebarCollapse">
        <span></span>
    </div>
    <!--/.sidebar toggle icon-->
    <!-- Collapse -->
    <div class="navbar-icon d-flex">
        <ul class="navbar-nav flex-row align-items-center">
            <div class="">
                <a href="/" target="_blank" class="btn btn-success mr-1">Website</a>
            </div>
            
            <li class="nav-item dropdown quick-actions">
                <a class="nav-link dropdown-toggle material-ripple" href="#" data-toggle="dropdown">
                    <!-- Using Font Awesome instead of Tabler Icons -->
                    <i class="fas fa-th-large"></i>
                    <!-- OR if you have Tabler Icons loaded: -->
                    <!-- <i class="ti ti-grid-dots"></i> -->
                </a>
                <div class="dropdown-menu">
                    <div class="nav-grid-row row">
                        <a href="" class="icon-menu-item col-4">
                            <!-- Font Awesome settings icon -->
                            <i class="fas fa-cog d-block"></i>
                            <!-- OR Tabler: <i class="ti ti-settings d-block"></i> -->
                            <span>Setting</span>
                        </a>
                        <a href="{{ route('admin.customer.index') }}" class="icon-menu-item col-4">
                            <!-- Font Awesome users icon -->
                            <i class="fas fa-users d-block"></i>
                            <!-- OR Tabler: <i class="ti ti-users d-block"></i> -->
                            <span>User List</span>
                        </a>
                        <a href="{{ route('admin.booking.index') }}" class="icon-menu-item col-4">
                            <!-- Font Awesome calendar icon -->
                            <i class="fas fa-calendar-check d-block"></i>
                            <!-- OR Tabler: <i class="ti ti-calendar-check d-block"></i> -->
                            <span>Booking List</span>
                        </a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link material-ripple" href="#" id="btnFullscreen">
                    <!-- Font Awesome expand icon -->
                    <i class="fas fa-expand-arrows-alt full-screen_icon"></i>
                    <!-- OR simple expand: <i class="fas fa-expand"></i> -->
                </a>
            </li>
            
            <li class="nav-item dropdown user-menu">
                <a class="nav-link dropdown-toggle material-ripple" href="#" data-toggle="dropdown">
                    <!-- Font Awesome user icon -->
                    <i class="fas fa-user-circle"></i>
                    <!-- OR Typicons if loaded: <i class="typcn typcn-user"></i> -->
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-header d-sm-none">
                        <a href="" class="header-arrow">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                    <div class="user-header">
                        <div class="img-user">
                            <img src="{{ asset('assets/images/avatar.png') }}" alt="">
                        </div>
                        <h6>Super Admin</h6>
                    </div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user"></i> My Profile
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
        <!--/.navbar nav-->
        <div class="nav-clock">
            <div class="time">
                <span class="time-hours"></span>
                <span class="time-min"></span>
                <span class="time-sec"></span>
            </div>
        </div><!-- nav-clock -->
    </div>
</nav>
