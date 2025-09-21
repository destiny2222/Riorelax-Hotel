@extends('layouts.master')
@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                @if ($step === 'search')
                    <!-- Step 1: Search by Phone Number -->
                    <div class="card shadow-lg mb-5">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h1 class="h3 font-weight-bold mb-2">Room Booking Checker</h1>
                                <p class="text-muted">Enter phone number to find booking QR code</p>
                                <div class="d-flex justify-content-center align-items-center mt-3">
                                    <span class="badge badge-primary badge-pill px-3 py-2">Step 1</span>
                                    <span class="mx-2">→</span>
                                    <span class="badge badge-light badge-pill px-3 py-2">Step 2</span>
                                </div>
                            </div>

                            <!-- Display Success/Error Messages -->
                            @if (session('error'))
                                <div class="alert alert-danger border-left-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <!-- Phone Search Form -->
                            <div class="mx-auto" style="max-width: 400px;">
                                <form action="{{ route('admin.scan.result.store') }}" method="GET">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" name="phone" id="phone" class="form-control form-control-lg"
                                            placeholder="Enter phone number" value="{{ old('phone') }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Find Booking QR Code
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                @elseif($step === 'qr_display')
                    <!-- Step 2: Display QR Code for Scanning -->
                    <div class="card shadow-lg mb-5">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h1 class="h3 font-weight-bold mb-2">Booking Found!</h1>
                                <p class="text-muted">Scan the QR code below to verify booking details</p>
                                <div class="d-flex justify-content-center align-items-center mt-3">
                                    <span class="badge badge-success badge-pill px-3 py-2">✓ Step 1</span>
                                    <span class="mx-2">→</span>
                                    <span class="badge badge-primary badge-pill px-3 py-2">Step 2</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2 class="h4 font-weight-bold">Booking Details</h2>
                                @if($booking->payment_status === 1)
                                 <span class="badge badge-success badge-pill px-3 py-2">Paid</span>
                                @else 
                                <span class="badge-warning badge-pill px-3 py-2">Unpaid</span>
                                @endif
                            </div>

                            <div class="row align-items-center">
                                <!-- QR Code Display -->
                                <div class="col-md-6 text-center">
                                    <h2 class="h5 font-weight-bold mb-3 text-primary">QR Code to Scan</h2>
                                    @if (!empty($booking->qrcode))
                                        <div class="p-3 border rounded bg-light">
                                            <img src="{{ $booking->qrcode }}" alt="Booking QR Code" class="img-fluid"
                                                style="max-width: 256px;">
                                        </div>
                                        <p class="text-muted mt-3">
                                            This QR code belongs to booking <strong>{{ $booking->booking_number }}</strong>
                                            for {{ $booking->user->first_name  ?? 'Guest' }}  {{ $booking->user->last_name ?? 'Guest' }}
                                        </p>
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-light border rounded"
                                            style="width: 256px; height: 256px;">
                                            <p class="text-muted">No QR code available</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Verification Options Section -->
                                <div class="col-md-6">
                                    <h2 class="h5 font-weight-bold mb-3 text-primary text-center">Verify Booking</h2>

                                    <!-- Verification Tabs -->
                                    <ul class="nav nav-pills nav-fill mb-3" id="verify-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="manual-tab" data-toggle="pill" href="#manual-verify" role="tab" aria-controls="manual-verify" aria-selected="true">Manual Entry</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="camera-tab" data-toggle="pill" href="#camera-verify" role="tab" aria-controls="camera-verify" aria-selected="false">Camera Scan</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="verify-tabContent">
                                        <!-- Manual Verification -->
                                        <div class="tab-pane fade show active" id="manual-verify" role="tabpanel" aria-labelledby="manual-tab">
                                            <div class="text-center mb-3">
                                                <p class="text-muted mb-1">Enter the booking number from the QR code:</p>
                                                <p class="h5 font-weight-bold text-primary">{{ $booking->booking_number }}</p>
                                            </div>
                                            <form id="manual-verify-form">
                                                <div class="form-group">
                                                    <label for="manual-booking-number">Booking Number</label>
                                                    <input type="text" id="manual-booking-number" name="booking_number"
                                                        class="form-control form-control-lg text-center"
                                                        placeholder="Enter booking number" autocomplete="off">
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block">Verify Booking</button>
                                            </form>
                                        </div>

                                        <!-- Camera Scanner -->
                                        <div class="tab-pane fade" id="camera-verify" role="tabpanel" aria-labelledby="camera-tab">
                                            <div class="scanner-container border rounded overflow-hidden bg-light mx-auto" id="reader" style="height: 250px; width: 250px;"></div>
                                            <p class="text-muted text-center mt-2">Position the QR code within the frame</p>
                                            <div class="text-center mt-2">
                                                <button id="start-scan" class="btn btn-primary">Start Camera</button>
                                                <button id="stop-scan" class="btn btn-danger d-none">Stop Camera</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Loading Indicator -->
                            <div id="loading" class="d-none mt-4 text-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>

                            <!-- Error Message -->
                            <div id="error-message" class="d-none mt-4 alert alert-danger"></div>

                            <!-- Action Buttons -->
                            <div class="mt-4 text-center">
                                <a href="{{ route('admin.booking.scan') }}" class="btn btn-secondary">
                                    Search Another Booking
                                </a>
                            </div>
                        </div>
                    </div>

                @elseif($step === 'verified')
                    <!-- Step 3: Show Verified Booking Details -->
                    <div class="card shadow-lg mb-5">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <div class="d-inline-flex align-items-center justify-content-center bg-success-soft rounded-circle mb-3" style="width: 64px; height: 64px;">
                                    <i class="fas fa-check fa-2x text-success"></i>
                                </div>
                                <h1 class="h3 font-weight-bold mb-2">Booking Verified!</h1>
                                <p class="text-muted">QR code successfully verified</p>
                                <div class="d-flex justify-content-center align-items-center mt-3">
                                    <span class="badge badge-success badge-pill px-3 py-2">✓ Step 1</span>
                                    <span class="mx-2">→</span>
                                    <span class="badge badge-success badge-pill px-3 py-2">✓ Step 2</span>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Booking Information -->
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-md-6 mb-3"><div class="bg-light p-3 rounded">
                                            <p class="text-muted small mb-1">Booking Number</p>
                                            <p class="font-weight-bold h6">{{ $booking->booking_number ?? 'N/A' }}</p>
                                        </div></div>
                                        <div class="col-md-6 mb-3"><div class="bg-light p-3 rounded">
                                            <p class="text-muted small mb-1">Guest Name</p>
                                            <p class="font-weight-bold">{{ $booking->user->first_name  ?? 'N/A' }}  {{ $booking->user->last_name ?? 'N/A' }}</p>
                                        </div></div>
                                        <div class="col-md-6 mb-3"><div class="bg-light p-3 rounded">
                                            <p class="text-muted small mb-1">Phone Number</p>
                                            <p class="font-weight-bold">{{ $booking->user->phone ?? 'N/A' }}</p>
                                        </div></div>
                                        <div class="col-md-6 mb-3"><div class="bg-light p-3 rounded">
                                            <p class="text-muted small mb-1">Email</p>
                                            <p class="font-weight-bold">{{ $booking->user->email ?? 'N/A' }}</p>
                                        </div></div>
                                        <div class="col-md-6 mb-3"><div class="bg-light p-3 rounded">
                                            <p class="text-muted small mb-1">Check-in Date</p>
                                            <p class="font-weight-bold">{{ $booking->check_in ? \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') : 'N/A' }}</p>
                                        </div></div>
                                        <div class="col-md-6 mb-3"><div class="bg-light p-3 rounded">
                                            <p class="text-muted small mb-1">Check-out Date</p>
                                            <p class="font-weight-bold">{{ $booking->check_out ? \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') : 'N/A' }}</p>
                                        </div></div>
                                        <div class="col-md-6 mb-3"><div class="bg-light p-3 rounded">
                                            <p class="text-muted small mb-1">Room</p>
                                            <p class="font-weight-bold">{{ $booking->roomListing->name ?? 'N/A' }}</p>
                                        </div></div>
                                        <div class="col-md-6 mb-3"><div class="bg-light p-3 rounded">
                                            <p class="text-muted small mb-1">Guests</p>
                                            <p class="font-weight-bold">{{ $booking->adults ?? 0 }} Adults, {{ $booking->children ?? 0 }} Children</p>
                                        </div></div>
                                        <div class="col-md-6 mb-3"><div class="bg-light p-3 rounded">
                                            <p class="text-muted small mb-1">Rooms</p>
                                            <p class="font-weight-bold">{{ $booking->rooms ?? 1 }}</p>
                                        </div></div>
                                        <div class="col-md-6 mb-3"><div class="bg-light p-3 rounded">
                                            <p class="text-muted small mb-1">Amount Paid</p>
                                            <p class="font-weight-bold">${{ number_format($booking->paid_amount ?? 0, 2) }}</p>
                                        </div></div>
                                    </div>
                                    @if($booking->arrival_time)
                                    <div class="alert alert-info">
                                        <strong>Arrival Time:</strong> {{ $booking->arrival_time }}
                                    </div>
                                    @endif
                                </div>

                                <!-- QR Code Section -->
                                <div class="col-lg-4 text-center">
                                    <div class="bg-light p-3 rounded">
                                        <h3 class="h6 font-weight-bold mb-3">Verified QR Code</h3>
                                        @if(!empty($booking->qrcode))
                                            <img src="{{ $booking->qrcode }}" alt="Booking QR Code" class="img-fluid border rounded shadow-sm bg-white p-2" style="max-width: 180px;">
                                            <div class="mt-2 text-success">
                                                <i class="fas fa-check-circle"></i>
                                                <span class="small font-weight-bold">Verified</span>
                                            </div>
                                        @else
                                            <div class="d-flex align-items-center justify-content-center bg-secondary-soft rounded" style="width: 180px; height: 180px;">
                                                <p class="text-muted">No QR code</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-4 text-center">
                                <button onclick="window.print()" class="btn btn-info">
                                    Print Details
                                </button>
                                <a href="{{ route('admin.booking.scan') }}" class="btn btn-secondary">
                                    Verify Another Booking
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    @if(isset($step) && $step === 'qr_display')
    let html5QrcodeScanner = null;

    const startButton = document.getElementById('start-scan');
    const stopButton = document.getElementById('stop-scan');
    const loading = document.getElementById('loading');
    const errorMessage = document.getElementById('error-message');
    const manualForm = document.getElementById('manual-verify-form');

    // Tab switching functionality
    $('#verify-tab a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('#camera-tab').on('shown.bs.tab', function () {
        // You might want to auto-start camera here if desired
    });

    $('#manual-tab').on('shown.bs.tab', function () {
        stopScanner();
        document.getElementById('manual-booking-number').focus();
    });

    // Handle manual form submission
    manualForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const bookingNumber = document.getElementById('manual-booking-number').value.trim();
        if (!bookingNumber) {
            showError('Please enter a booking number');
            return;
        }
        handleQRScanResult(bookingNumber);
    });

    // Auto-complete for manual entry (optional enhancement)
    const expectedBookingNumber = '{{ $booking->booking_number }}';
    const manualInput = document.getElementById('manual-booking-number');

    manualInput.addEventListener('input', (e) => {
        const value = e.target.value.trim();
        if (value && value === expectedBookingNumber) {
            e.target.classList.add('is-valid');
            e.target.classList.remove('is-invalid');
        } else if (value && value !== expectedBookingNumber) {
            e.target.classList.add('is-invalid');
            e.target.classList.remove('is-valid');
        } else {
            e.target.classList.remove('is-valid', 'is-invalid');
        }
    });

    // Initialize QR Code Scanner
    function initializeScanner() {
        if (html5QrcodeScanner) return; // Already initialized

        html5QrcodeScanner = new Html5Qrcode("reader");
        const config = {
            fps: 10,
            qrbox: { width: 200, height: 200 },
            rememberLastUsedCamera: true
        };

        html5QrcodeScanner.start(
            { facingMode: "environment" },
            config,
            (decodedText, decodedResult) => {
                console.log(`Code scanned: ${decodedText}`);
                handleQRScanResult(decodedText);
                stopScanner();
            },
            (errorMessage) => { /* ignore */ }
        ).catch(err => {
            console.error('Unable to start scanning:', err);
            showError('Unable to access camera. Please use manual entry instead.');
            stopScanner();
        });
    }

    function stopScanner() {
        if (html5QrcodeScanner) {
            html5QrcodeScanner.stop().then(() => {
                startButton.classList.remove('d-none');
                stopButton.classList.add('d-none');
            }).catch(err => {
                console.error('Error stopping scanner:', err);
            });
        }
    }

    // Handle QR scan result
    function handleQRScanResult(scannedData) {
        loading.classList.remove('d-none');
        fetch('{{ route("admin.booking.verify-qr") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ qr_data: scannedData })
        })
        .then(response => response.json())
        .then(data => {
            loading.classList.add('d-none');
            if (data.success) {
                window.location.href = data.redirect_url;
            } else {
                showError(data.message || 'QR code verification failed');
            }
        })
        .catch(error => {
            loading.classList.add('d-none');
            showError('Network error. Please try again.');
            console.error('Error:', error);
        });
    }

    // Start scanning
    if (startButton) {
        startButton.addEventListener('click', () => {
            startButton.classList.add('d-none');
            stopButton.classList.remove('d-none');
            initializeScanner();
        });
    }

    // Stop scanning
    if (stopButton) {
        stopButton.addEventListener('click', stopScanner);
    }

    // Show error message
    function showError(message) {
        if (errorMessage) {
            errorMessage.textContent = message;
            errorMessage.classList.remove('d-none');
            setTimeout(() => {
                errorMessage.classList.add('d-none');
            }, 5000);
        }
    }

    // Auto-focus on manual input by default
    document.getElementById('manual-booking-number').focus();
    @endif

    @if(isset($step) && $step === 'search')
    // Auto-focus on phone input for search step
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.focus();
    }
    @endif
});
</script>
@endpush
