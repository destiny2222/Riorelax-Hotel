@extends('layouts.main')
@section('content')
    <section class="breadcrumb-area d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="breadcrumb-wrap text-center">
                        <div class="breadcrumb-title">
                            <h2>Profile</h2>
                            <div class="breadcrumb-wrap">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="https://riorelax.archielite.com">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Account information</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-40 pb-40">
        <div class="container">
            <div class="customer-page crop-avatar">
                <div class="container">
                    <div class="customer-body">
                        <div class="row body-border">
                            <div class="col-md-3">
                                <div class="profile-sidebar">
                                    @include('dash.sidebar')
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="profile-content">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h1 class="text-center">Account information</h1>
                                        </div>
                                        <div class="mt-30">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card p-3 shadow-sm">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Account Information</h5>
                                                            <p class="mb-0"><strong> Name </strong>: <i>{{ Auth::user()->first_name }}  {{ Auth::user()->last_name }}</i></p>
                                                            <p class="mb-0"><strong> Email </strong>: <i>{{ Auth::user()->email }} </i></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card p-3 shadow-sm ">
                                                        <div class="card-body">
                                                            <h5 class="card-title">
                                                                <i class="fa fa-wallet"></i> Wallet Points
                                                            </h5>
                                                            <h3 class="text-success mb-0">
                                                                ₦{{ number_format($walletPoints, 2) }}
                                                            </h3>
                                                            <small class="text-muted">Available for your next booking</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Discount Code Card -->
                                            @if($discountCode)
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <div class="card p-3 shadow-sm border-info">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <h5 class="card-title mb-2">
                                                                        <i class="fa fa-gift text-info"></i> Family & Friends Discount Code
                                                                    </h5>
                                                                    <div class="d-flex align-items-center">
                                                                        <h3 class="mb-0 text-info">{{ $discountCode->code }}</h3>
                                                                        <span class="badge badge-success ml-3">{{ $discountCode->discount_percentage }}% OFF</span>
                                                                    </div>
                                                                </div>
                                                                <div class="text-right">
                                                                    @if($discountCode->canBeUsed())
                                                                        <span class="badge badge-success">Available</span>
                                                                        <p class="mb-0 mt-2"><small class="text-muted">Ready to use on your next booking</small></p>
                                                                    @else
                                                                        <span class="badge badge-warning">In Cooldown</span>
                                                                        <p class="mb-0 mt-2">
                                                                            <small class="text-muted">
                                                                                Can be used again on<br>
                                                                                <strong>{{ $discountCode->last_used_at->addDays(7)->format('M d, Y') }}</strong>
                                                                            </small>
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            <!-- Booking History Section -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card p-3 shadow-sm">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                                <h5 class="card-title mb-0">
                                                                    <i class="fa fa-history"></i> Recent Bookings
                                                                </h5>
                                                                <div>
                                                                    @if($bookings->count() > 0)
                                                                    <a href="{{ route('dashboard.booking.history') }}" class="btn btn-primary btn-sm mr-2">
                                                                        <i class="fa fa-list"></i> View All
                                                                    </a>
                                                                    <a href="{{ route('dashboard.bookings.export') }}" class="btn btn-success btn-sm">
                                                                        <i class="fa fa-download"></i> Export
                                                                    </a>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            @if($bookings->count() > 0)
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Booking ID</th>
                                                                            <th>Room</th>
                                                                            <th>Check In</th>
                                                                            <th>Check Out</th>
                                                                            <th>Amount</th>
                                                                            <th>Status</th>
                                                                            {{-- <th>Details</th> --}}
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($bookings as $booking)
                                                                        <tr>
                                                                            <td><strong>#{{ $booking->id }}</strong></td>
                                                                            <td>
                                                                                {{ $booking->roomListing->room_title ?? 'N/A' }}<br>
                                                                                <small class="text-muted">{{ $booking->roomListing->room_type ?? '' }}</small>
                                                                            </td>
                                                                            <td>{{ \Carbon\Carbon::parse($booking->check_in_date)->format('M d, Y') }}</td>
                                                                            <td>{{ \Carbon\Carbon::parse($booking->check_out_date)->format('M d, Y') }}</td>
                                                                            <td>
                                                                                <strong class="fs-5">₦{{ number_format($booking->total_amount, 2) }}</strong>
                                                                                @if($booking->discount_code_amount)
                                                                                <br><small class="text-info fs-5">-₦{{ number_format($booking->discount_code_amount, 2) }} (Discount)</small>
                                                                                @endif
                                                                                @if($booking->wallet_points_used)
                                                                                <br><small class="text-success fs-5">-₦{{ number_format($booking->wallet_points_used, 2) }} (Wallet)</small>
                                                                                @endif
                                                                                @if($booking->wallet_points_earned)
                                                                                <br><small class="text-primary fs-5">+₦{{ number_format($booking->wallet_points_earned, 2) }} (Earned)</small>
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if($booking->status === 'confirmed')
                                                                                    <span class="badge bg-success fs-5 text-white">Confirmed</span>
                                                                                @elseif($booking->status === 'checked-out')
                                                                                    <span class="badge bg-info fs-5 text-white">Checked Out</span>
                                                                                @elseif($booking->status === 'cancelled')
                                                                                    <span class="badge bg-danger fs-5 text-white">Cancelled</span>
                                                                                @else
                                                                                    <span class="badge bg-warning fs-5 text-white">{{ ucfirst($booking->status) }}</span>
                                                                                @endif
                                                                                <br>
                                                                                <small class="text-muted">
                                                                                    @if($booking->payment_status === 'paid')
                                                                                        <span class="text-success badge bg-success">Paid</span>
                                                                                    @else
                                                                                        <span class="text-warning badge bg-warning">{{ ucfirst($booking->payment_status) }}</span>
                                                                                    @endif
                                                                                </small>
                                                                            </td>
                                                                            {{-- <td>
                                                                                <button class="btn btn-sm btn-info" data-bs-toggle="collapse" data-bs-target="#booking-{{ $booking->id }}">
                                                                                    <i class="fa fa-eye"></i> View
                                                                                </button>
                                                                            </td> --}}
                                                                        </tr>
                                                                        {{-- <tr class="collapse" id="booking-{{ $booking->id }}">
                                                                            <td colspan="7">
                                                                                <div class="p-3 bg-light">
                                                                                    <div class="row">
                                                                                        <div class="col-md-4">
                                                                                            <strong>Guest Details:</strong><br>
                                                                                            {{ $booking->number_of_guests }} Guest(s), {{ $booking->number_of_rooms }} Room(s)
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <strong>Booking Date:</strong><br>
                                                                                            {{ $booking->created_at->format('M d, Y H:i') }}
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <strong>Reference:</strong><br>
                                                                                            {{ $booking->reference ?? 'N/A' }}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr> --}}
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <!-- View All Link -->
                                                            @if($bookings->count() >= 5)
                                                            <div class="text-center mt-3">
                                                                <a href="{{ route('dashboard.booking.history') }}" class="btn btn-outline-primary btn-sm">
                                                                    View All Bookings <i class="fa fa-arrow-right ml-1"></i>
                                                                </a>
                                                            </div>
                                                            @endif
                                                            @else
                                                            <div class="alert alert-info text-center">
                                                                <i class="fa fa-info-circle"></i> You have no booking history yet. 
                                                                <a href="{{ route('rooms') }}" class="alert-link">Browse available rooms</a> to make your first booking.
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="avatar-modal" tabindex="-1" role="dialog" aria-labelledby="avatar-modal-label"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form class="avatar-form" method="post" action="" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="avatar-modal-label">
                                        <i class="til_img"></i>
                                        <strong>Profile Image</strong>
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="avatar-body">
                                        <div class="avatar-upload">
                                            <input class="avatar-src" name="avatar_src"  type="hidden">
                                                <input class="avatar-data" name="avatar_data"  type="hidden">
                                            <label for="avatarInput">New image</label>
                                            <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                                        </div>
                                        <div tabindex="-1" role="img" aria-label="Loading" class="loading "></div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="avatar-wrapper"></div>
                                                <div class="error-message text-danger page_speed_1224334290"></div>
                                            </div>
                                            <div class="col-md-3 avatar-preview-wrapper">
                                                <div class="avatar-preview preview-lg">
                                                    <img src=" "  alt="avatar">
                                                </div>
                                                <div class="avatar-preview preview-md">
                                                    <img src="" alt="avatar">
                                                </div>
                                                <div class="avatar-preview preview-sm">
                                                    <img src="" alt="avatar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer"><button class="btn btn-secondary" type="button"
                                        data-bs-dismiss="modal">Close</button><button class="btn btn-primary avatar-save"
                                        type="submit">Save</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 8px;
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
    
    .badge {
        padding: 5px 10px;
        font-size: 12px;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    .border-info {
        border-left: 4px solid #17a2b8 !important;
    }
    
    .text-info {
        color: #17a2b8 !important;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
    
    .btn-sm {
        padding: 5px 10px;
        font-size: 13px;
    }
</style>
@endpush
