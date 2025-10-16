@extends('layouts.main')
@section('content')
<section class="breadcrumb-area d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-center">
                    <div class="breadcrumb-title">
                        <h2>Verify Your Booking</h2>
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        OTP Verification
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-80 pb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="otp-verification-card">
                    <div class="otp-card-header text-center mb-40">
                        <div class="otp-icon mb-20">
                            <i class="fal fa-shield-check"></i>
                        </div>
                        <h3 class="otp-title">Verify Your Identity</h3>
                        <p class="otp-subtitle">We've sent a 6-digit verification code to your registered phone number</p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-modern mb-30" role="alert">
                            <i class="fal fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger alert-modern mb-30" role="alert">
                            <i class="fal fa-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('dashboard.booking.otp.verify') }}" class="otp-form" id="otpForm">
                        @csrf
                        <div class="otp-input-container mb-30">
                            <label for="otp" class="otp-label">{{ __('Enter Otp Code') }}</label>
                            <div class="otp-input-wrapper">
                                <input id="otp" type="text" class="otp-input @error('otp') is-invalid @enderror" 
                                    name="otp" placeholder="000000" maxlength="6" pattern="[0-9]{6}"  required  autofocus>
                                <div class="otp-input-icon">
                                    <i class="fal fa-key"></i>
                                </div>
                            </div>
                            @error('otp')
                                <div class="otp-error-message">
                                    <i class="fal fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="otp-submit-wrapper mb-30">
                            <button type="submit" class="otp-submit-btn" id="verifyBtn">
                                <span class="btn-text">Verify & Complete Booking</span>
                                <i class="fal fa-arrow-right ms-2"></i>
                            </button>
                        </div>

                        <div class="otp-help-text text-center">
                            <p class="mb-2">Didn't receive the code?</p>
                            <a href="{{ route('dashboard.booking.otp.resend') }}" class="otp-resend-link" id="resendLink">
                                <i class="fal fa-redo me-1"></i>
                                <span id="resendText">Resend Code</span>
                            </a>
                            <div id="countdown" class="countdown-timer" style="display: none;">
                                <small class="text-muted">Resend available in <span id="countdownTime">60</span> seconds</small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
let countdownTimer;
let timeLeft = 60; // 60 seconds countdown

function startCountdown() {
    const resendLink = document.getElementById('resendLink');
    const countdown = document.getElementById('countdown');
    const countdownTime = document.getElementById('countdownTime');
    const resendText = document.getElementById('resendText');
    
    // Prevent clicking the link during countdown
    resendLink.style.pointerEvents = 'none';
    resendLink.style.opacity = '0.6';
    
    countdown.style.display = 'block';
    resendText.textContent = 'Code Sent';
    
    countdownTimer = setInterval(() => {
        countdownTime.textContent = timeLeft;
        timeLeft--;
        
        if (timeLeft < 0) {
            clearInterval(countdownTimer);
            countdown.style.display = 'none';
            resendLink.style.pointerEvents = 'auto';
            resendLink.style.opacity = '1';
            resendText.textContent = 'Resend Code';
        }
    }, 1000);
}

function showAlert(type, message) {
    // Remove existing alerts
    const existingAlerts = document.querySelectorAll('.alert-modern');
    existingAlerts.forEach(alert => alert.remove());
    
    // Create new alert
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-modern mb-30`;
    alertDiv.setAttribute('role', 'alert');
    
    const icon = type === 'success' ? 'check-circle' : 'exclamation-triangle';
    alertDiv.innerHTML = `
        <i class="fal fa-${icon} me-2"></i>
        ${message}
    `;
    
    // Insert alert before the form
    const form = document.getElementById('otpForm');
    form.parentNode.insertBefore(alertDiv, form);
    
    // Auto-remove alert after 5 seconds
    setTimeout(() => {
        alertDiv.remove();
    }, 2000);
}

// Auto-format OTP input
document.getElementById('otp').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 6) {
        value = value.slice(0, 6);
    }
    e.target.value = value;
});

// Auto-submit when 6 digits are entered
document.getElementById('otp').addEventListener('input', function(e) {
    if (e.target.value.length === 6) {
        // Optional: Auto-submit after a short delay
        setTimeout(() => {
            if (e.target.value.length === 6) {
                e.target.closest('form').submit();
            }
        }, 500);
    }
});

// Handle form submission
document.getElementById('otpForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('verifyBtn');
    const otpInput = document.getElementById('otp');
    
    if (otpInput.value.length !== 6) {
        e.preventDefault();
        showAlert('danger', 'Please enter a valid 6-digit OTP');
        return;
    }
    
    submitBtn.innerHTML = '<i class="fal fa-spinner fa-spin me-2"></i>Verifying...';
    submitBtn.disabled = true;
});

// Auto-focus on page load
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('otp').focus();

    // If a success message is present (from a redirect), start the countdown
    @if(session('success'))
        startCountdown();
    @endif
});
</script>

@endsection
