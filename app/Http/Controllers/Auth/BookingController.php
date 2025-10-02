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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'adults' => 'required|integer|min:1',
            'rooms'=> 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'name' => $isGuest ? 'required|string|max:255' : 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }

        try {
            $validatedData = $validator->validated();
            
            $user = Auth::user();
            if (!$user) {
                $email = $validatedData['email'] ?? 'guest_' . time() . '@riorelax.com';
                $user = User::firstOrCreate(
                    ['email' => $email],
                    ['first_name' => $validatedData['name'], 
                    'last_name' => $validatedData['name'],
                    'password' => bcrypt(Str::random(16))]
                );
            }

            
            $bookingData = $validatedData;
            $bookingData['user_id'] = $user->id;


            // Convert date format from DD-MM-YYYY to YYYY-MM-DD
            if (isset($bookingData['check_in'])) {
                $bookingData['check_in'] = \Carbon\Carbon::createFromFormat('d-m-Y', $bookingData['check_in'])->format('Y-m-d');
            }
            if (isset($bookingData['check_out'])) {
                $bookingData['check_out'] = \Carbon\Carbon::createFromFormat('d-m-Y', $bookingData['check_out'])->format('Y-m-d');
            }
            // Create the booking
            $booking = new Booking();
            $booking->fill($bookingData);
            $booking->save();
;
            // Store booking ID in session for payment
            $request->session()->put('booking_id', $booking->id);
            return redirect()->route('dashboard.booking.payment.form');
        } catch (\Exception $exception) {
            Log::error('Error storing booking data: ' . $exception->getMessage());
            return back()->with('error', 'An error occurred while storing your booking data. Please try again later.');
        }
    }

    private function generateOTP(Request $request)
    {
        try {
            // Generate OTP
            $otp = '000000';  // Default for testing; use rand(100000, 999999) for production
            // $otp = rand(100000, 999999);

            // Get user phone (from form/session)
            // $phone = $request->phone ?? Auth::user()->phone;

            // if (!$phone) {
            //     throw new \Exception('Phone number is required for OTP.');
            //}

            // $this->formatPhone($phone);  // Validate/format

            // Send via Termii
            // $this->sendOtpWithTermii($phone, $otp);

            // Store in session
            $request->session()->put('otp', $otp);
            $request->session()->put('otp_generated_at', now());

            return redirect()->route('dashboard.booking.otp.form')->with('success', 'OTP sent to your phone. Please verify.');
        } catch (\Exception $e) {
            Log::error('Error sending OTP via Termii: ' . $e->getMessage());
            return back()->with('error', 'Failed to send OTP. Please check your phone number and try again.');
        }
    }




    /**
     * Resend OTP
     */
    public function resendOtp(Request $request)
    {
        try {
            // Check if user can request resend (optional: add rate limiting)
            $lastOtpTime = session('otp_generated_at');
            if ($lastOtpTime && now()->diffInSeconds($lastOtpTime) < 60) {
                return response()->json([
                    'success' => false,
                    'error' => 'Please wait before requesting a new OTP.',
                    'remaining_time' => 60 - now()->diffInSeconds($lastOtpTime)
                ], 429);
            }

            // Generate new OTP
            $otp = '000000'; // Default OTP for testing
            // $otp = rand(100000, 999999);
            
            // Send OTP to user email or phone number
            $user = Auth::user();
            // $phone = $user->phone;
            // $this->formatPhone($phone);
            // $this->sendOtpWithBrevo($otp, $phone);
            
            // For testing, you can send OTP via email
            // Mail::to($user->email)->send(new OtpMail($otp));

            // Store new OTP in session
            $request->session()->put('otp', $otp);
            $request->session()->put('otp_generated_at', now());

            return response()->json(['success' => true, 'message' => 'A new OTP has been sent.']);
        } catch (\Exception $e) {
            Log::error('Error resending OTP: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Failed to resend OTP. Please try again.'], 500);
        }
    }

    public function showOtpForm()
    {
       
        $bookingId = session('booking_id');
        if (!$bookingId) {
            return redirect()->route('home')->with('error', 'No booking found. Please start a new booking.');
        }

        $otp = session()->has('otp');
        // Check if OTP exists in session
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

        // Check if OTP is expired (10 minutes)
        if ($otpGeneratedAt && now()->diffInMinutes($otpGeneratedAt) > 10) {
            $request->session()->forget(['otp', 'otp_generated_at']);
            return redirect()->back()->with('error', 'OTP has expired. Please generate a new OTP.');
        }

        if ($sessionOtp != $request->otp) {
            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }

        // Mark OTP as verified
        $request->session()->put('otp_verified', true);
        $request->session()->forget(['otp', 'otp_generated_at']);

        // Get payment details from session
        $paymentDetails = $request->session()->get('payment_details');
        
        if (!$paymentDetails) {
            return redirect()->route('home')->with('error', 'Payment session expired. Please start again.');
        }

        // Get booking
        $booking = Booking::findOrFail($paymentDetails['booking_id']);
        $amount = $paymentDetails['amount'];
        $paymentType = $paymentDetails['payment_type'];

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
                return back()->with('error', 'Payment URL not received from payment gateway.');
            }
        } else {
            $errorMessage = $result['message'] ?? 'An unknown error occurred with the payment gateway.';
            return back()->with('error', 'Payment failed: ' . $errorMessage);
        }
    }

    public function showPaymentForm()
    {
        $bookingId = session('booking_id');
        if (!$bookingId) {
            return redirect()->route('home')->with('error', 'No booking found. Please start a new booking.');
        }
        $booking = Booking::findOrFail($bookingId);
        return view('dash.booking.payment', compact('booking'));
    }

    /**
     * Process payment based on selected method
     */
    public function processPayment(Request $request)
    {
       $validator = Validator::make($request->all(),[
            'payment_plan' => 'required|string|in:reservation,full,no_payment',
            // 'payment_method' => 'required_if:payment_plan,reservation,full|string|in:card,bank_transfer,ussd,bank_account',
            'city'=>'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'postal_code' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'nullable|string',
            'arrival_time'=>'required|string',  
            'first_name'=> 'required|string',
            'last_name'=> 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }

        // Get validated data
        $validatedData = $validator->validated();
        $paymentMethod = $validatedData['payment_plan'];

        



        // Update user information
        $bookingId = $request->session()->get('booking_id');
        $booking = Booking::findOrFail($bookingId);
        $user = $booking->user;
        
        if ($validatedData['email'] && !User::where('email', $validatedData['email'])->exists()) {
            $user->phone = $validatedData['phone'];
            $user->city = $validatedData['city'];
            $user->state = $validatedData['state'];
            $user->country = $validatedData['country'];
            $user->zip = $validatedData['postal_code'];
            $user->address = $validatedData['address'];
            $user->email = $validatedData['email'];
            $user->first_name = $validatedData['first_name'];
            $user->last_name = $validatedData['last_name']; 
            $user->save();
        }


        $booking->arrival_time = $validatedData['arrival_time'];
        $booking->payment_type = $validatedData['payment_plan'];
        

        

        // Handle different payment methods
        if ($paymentMethod === 'reservation') {
            $amount = (int)(($booking->roomListing->price / 2) * 100); 
           
            
            // Store payment details in session for later use
            $request->session()->put('payment_details', [
                'booking_id' => $booking->id,
                'amount' => $amount,
                'payment_type' => 'reservation'
            ]);
            
            // Generate OTP and redirect to OTP verification
            return $this->generateOTP($request);
        } elseif ($paymentMethod === 'full') {
            $amount = (int)($booking->roomListing->price * 100); 
            

            // Store payment details in session for later use
            $request->session()->put('payment_details', [
                'booking_id' => $booking->id,
                'amount' => $amount,
                'payment_type' => 'full'
            ]);
            
            // Generate OTP and redirect to OTP verification
            return $this->generateOTP($request);
            
        } elseif ($paymentMethod === 'no_payment') {
            $booking->payment_status = 0; // Partial payment
            $booking->booking_number = 'BK' . date('YmdHis') . $booking->id;
            $booking->expires_at = now()->addHours(6);
            $booking->paid_amount  = $request->amount;
            $booking->save();
        }

        return redirect()->route('dashboard.booking.success')->with('success', 'Booking successful! Payment will be collected at check-in.');
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
                'expireAt' => 300, // 5 minutes
                // 'payMethod' => 'BankCard', 
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

            Log::info('OPay Payment URLs', [
            'returnUrl' => $paymentData['returnUrl'],
            'callbackUrl' => $paymentData['callbackUrl'],
        ]);


            $result = $this->oPayService->createOrder($paymentData);
            session()->put('payment_reference', $result);
            // Store payment reference in booking
            $booking->payment_reference = $reference;
            $booking->save();

            // Log the payment creation
            Log::info('OPay payment created', [
                'reference' => $reference,
                'booking_id' => $booking->id,
                'amount' => $amount,
                'result' => $result
            ]);


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
     * Handle payment callback from OPay
     */


    /**
 * Handle payment callback from OPay (Webhook)
 */
public function handlePaymentCallback(Request $request)
{
    Log::info("OPay Webhook Received", ['body' => $request->all()]);

    $payload = $this->oPayService->verifyCallback($request);

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

    Log::info("OPay Webhook: Processing payment", [
        'booking_id' => $booking->id,
        'reference' => $reference,
        'status' => $status,
        'orderNo' => $orderNo,
    ]);

    if ($status === 'SUCCESS') {
        // Use the helper method to confirm payment
        $this->confirmPayment($booking);
        
        Log::info("OPay Webhook: Payment confirmed successfully", ['booking_id' => $booking->id]);
        return response()->json(['status' => 'success'], 200);
    }

    if ($status === 'FAILED') {
        $booking->payment_status = 2; // Failed status
        $booking->save();
        Log::info("OPay Webhook: Payment failed", ['booking_id' => $booking->id]);
        return response()->json(['status' => 'failed'], 200);
    }

    // For any other status (PENDING, INITIAL, etc.)
    Log::info("OPay Webhook: Payment status not final", [
        'booking_id' => $booking->id,
        'status' => $status
    ]);
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
    
    // Add wallet point to user
    $user = $booking->user;
    $user->wallets = $user->wallets + 1;
    $user->save();

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

    Log::info("OPay Return - User redirected back", [
        'booking_id' => $booking->id,
        'reference' => $booking->payment_reference,
        'current_payment_status' => $booking->payment_status,
    ]);

    // Refresh booking to get latest status from database
    $booking->refresh();
    
    // Check if webhook already confirmed the payment
    if ($booking->payment_status == 1) {
        // Payment already confirmed by webhook
        $this->confirmPaymentReturn($booking);
        $request->session()->forget(['booking_id', 'availability_data', 'payment_details']);
        return redirect()->route('home')
            ->with('success', 'Payment successful! Your booking is confirmed.');
    }

    // Payment not yet confirmed - webhook might still be processing
    // Show a "processing" page or message
    $request->session()->forget(['booking_id', 'availability_data', 'payment_details']);
    
    return redirect()->route('home')
        ->with('info', 'Your payment is being processed. You will receive a confirmation email within a few minutes. Please check your email.');
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
    
    // Add wallet point to user
    $user = $booking->user;
    $user->wallets = $user->wallets + 1;
    $user->save();

    Log::info("Payment confirmed for booking {$booking->id}");
}




    /**
     * Show booking success page
     */
    public function showBookingSuccess()
    {
        return view('dash.booking.success');
    }

    /**
     * Show booking status
     */
    

    // Keep your existing OTP methods
    
    /**
     * Send OTP via Termii SMS
     */
    private function sendOtpWithTermii(string $phone, string $otp)
    {
        $client = new Client();

        // Format phone if needed (your existing method handles +234...)
        $formattedPhone = $this->formatPhone($phone);

        $message = "Your RioRelax booking OTP is: {$otp}. Valid for 10 minutes. Do not share.";

        $response = $client->post(config('services.termii.base_url') . '/api/sms/send', [
            'headers' => [
                'api-key' => config('services.termii.api_key'), 
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'to' => $formattedPhone,
                'from' => env('TERMII_SENDER_ID'),
                'sms' => $message,
                'type' => 'plain',
                'channel' => 'dnd',  // Or 'generic' if DND not activated
            ]
        ]);

        $result = json_decode((string) $response->getBody(), true);

        // Log for debugging
        Log::info('Termii OTP Response', ['phone' => $formattedPhone, 'result' => $result]);

        
        if (isset($result['request_id'])) {
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
}
