<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payment - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .payment-card {
            background: linear-gradient(135deg, #644222 0%, #644222 100%);
        }
        .card-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .loading-spinner {
            display: none;
        }
        .loading .loading-spinner {
            display: inline-block;
        }
        .loading .button-text {
            display: none;
        }
        #submit-btn {
            padding: 10px 20px;
            background: linear-gradient(135deg, #644222 0%, #f19137 100%);
        }

        #lock{
           color: #644222 ;
        }

        /* #lightyellow{
            background-color:#ebe0d5;
            border-color: #ebe0d5;
            color: #f19137 !important
        } */

    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-4xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-credit-card mr-2 text-blue-600" id="lock"></i>
                    Payment Details
                </h1>
                <a href="{{ route('dashboard.booking.payment.form') }}" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="grid lg:grid-cols-2 gap-8">
            <!-- Booking Summary -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">
                    <i class="fas fa-file-invoice mr-2 text-green-600" id="lock"></i>
                    Booking Summary
                </h2>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Room:</span>
                        <span class="font-medium">{{ $booking->roomListing->title ?? 'Room Booking' }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Check-in:</span>
                        <span class="font-medium">{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Check-out:</span>
                        <span class="font-medium">{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Guests:</span>
                        <span class="font-medium">{{ $booking->adults }} Adults{{ $booking->children ? ', ' . $booking->children . ' Children' : '' }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Rooms:</span>
                        <span class="font-medium">{{ $booking->rooms }}</span>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="flex justify-between items-center p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <span class="text-lg font-semibold text-gray-900">
                            {{ $paymentType === 'full' ? 'Total Amount' : 'Reservation Amount (50%)' }}:
                        </span>
                        <span class="text-2xl font-bold text-blue-600" id="lock">₦{{ number_format($amount, 2) }}</span>
                    </div>
                    
                    @if($paymentType === 'reservation')
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                        <p class="text-sm text-yellow-800">
                            <i class="fas fa-info-circle mr-1"></i>
                            You're paying 50% now. The remaining ₦{{ number_format($booking->roomListing->price - $amount, 2) }} will be due at check-in.
                        </p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Payment Form -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">
                    <i class="fas fa-lock mr-2 text-green-600" id="lock"></i>
                    Secure Payment
                </h2>

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                        <div class="flex">
                            <i class="fas fa-exclamation-circle text-red-400 mt-0.5 mr-2"></i>
                            <div>
                                <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Success/Error Messages -->
                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                        <div class="flex">
                            <i class="fas fa-exclamation-circle text-red-400 mt-0.5 mr-2"></i>
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <form id="payment-form" action="{{ route('dashboard.booking.card-payment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    <input type="hidden" name="amount" value="{{ $amount }}">
                    <input type="hidden" name="payment_type" value="{{ $paymentType }}">

                    <!-- Card Holder Name -->
                    <div class="mb-6">
                        <label for="card_holder_name" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-1 text-gray-400"></i>
                            Cardholder Name
                        </label>
                        <input type="text" 
                               id="card_holder_name" 
                               name="card_holder_name" 
                               value=""
                               required 
                               class="card-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                               placeholder="Enter full name as on card">
                    </div>

                    <!-- Card Number -->
                    <div class="mb-6">
                        <label for="card_number" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-credit-card mr-1 text-gray-400"></i>
                            Card Number
                        </label>
                        <input type="text" 
                               id="card_number" 
                               name="card_number" 
                               value="{{ old('card_number') }}"
                               required 
                               maxlength="19"
                               class="card-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                               placeholder="1234 5678 9012 3456">
                        <div id="card-type" class="mt-1 text-sm text-gray-500"></div>
                    </div>

                    <!-- Expiry and CVV -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="expiry" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-calendar mr-1 text-gray-400"></i>
                                Expiry Date
                            </label>
                            <div class="flex space-x-2">
                                <select name="expiry_month" 
                                        id="expiry_month"
                                        required 
                                        class="card-input flex-1 px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    <option value="">MM</option>
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ old('expiry_month') == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                        </option>
                                    @endfor
                                </select>
                                <select name="expiry_year" 
                                        id="expiry_year"
                                        required 
                                        class="card-input flex-1 px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    <option value="">YY</option>
                                    @for($i = date('y'); $i <= date('y') + 15; $i++)
                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ old('expiry_year') == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="cvv" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-shield-alt mr-1 text-gray-400"></i>
                                CVV
                            </label>
                            <input type="text" 
                                   id="cvv" 
                                   name="cvv" 
                                   value="{{ old('cvv') }}"
                                   required 
                                   maxlength="3"
                                   class="card-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                   placeholder="123">
                        </div>
                    </div>

                    <!-- Security Notice -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6" id="lightyellow">
                        <div class="flex">
                            <i class="fas fa-shield-alt text-green-400 mt-0.5 mr-2"></i>
                            <div class="text-sm text-green-700">
                                <p class="font-medium">Secure Payment</p>
                                <p>Your payment information is encrypted and secure. We use industry-standard SSL encryption to protect your data.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submit-btn"
                            class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-4 px-6 rounded-lg hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-[1.02] transition-all duration-200">
                        <span class="button-text">
                            <i class="fas fa-lock mr-2"></i>
                            Pay ₦{{ number_format($amount, 2) }} Securely
                        </span>
                        <span class="loading-spinner">
                            <i class="fas fa-spinner fa-spin mr-2"></i>
                            Processing Payment...
                        </span>
                    </button>

                    <p class="text-xs text-gray-500 text-center mt-4">
                        By clicking "Pay Securely", you agree to our terms and conditions.
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Card number formatting
        document.getElementById('card_number').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') ?? value;
            e.target.value = formattedValue;

            // Card type detection
            const cardType = document.getElementById('card-type');
            if (value.startsWith('4')) {
                cardType.textContent = 'Visa';
                cardType.className = 'mt-1 text-sm text-blue-600';
            } else if (value.startsWith('5') || value.startsWith('2')) {
                cardType.textContent = 'Mastercard';
                cardType.className = 'mt-1 text-sm text-red-600';
            } else if (value.startsWith('3')) {
                cardType.textContent = 'American Express';
                cardType.className = 'mt-1 text-sm text-green-600';
            } else {
                cardType.textContent = '';
            }
        });

        // CVV input restriction
        document.getElementById('cvv').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
        });

        // Form submission
        document.getElementById('payment-form').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submit-btn');
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;

            // Clean card number before submission
            const cardNumberInput = document.getElementById('card_number');
            const cardNumber = cardNumberInput.value.replace(/\s/g, '');
            cardNumberInput.value = cardNumber; // Update input value to clean version
            
            // Basic validation
            const cvv = document.getElementById('cvv').value;
            const expiryMonth = document.getElementById('expiry_month').value;
            const expiryYear = document.getElementById('expiry_year').value;

            if (cardNumber.length < 13 || cardNumber.length > 19) {
                e.preventDefault();
                alert('Please enter a valid card number');
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
                return;
            }

            if (cvv.length !== 3) {
                e.preventDefault();
                alert('Please enter a valid CVV');
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
                return;
            }

            if (!expiryMonth || !expiryYear) {
                e.preventDefault();
                alert('Please select expiry date');
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
                return;
            }

            // Check if card is expired
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear() % 100;
            const currentMonth = currentDate.getMonth() + 1;
            
            if (parseInt(expiryYear) < currentYear || 
                (parseInt(expiryYear) === currentYear && parseInt(expiryMonth) < currentMonth)) {
                e.preventDefault();
                alert('Card has expired');
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
                return;
            }
        });

        // Auto-focus next field
        document.getElementById('expiry_month').addEventListener('change', function() {
            if (this.value) {
                document.getElementById('expiry_year').focus();
            }
        });

        document.getElementById('expiry_year').addEventListener('change', function() {
            if (this.value) {
                document.getElementById('cvv').focus();
            }
        });
    </script>
</body>
</html>