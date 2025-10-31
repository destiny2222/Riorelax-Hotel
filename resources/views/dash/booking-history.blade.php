@extends('layouts.main')
@section('content')
    <section class="breadcrumb-area d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="breadcrumb-wrap text-center">
                        <div class="breadcrumb-title">
                            <h2>Booking History</h2>
                            <div class="breadcrumb-wrap">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Booking History</li>
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
            <div class="customer-page">
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
                                    <!-- Statistics Cards -->
                                    <div class="row mb-4">
                                        <div class="col-md-3 col-6 mb-3">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-body">
                                                    <i class="fa fa-calendar-check fa-2x text-primary mb-2"></i>
                                                    <h4 class="mb-0">{{ $totalBookings }}</h4>
                                                    <small class="text-muted">Total Bookings</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6 mb-3">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-body">
                                                    <i class="fa fa-check-circle fa-2x text-success mb-2"></i>
                                                    <h4 class="mb-0">{{ $completedBookings }}</h4>
                                                    <small class="text-muted">Completed</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6 mb-3">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-body">
                                                    <i class="fa fa-times-circle fa-2x text-danger mb-2"></i>
                                                    <h4 class="mb-0">{{ $cancelledBookings }}</h4>
                                                    <small class="text-muted">Cancelled</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6 mb-3">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-body">
                                                    <i class="fa fa-money-bill fa-2x text-info mb-2"></i>
                                                    <h4 class="mb-0">₦{{ number_format($totalSpent, 0) }}</h4>
                                                    <small class="text-muted">Total Spent</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Account Summary Cards -->
                                    {{-- <div class="row mb-4">
                                        <div class="col-md-6 mb-3">
                                            <div class="card shadow-sm">
                                                <div class="card-body">
                                                    <h6 class="card-title">
                                                        <i class="fa fa-wallet text-success"></i> Wallet Points
                                                    </h6>
                                                    <h3 class="text-success mb-0">₦{{ number_format($walletPoints, 2) }}</h3>
                                                    <small class="text-muted">Available for next booking</small>
                                                </div>
                                            </div>
                                        </div>
                                        @if($discountCode)
                                        <div class="col-md-6 mb-3">
                                            <div class="card shadow-sm border-info">
                                                <div class="card-body">
                                                    <h6 class="card-title">
                                                        <i class="fa fa-gift text-info"></i> Discount Code
                                                    </h6>
                                                    <h3 class="text-info mb-1">{{ $discountCode->code }}</h3>
                                                    <div>
                                                        <span class="badge badge-success">{{ $discountCode->discount_percentage }}% OFF</span>
                                                        @if($discountCode->canBeUsed())
                                                            <span class="badge badge-success ml-2">Available</span>
                                                        @else
                                                            <span class="badge badge-warning ml-2">Cooldown</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div> --}}

                                    <!-- Booking History Table -->
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="card-title mb-0">
                                                    <i class="fa fa-history"></i> All Bookings
                                                </h5>
                                                @if($bookings->count() > 0)
                                                <a href="{{ route('dashboard.bookings.export') }}" class="btn btn-success btn-sm">
                                                    <i class="fa fa-download"></i> Export to CSV
                                                </a>
                                                @endif
                                            </div>

                                            @if($bookings->count() > 0)
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Room</th>
                                                            <th>Check In</th>
                                                            <th>Check Out</th>
                                                            <th>Guests/Rooms</th>
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
                                                                <strong>{{ $booking->roomListing->room_title ?? 'N/A' }}</strong><br>
                                                                <small class="text-muted">{{ $booking->roomListing->room_type ?? '' }}</small>
                                                            </td>
                                                            <td>{{ \Carbon\Carbon::parse($booking->check_in_date)->format('M d, Y') }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($booking->check_out_date)->format('M d, Y') }}</td>
                                                            <td>
                                                                <i class="fa fa-users"></i> {{ $booking->number_of_guests }}<br>
                                                                <i class="fa fa-door-open"></i> {{ $booking->number_of_rooms }}
                                                            </td>
                                                            <td>
                                                                <strong class="fs-5">₦{{ number_format($booking->total_amount, 2) }}</strong>
                                                                @if($booking->discount_code_amount)
                                                                <br><small class="text-info fs-5"><i class="fa fa-tag"></i> -₦{{ number_format($booking->discount_code_amount, 2) }}</small>
                                                                @endif
                                                                @if($booking->wallet_points_used)
                                                                <br><small class="text-success fs-5"><i class="fa fa-wallet"></i> -₦{{ number_format($booking->wallet_points_used, 2) }}</small>
                                                                @endif
                                                                @if($booking->wallet_points_earned)
                                                                <br><small class="text-primary fs-5"><i class="fa fa-plus-circle"></i> +₦{{ number_format($booking->wallet_points_earned, 2) }}</small>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($booking->status === 'confirmed')
                                                                    <span class="badge bg-success fs-5">Confirmed</span>
                                                                @elseif($booking->status === 'checked-out')
                                                                    <span class="badge bg-info fs-5">Checked Out</span>
                                                                @elseif($booking->status === 'cancelled')
                                                                    <span class="badge bg-danger fs-5">Cancelled</span>
                                                                @elseif($booking->status === 'pending')
                                                                    <span class="badge bg-warning fs-5">Pending</span>
                                                                @else
                                                                    <span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span>
                                                                @endif
                                                                <br>
                                                                <small class="text-muted">
                                                                    @if($booking->payment_status === 'paid')
                                                                        <span class="badge bg-primary fs-5"><i class="fa fa-check"></i> Paid</span>
                                                                    @else
                                                                        <span class="badge bg-warning fs-5"><i class="fa fa-clock"></i> {{ ucfirst($booking->payment_status) }}</span>
                                                                    @endif
                                                                </small>
                                                            </td>
                                                            {{-- <td>
                                                                <button class="btn btn-sm btn-info" data-bs-toggle="collapse" data-bs-target="#booking-{{ $booking->id }}">
                                                                    <i class="fa fa-eye"></i>
                                                                </button>
                                                            </td> --}}
                                                        </tr>
                                                        {{-- <tr class="collapse" id="booking-{{ $booking->id }}">
                                                            <td colspan="8">
                                                                <div class="p-3 bg-light border-left border-info" style="border-left-width: 4px !important;">
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <strong><i class="fa fa-calendar"></i> Booking Date:</strong><br>
                                                                            {{ $booking->created_at->format('M d, Y H:i A') }}
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <strong><i class="fa fa-hashtag"></i> Reference:</strong><br>
                                                                            {{ $booking->reference ?? 'N/A' }}
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <strong><i class="fa fa-bed"></i> Room Number:</strong><br>
                                                                            {{ $booking->roomListing->room_number ?? 'N/A' }}
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <strong><i class="fa fa-moon"></i> Nights:</strong><br>
                                                                            {{ \Carbon\Carbon::parse($booking->check_in_date)->diffInDays(\Carbon\Carbon::parse($booking->check_out_date)) }} night(s)
                                                                        </div>
                                                                    </div>
                                                                    @if($booking->discount_code_used)
                                                                    <div class="row mt-3">
                                                                        <div class="col-md-12">
                                                                            <div class="alert alert-info mb-0 py-2">
                                                                                <i class="fa fa-info-circle"></i> <strong>Discount Applied:</strong> Code <code>{{ $booking->discount_code_used }}</code> saved you ₦{{ number_format($booking->discount_code_amount, 2) }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr> --}}
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <!-- Pagination -->
                                            <div class="d-flex justify-content-center mt-3">
                                                {{ $bookings->links() }}
                                            </div>
                                            @else
                                            <div class="alert alert-info text-center">
                                                <i class="fa fa-info-circle fa-3x mb-3"></i>
                                                <h5>No Booking History</h5>
                                                <p>You haven't made any bookings yet. Start exploring our amazing rooms!</p>
                                                <a href="{{ route('rooms') }}" class="btn btn-primary">
                                                    <i class="fa fa-search"></i> Browse Rooms
                                                </a>
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
    </section>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 8px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .badge {
        padding: 5px 10px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .table {
        margin-bottom: 0;
    }
    
    .table thead th {
        background-color: #f8f9fa;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
        color: #495057;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
    }
    
    .table td {
        vertical-align: middle;
        font-size: 14px;
    }
    
    .table tbody tr {
        transition: background-color 0.2s ease;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fa;
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
        padding: 5px 12px;
        font-size: 13px;
    }
    
    .fa-2x {
        font-size: 2em;
    }
    
    .fa-3x {
        font-size: 3em;
    }
    
    .shadow-sm {
        box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important;
    }
    
    .collapse.show + tr {
        border-bottom: 2px solid #17a2b8;
    }
    
    code {
        background-color: #e9ecef;
        padding: 2px 6px;
        border-radius: 3px;
        color: #d63384;
    }
    
    .alert {
        border-radius: 6px;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        content: "›";
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Smooth scroll to expanded details
        $('[data-toggle="collapse"]').on('click', function() {
            var target = $(this).attr('data-target');
            setTimeout(function() {
                if($(target).hasClass('show')) {
                    $('html, body').animate({
                        scrollTop: $(target).offset().top - 100
                    }, 300);
                }
            }, 350);
        });
        
        // Initialize tooltips if available
        if (typeof $().tooltip === 'function') {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
</script>
@endpush
