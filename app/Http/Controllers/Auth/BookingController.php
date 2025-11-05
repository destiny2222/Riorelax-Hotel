<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Booking;
use App\Models\RoomListing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\OPayService;
use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{

    private $oPayService;

    public function __construct(OPayService $oPayService)
    {
        $this->oPayService = $oPayService;
    }

    public function store(Request $request){
        $isGuest = !Auth::check();
        
        $validator = Validator::make($request->all(),[
            'room_listing_id' => 'required|exists:room_listings,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'adults' => 'required|integer|min:1',
            'rooms'=> 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'name' => $isGuest ? 'nullable|string|max:255' : 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        if ($validator->fails()) {
            Alert::error('Validation Error', $validator->errors()->first());
            return back()->withInput();
        }

        try {
            $validatedData = $validator->validated();
            
            $user = Auth::user();
            if (!$user) {
                $email = $validatedData['email'] ?? 'guest_' . time() . '@riorelax.com';
                $user = User::firstOrCreate(
                    ['email' => $email],
                    ['first_name' => $validatedData['name'] ?? '', 
                    'last_name' => $validatedData['name'] ?? '',
                    'password' => bcrypt(Str::random(16))]
                );
            }

            
            $bookingData = $validatedData;
            $bookingData['user_id'] = $user->id;


            // Convert date format from DD-MM-YYYY to YYYY-MM-DD
            if (isset($bookingData['check_in_date'])) {
                $bookingData['check_in_date'] = \Carbon\Carbon::createFromFormat('d-m-Y', $bookingData['check_in_date'])->format('Y-m-d');
            }
            if (isset($bookingData['check_out_date'])) {
                $bookingData['check_out_date'] = \Carbon\Carbon::createFromFormat('d-m-Y', $bookingData['check_out_date'])->format('Y-m-d');
            }
            
            // Create the booking
            $booking = new Booking();
            $booking->fill($bookingData);
            $booking->save();

            // Calculate and apply discount
            $totals = $booking->calculateBookingTotals();
            if ($totals) {
                $booking->subtotal = $totals['subtotal'];
                $booking->room_days = $totals['room_days'];
                $booking->discount_percentage = $totals['discount_percentage'];
                $booking->discount_amount = $totals['discount_amount'];
                $booking->total_amount = $totals['total_amount'];
                $booking->save();
            }

            // Store booking ID in session for payment
            $request->session()->put('booking_id', $booking->id);
            return redirect()->route('dashboard.booking.payment.form');
        } catch (\Exception $exception) {
            Log::error('Error storing booking data: ' . $exception->getMessage());
            Alert::error('Error', 'An error occurred while storing your booking data. Please try again later.');
            return back()->withInput();
        }
    }

    private function generateOTP(Request $request)
    {
        try {
            $otp = rand(100000, 999999);
            // $otp = '000000'; 
            $phone = $request->phone ?? Auth::user()->phone ?? null;
            $email = $request->email ?? Auth::user()->email ?? null;

            // If both phone and email are available, prefer phone (default)
            if ($phone) {
                $this->formatPhone($phone);
                $this->sendOtpWithTermii($phone, $otp);
                $request->session()->put('otp', $otp);
                $request->session()->put('otp_generated_at', now());
                $request->session()->put('phone_for_otp', $phone);
                $request->session()->put('otp_method', 'phone');

                Alert::success('Success', 'OTP sent to your phone. Please verify.');
                return redirect()->route('dashboard.booking.otp.form');
            } elseif ($email) {
                $this->sendOtpViaEmail($email, $otp);
                $request->session()->put('otp', $otp);
                $request->session()->put('otp_generated_at', now());
                $request->session()->put('email_for_otp', $email);
                $request->session()->put('otp_method', 'email');

                Alert::success('Success', 'OTP sent to your email. Please verify.');
                return redirect()->route('dashboard.booking.otp.form');
            } else {
                Alert::error('Error', 'Please provide either a phone number or email address.');
                return back()->withInput();
            }
        } catch (\Exception $e) {
            Log::error('Error sending OTP: ' . $e->getMessage());
            Alert::error('Error', 'Failed to send OTP. Please try again.');
            return back()->withInput();
        }
    }




    /**
     * Resend OTP
     */
    public function resendOtp(Request $request)
    {
        try {
            $lastOtpTime = session('otp_generated_at');
            if ($lastOtpTime && abs(now()->diffInSeconds($lastOtpTime)) < 60) {
                $remainingTime = 60 - abs(now()->diffInSeconds($lastOtpTime));
                Alert::error('Error', "Please wait {$remainingTime} seconds before requesting a new OTP.");
                return back()->withInput();
            }

            $otp = rand(100000, 999999);
            
            // Check the original OTP method used
            $otpMethod = session('otp_method', 'phone'); // default to phone for backward compatibility
            
            if ($otpMethod === 'phone') {
                $phone = $request->phone ?? (Auth::check() ? Auth::user()->phone : session('phone_for_otp'));

                if(!$phone){
                    Alert::error('Error', 'Phone number not found. Please provide a phone number.');
                    return back()->withInput();
                }
                 
                $this->sendOtpWithTermii($phone, $otp);
                Alert::success('Success', 'A new OTP has been sent to your phone.');
            } else {
                $email = $request->email ?? (Auth::check() ? Auth::user()->email : session('email_for_otp'));

                if(!$email){
                    Alert::error('Error', 'Email address not found. Please provide an email address.');
                    return back()->withInput();
                }
                 
                $this->sendOtpViaEmail($email, $otp);
                Alert::success('Success', 'A new OTP has been sent to your email.');
            }
            
            $request->session()->put('otp', $otp);
            $request->session()->put('otp_generated_at', now());
            return back();
        } catch (\Exception $e) {
            Log::error('Error resending OTP: ' . $e->getMessage());
            Alert::error('Error', 'Failed to resend OTP. Please try again.');
            return back()->withInput();
        }
    }

    public function showOtpForm()
    {
       
        $bookingId = session('booking_id');
        if (!$bookingId) {
            return redirect()->route('home')->with('error', 'No booking found. Please start a new booking.');
        }

        

        $otp = session()->has('otp');
        if (!$otp) {
            return redirect()->route('dashboard.booking.payment.form')->with('error', 'OTP not generated. Please try again.');
        }

        return view('dash.booking.otp');
    }


    public function verifyOtp(Request $request)
    {
        
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        $sessionOtp = $request->session()->get('otp');
        $otpGeneratedAt = $request->session()->get('otp_generated_at');

        if (!$sessionOtp) {
            return redirect()->back()->with('error', 'OTP not found. Please generate a new OTP.');
        }

        if ($otpGeneratedAt && now()->diffInMinutes($otpGeneratedAt) > 10) {
            $request->session()->forget(['otp', 'otp_generated_at']);
            return redirect()->back()->with('error', 'OTP has expired. Please generate a new OTP.');
        }

        if ($sessionOtp != $request->otp) {
            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }

        $request->session()->put('otp_verified', true);
        $request->session()->forget(['otp', 'otp_generated_at']);

        $paymentDetails = $request->session()->get('payment_details');
        
        if (!$paymentDetails) {
            return redirect()->route('home')->with('error', 'Payment session expired. Please start again.');
        }

        // Get booking
        $booking = Booking::findOrFail($paymentDetails['booking_id']);
        $amount = $paymentDetails['amount'];
        $paymentType = $paymentDetails['payment_type'];

        if ($paymentType === 'no_payment') {
            $booking->payment_status = 0; // "Pay at Hotel" status
            $booking->booking_number = 'BK' . date('YmdHis') . $booking->id;
            $booking->expires_at = now()->addHours(6);
            $booking->payment_type = "no payment";
            $booking->paid_amount = 0;
            $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode('Booking ID: ' . $booking->id);
            $booking->qrcode = $qrCodeUrl;
            $booking->save();

            $request->session()->forget('payment_details');
            Alert::success('Success', 'Booking successful! Payment will be collected at check-in.');
            return redirect()->route('dashboard.booking.success');
        }

        // Process OPay payment
        $result = $this->processOPayPayment($booking, $amount, $request);

        if (isset($result['code']) && $result['code'] === '00000') {
            // Clear payment details from session
            $request->session()->forget('payment_details');
            
            // Redirect to OPay's payment page
            $cashierUrl = $result['data']['cashierUrl'] ?? null;
            if ($cashierUrl) {
                return redirect()->away($cashierUrl);
            } else {
                Alert::error('Error', 'Payment URL not received from payment gateway.');
                return back();
            }
        } else {
            $errorMessage = $result['message'] ?? 'An unknown error occurred with the payment gateway.';
            Alert::error('Payment Failed', 'Payment failed: ' . $errorMessage);
            return back();
        }
    }

    public function showPaymentForm()
    {
        $bookingId = session('booking_id');
        if (!$bookingId) {
            Alert::error('Error', 'No booking found. Please start a new booking.');
            return redirect()->route('home');
        }
        $booking = Booking::with('user')->findOrFail($bookingId);
        $walletPoints = $booking->user->wallet_points ?? 0;
        $discountCode = $booking->user->discountCode ?? null;
        
        return view('dash.booking.payment', compact('booking', 'walletPoints', 'discountCode'));
    }

    /**
     * Process payment based on selected method
     */
    public function processPayment(Request $request)
    {
       $validator = Validator::make($request->all(),[
            'payment_plan' => 'required|string|in:reservation,full,no_payment',
            'city'=>'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'postal_code' => 'required|string',
            'address' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'arrival_time'=>'required|string',  
            'first_name'=> 'required|string',
            'last_name'=> 'required|string',
            'use_wallet_points' => 'nullable|boolean',
            'wallet_points_to_use' => 'nullable|numeric|min:0',
            'discount_code' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }

        // Get validated data
        $validatedData = $validator->validated();
        
        // Ensure at least one contact method is provided
        if (empty($validatedData['phone']) && empty($validatedData['email'])) {
            return back()->with('error', 'Please provide either a phone number or email address for OTP verification.');
        }

        $paymentMethod = $validatedData['payment_plan'];

        



        // Update user information
        $bookingId = $request->session()->get('booking_id');
        $booking = Booking::findOrFail($bookingId);
        $user = $booking->user;
        
        // Always update user information associated with the booking
        if ($validatedData['phone']) {
            $user->phone = $validatedData['phone'];
        }
        $user->city = $validatedData['city'];
        $user->state = $validatedData['state'];
        $user->country = $validatedData['country'];
        $user->zip = $validatedData['postal_code'];
        $user->address = $validatedData['address'];
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name']; 
        
        // Only update email if it's provided and not already taken by another user
        if ($validatedData['email'] && (!Auth::check() || Auth::user()->email !== $validatedData['email'])) {
            if (!User::where('email', $validatedData['email'])->where('id', '!=', $user->id)->exists()) {
                $user->email = $validatedData['email'];
            } else {
                Log::warning('Attempted to update user email to an already existing email: ' . $validatedData['email']);
            }
        }
        $user->save();

        $booking->arrival_time = $validatedData['arrival_time'];
        $booking->payment_type = $validatedData['payment_plan'];
        
        // Handle discount code
        $discountCodeAmount = 0;
        if (isset($validatedData['discount_code']) && $validatedData['discount_code']) {
            $discountCode = \App\Models\DiscountCode::where('code', $validatedData['discount_code'])
                ->where('user_id', $user->id)
                ->where('is_active', true)
                ->first();

            if ($discountCode) {
                if ($discountCode->canBeUsed()) {
                    // Apply 60% discount
                    $discountCodeAmount = ($booking->total_amount * 60) / 100;
                    $booking->discount_code_used = $discountCode->code;
                    $booking->discount_code_amount = $discountCodeAmount;
                    $booking->total_amount -= $discountCodeAmount;
                    $booking->save();

                    // Mark code as used
                    $discountCode->markAsUsed();
                } else {
                    Alert::warning('Discount Code', 'This discount code can only be used once per week.');
                }
            } else {
                Alert::warning('Invalid Code', 'The discount code is invalid or not applicable to your account.');
            }
        }
        
        // Handle wallet points usage
        $walletPointsUsed = 0;
        if (isset($validatedData['use_wallet_points']) && $validatedData['use_wallet_points']) {
            $walletPointsToUse = min($validatedData['wallet_points_to_use'] ?? 0, $user->wallet_points, $booking->total_amount);
            
            if ($walletPointsToUse > 0) {
                // Deduct wallet points from user
                $user->wallet_points -= $walletPointsToUse;
                $user->save();
                
                // Record wallet points used in booking
                $booking->wallet_points_used = $walletPointsToUse;
                $booking->total_amount -= $walletPointsToUse;
                $booking->save();
                
                $walletPointsUsed = $walletPointsToUse;
            }
        }

        

        // Handle different payment methods
        if ($paymentMethod === 'reservation') {
            // 50% of total amount (after discount code and wallet points)
            $amountAfterDiscounts = $booking->total_amount;
            $amount = (int)(($amountAfterDiscounts / 2) * 100); 
           
            
            // Store payment details in session for later use
            $request->session()->put('payment_details', [
                'booking_id' => $booking->id,
                'amount' => $amount,
                'payment_type' => 'reservation'
            ]);
            
            // Generate OTP and redirect to OTP verification
            return $this->generateOTP($request);
        } elseif ($paymentMethod === 'full') {
            // Full amount (after discount code and wallet points)
            $amountAfterDiscounts = $booking->total_amount;
            $amount = (int)($amountAfterDiscounts * 100); 
            

            // Store payment details in session for later use
            $request->session()->put('payment_details', [
                'booking_id' => $booking->id,
                'amount' => $amount,
                'payment_type' => 'full'
            ]);
            
            // Generate OTP and redirect to OTP verification
            return $this->generateOTP($request);
            
        } elseif ($paymentMethod === 'no_payment') {
            // Store payment details in session for later use
            $request->session()->put('payment_details', [
                'booking_id' => $booking->id,
                'amount' => 0,
                'payment_type' => 'no_payment'
            ]);
            
            // Generate OTP and redirect to OTP verification
            return $this->generateOTP($request);
        }
    }




    /**
     * Process OPay payment
     */
    private function processOPayPayment($booking, $amount, $request)
    {
        try {
            $reference = $booking->id . time();

            $paymentData = [
                'country' => 'NG',
                'reference' => $reference,
                'amount' => [
                    'total' => (int)$amount, 
                    'currency' => 'NGN'
                ],
                'returnUrl' => route('dashboard.payment.return'),
                'callbackUrl' => route('dashboard.payment.callback'),
                // 'cancelUrl' => route('dashboard.payment.return'),
                'displayName' => config('app.name'),
                'customerVisitSource' => 'WEB',
                'evokeOpay' => true,
                'expireAt' => 300,
                'userInfo' => [
                    'userEmail' => $booking->user->email,
                    'userId' => (string)$booking->user->id,
                    'userMobile' => $booking->user->phone ?? '',
                    'userName' => $booking->user->first_name . ' ' . $booking->user->last_name
                ],
                'product' => [
                    'name' => 'Room Booking - ' . $booking->roomListing->room_title,
                    'description' => 'Room booking payment for ' . $booking->roomListing->room_title
                ]
            ];

        


            $result = $this->oPayService->createOrder($paymentData);
            session()->put('payment_reference', $result);
            $booking->payment_reference = $reference;
            $booking->save();


            return $result;

        } catch (\Exception $e) {
            Log::error('OPay payment error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Payment creation failed',
                'error' => $e->getMessage()
            ];
        }
    }


   


    /**
     * Handle payment callback from OPay (Webhook)
     */
public function handlePaymentCallback(Request $request)
{

    $signature = Str::after($request->header('Authorization', ''), 'Bearer ');

    $payload = $this->oPayService->verifyCallback($request->all(), $signature);

    if (!$payload) {
        Log::error("OPay Webhook: Invalid signature");
        return response()->json(['error' => 'Invalid signature'], 400);
    }

    $reference = $payload['reference'] ?? null;
    $status    = $payload['status'] ?? null;
    $orderNo   = $payload['orderNo'] ?? null;

    if (!$reference) {
        Log::error("OPay Webhook: Missing reference");
        return response()->json(['error' => 'Missing reference'], 400);
    }

    $booking = Booking::where('payment_reference', $reference)->first();
    if (!$booking) {
        Log::error("OPay Webhook: Booking not found", ['reference' => $reference]);
        return response()->json(['error' => 'Booking not found'], 404);
    }

   

    if ($status === 'SUCCESS') {
        $this->confirmPayment($booking);
        return response()->json(['status' => 'success'], 200);
    }

    if ($status === 'FAILED') {
        $booking->payment_status = 2; 
        $booking->save();
        return response()->json(['status' => 'failed'], 200);
    }

    
    return response()->json(['status' => 'acknowledged'], 200);
}

/**
 * Helper method to confirm payment
 */
private function confirmPayment($booking)
{
    // Only confirm if not already confirmed
    if ($booking->payment_status == 1) {
        Log::info("Payment already confirmed", ['booking_id' => $booking->id]);
        return;
    }

    $booking->payment_status = 1;
    $booking->payment_confirmed_at = now();
    $booking->booking_number = 'BK' . date('YmdHis') . $booking->id;
    
    // Generate QR code if not exists
    if (!$booking->qrcode) {
        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode('Booking ID: ' . $booking->id);
        $booking->qrcode = $qrCodeUrl;

        // Send confirmation email
        try {
            Mail::to($booking->user->email)->send(new BookingConfirmation($booking, $qrCodeUrl));
        } catch (\Exception $e) {
            Log::error('Failed to send booking confirmation email', [
                'booking_id' => $booking->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    $booking->save();

    Log::info("Payment confirmed for booking {$booking->id}");
}


   /**
 * Handle payment return URL
 * OPay redirects here after payment but doesn't send status in URL
 * Actual confirmation comes via webhook
 */
public function handlePaymentReturn(Request $request)
{
    // Get booking from session
    $bookingId = session()->get('booking_id');

    if (!$bookingId) {
        return redirect()->route('home')->with('error', 'Booking session expired or missing.');
    }

    $booking = Booking::find($bookingId);
    if (!$booking) {
        return redirect()->route('home')->with('error', 'Booking not found.');
    }

    $booking->refresh();
    
    // Check if webhook already confirmed the payment
    if ($booking->payment_status == 1) {
        $this->confirmPaymentReturn($booking);
        $request->session()->forget(['booking_id', 'availability_data', 'payment_details']);
        return redirect()->route('home')
            ->with('success', 'Payment successful! Your booking is confirmed.');
    }
    $request->session()->forget(['booking_id', 'availability_data', 'payment_details']);
    Alert::info('Info', 'Your payment is being processed. You will receive a confirmation email within a few minutes. Please check your email.');
    return redirect()->route('home');
}

/**
 * Helper method to confirm payment
 */
private function confirmPaymentReturn($booking)
{
    $booking->payment_status = 1;
    $booking->payment_confirmed_at = now();
    $booking->booking_number = 'BK' . date('YmdHis') . $booking->id;
    
    // Generate QR code if not exists
    if (!$booking->qrcode) {
        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode('Booking ID: ' . $booking->id);
        $booking->qrcode = $qrCodeUrl;

        // Send confirmation email
        try {
            Mail::to($booking->user->email)->send(new BookingConfirmation($booking, $qrCodeUrl));
        } catch (\Exception $e) {
            Log::error('Failed to send booking confirmation email', [
                'booking_id' => $booking->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    $booking->save();
}




    /**
     * Show booking success page
     */
    public function showBookingSuccess()
    {
        return view('dash.booking.success');
    }

    
    /**
     * Send OTP via Termii SMS
     */
    private function sendOtpWithTermii(string $phone, string $otp)
    {
        $formattedPhone = $this->formatPhone($phone);
        $message = "Your House7 booking OTP is: {$otp}. Valid for 10 minutes. Do not share.";

        $payload = [
            'to' => $formattedPhone,
            'from' => config('services.termii.sender_id'),
            'sms' => $message,
            'api_key' => config('services.termii.api_key'),
            'type' => 'plain',
            'channel' => 'generic',
        ];


        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(config('services.termii.base_url') . '/api/sms/send', $payload);

        $result = $response->json();

   
        if ($response->successful() && isset($result['message_id'])) {
            return $result;
        } else {
            Log::error('Termii OTP Error', ['error' => $result['message'] ?? 'Unknown error']);
            throw new \Exception('Failed to send OTP via Termii: ' . ($result['message'] ?? 'Unknown error'));
        }
    }

    private function formatPhone($phone)
    {
        $phone = preg_replace('/\D/', '', $phone);

        if (substr($phone, 0, 1) === '0') {
            $phone = '+234' . substr($phone, 1);
        } elseif (substr($phone, 0, 3) === '234') {
            $phone = '+' . $phone;
        }

        return $phone;
    }

    /**
     * Send OTP via email
     */
    private function sendOtpViaEmail(string $email, string $otp)
    {
        $subject = 'Your House7 Booking OTP';
        $message = "Your House7 booking OTP is: {$otp}. Valid for 10 minutes. Do not share this code with anyone.";

        try {
            Mail::raw($message, function ($mail) use ($email, $subject) {
                $mail->to($email)
                     ->subject($subject);
            });

            Log::info('Email OTP sent successfully', ['email' => $email]);
            return true;
        } catch (\Exception $e) {
            Log::error('Email OTP Error', ['error' => $e->getMessage(), 'email' => $email]);
            throw new \Exception('Failed to send OTP via email: ' . $e->getMessage());
        }
    }
}
