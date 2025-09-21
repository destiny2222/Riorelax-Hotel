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

            // Store booking data and OTP in session
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
            $otp = '000000'; // Default OTP for testing
            //  $otp = rand(100000, 999999);
            // send otp to user email or phone number
            // $phone = $request->phone;
            // $this->formatPhone($phone);
            // $this->sendOtpWithBrevo($otp, $phone);

            // Get validated data
            $request->session()->put('otp', $otp);;
            $request->session()->put('otp_generated_at', now());
            return redirect()->route('dashboard.booking.payment.form')->with('success', 'OTP verified. Please proceed to payment.');
        } catch (\Exception $e) {
            Log::error('Error sending OTP: ' . $e->getMessage());
            return back()->with('error', 'Failed to send OTP. Please try again.');
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
        } catch (\Exception $e) {
            Log::error('Error resending OTP: ' . $e->getMessage());
            return back()->with('error', 'Failed to resend OTP. Please try again.');
        }
    }

    public function showOtpForm()
    {
        $bookingId = session('booking_id');
        if (!$bookingId) {
            return redirect()->route('home')->with('error', 'No booking found. Please start a new booking.');
        }

        // Check if payment details exist
        $paymentDetails = session('payment_details');
        if (!$paymentDetails) {
            return redirect()->route('dashboard.booking.payment.form')->with('error', 'Payment details not found. Please try again.');
        }

        // Check if OTP exists in session
        if (!session()->has('otp')) {
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

        return redirect()->route('dashboard.booking.card.payment')->with('success', 'OTP verified successfully. Please continue with payment.');
        
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
            'payment_method' => 'required|string|in:reservation,full,no_payment',
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

        



        // Update user information
        $bookingId = $request->session()->get('booking_id');
        $booking = Booking::findOrFail($bookingId);
        $user = $booking->user;
        

        // save the email if it does not exists in database, skip the email validation
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
        $booking->payment_type = $validatedData['payment_method'];
        $booking->save();

        if (!$booking) {
            return redirect()->route('home')->with('error', 'Booking not found.');
        }

        $paymentMethod = $request->input('payment_method');

        try {
            if ($paymentMethod === 'reservation') {
                // Process half payment with OPay
                $amount = $booking->roomListing->price / 2;
                
                // Generate OTP and redirect to OTP verification
                $this->generateOTP($request);
                
                // Store payment details in session for later use
                $request->session()->put('payment_details', [
                    'booking_id' => $booking->id,
                    'amount' => $amount,
                    'payment_type' => 'reservation'
                ]);
                return redirect()->route('dashboard.booking.otp.form');
            } elseif ($paymentMethod === 'full') {
                // Process full payment with OPay
                $amount = $booking->roomListing->price;
                
                // Generate OTP and redirect to OTP verification
                $this->generateOTP($request);
                
                // Store payment details in session for later use
                $request->session()->put('payment_details', [
                    'booking_id' => $booking->id,
                    'amount' => $amount,
                    'payment_type' => 'full'
                ]);
                return redirect()->route('dashboard.booking.otp.form');
            } elseif ($paymentMethod === 'no_payment') {
                // Set expiration time
                $booking->expires_at = now()->addHours(6);
                $booking->save();

                // Send booking confirmation email if needed

                return redirect()->route('home')->with('success', 'Booking successful!');
            }

        } catch (\Exception $e) {
            Log::error('Payment processing error: ' . $e->getMessage());
            return back()->with('error', 'Payment processing failed. Please try again.');
        }

        return redirect()->route('home')->with('success', 'Booking successful!');
    }

    /**
     * Show card payment form
     */
    public function showCardPaymentForm()
    {
        // Check if OTP has been verified
        if (!session()->has('otp_verified') || !session('otp_verified')) {
            return redirect()->route('dashboard.booking.otp.form')->with('error', 'Please verify OTP first.');
        }

        // Get payment details from session
        $paymentDetails = session('payment_details');
        if (!$paymentDetails) {
            return redirect()->route('home')->with('error', 'Payment details not found.');
        }

        $booking = Booking::findOrFail($paymentDetails['booking_id']);
        $amount = $paymentDetails['amount'];
        $paymentType = $paymentDetails['payment_type'];

        // Clear the OTP verification flag after use
        session()->forget(['otp_verified', 'payment_details']);
        return view('dash.booking.card-payment', compact('booking', 'amount', 'paymentType'));
    }

    /**
     * Process the actual OPay payment with card details
     */
    public function processCardPayment(Request $request)
    {
        $request->validate([
            'card_holder_name' => 'required|string|max:255',
            'card_number'      => ['required', 'string', 'regex:/^[0-9]{13,19}$/'],
            'cvv'              => ['required', 'string', 'size:3', 'regex:/^[0-9]{3}$/'],
            'expiry_month'     => ['required', 'string', 'size:2', 'regex:/^(0[1-9]|1[0-2])$/'],
            'expiry_year'      => ['required', 'string', 'size:2', 'regex:/^[0-9]{2}$/'],
        ]);

        try {
            $booking = Booking::findOrFail($request->booking_id);

            // Verify the amount matches what should be paid
            $expectedAmount = $request->payment_type === 'full' 
                ? $booking->roomListing->price 
                : $booking->roomListing->price / 2;

            if (abs($request->amount - $expectedAmount) > 0.01) {
                return back()->with('error', 'Invalid payment amount.');
            }

            $result = $this->processOPayPayment($booking, $request->amount, $request);

            if ($result['success']) {
                if ($request->payment_type === 'full') {
                    $booking->payment_status = 1;
                    $booking->paid_amount  = $request->amount;
                    // generate a booking number
                    $booking->booking_number = 'BK' . date('YmdHis') . $booking->id;
                    // Generate QR code
                    $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode('Booking ID: ' . $booking->id);
                    $booking->qrcode = $qrCodeUrl;

                    // Send booking confirmation email
                    Mail::to($booking->user->email)->send(new BookingConfirmation($booking, $qrCodeUrl));
       
                    $booking->save();

                    $user = $booking->user;
                    // ADD ONE TO USER WALLET IN VERY EACH BOOKING
                    $user->wallets = $user->wallets + 1;
                    $user->save();
                    

                    // Clear booking ID from session
                    $request->session()->forget('booking_id');

                    return redirect()->route('dashboard.booking.success')->with('success', 'Payment successful!')
                        ->with('qrcode', $qrCodeUrl);
                } else {
                    $booking->payment_status = 0; // Partial payment
                    $booking->booking_number = 'BK' . date('YmdHis') . $booking->id;
                    $booking->expires_at = now()->addHours(6);
                    $booking->paid_amount  = $request->amount;
                    $booking->save();

                    return redirect()->route('home')->with('success', 'Reservation payment successful!');
                }
            } else {
                return back()->with('error', 'Payment failed: ' . $result['message']);
            }


           
        } catch (\Exception $e) {
            Log::error('Card payment processing error: ' . $e->getMessage());
            return back()->with('error', 'Payment processing failed. Please try again.');
        }
    }

    /**
     * Process OPay payment
     */
    private function processOPayPayment($booking, $amount, $request)
    {
        try {
            $reference = 'BOOK_' . $booking->id . '_' . time();
            
            $paymentData = [
                'amount' => [
                    'currency' => 'NGN', 
                    'total' => (int)($amount * 100)
                ],
                'bankcard' => [
                    'cardHolderName' => $request->card_holder_name,
                    'cardNumber' => str_replace(' ', '', $request->card_number),
                    'cvv' => $request->cvv,
                    'enable3DS' => true,
                    'expiryMonth' => $request->expiry_month,
                    'expiryYear' => $request->expiry_year
                ],
                'callback_url' => route('dashboard.payment.callback'),
                'country' => 'NG',
                'pay_method' => 'BankCard',
                'product' => [
                    'description' => 'Room booking payment for ' . $booking->roomListing->room_title,
                    'name' => 'Room Booking - ' . $booking->roomListing->room_title
                ],
                'reference' => $reference,
                'return_url' => route('dashboard.payment.return')
            ];

            $result = $this->oPayService->createPayment($paymentData);

            // Store payment reference in booking
            $booking->payment_reference = $reference;
            $booking->save();

            return [
                'success' => true,
                'data' => $result
            ];

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
    public function handlePaymentCallback(Request $request)
    {
        try {
            $callbackData = $request->all();
            dd($callbackData);
           
            if (!$this->oPayService->verifyCallback($callbackData)) {
                Log::error('Invalid payment callback signature', $callbackData);
                return response()->json(['error' => 'Invalid signature'], 400);
            }

            // Find booking by payment reference
            $reference = $callbackData['reference'] ?? null;
            $booking = Booking::where('payment_reference', $reference)->first();
            
            if (!$booking) {
                Log::error('Booking not found for payment reference: ' . $reference);
                return response()->json(['error' => 'Booking not found'], 404);
            }

            // Update booking based on payment status
            if ($callbackData['status'] === 'SUCCESS') {
                $booking->payment_status = 1;
                $booking->payment_confirmed_at = now();
                
                // Generate QR code if not exists
                if (!$booking->qrcode) {
                    $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode('Booking ID: ' . $booking->id);
                    $booking->qrcode = $qrCodeUrl;
                    
                    // Send confirmation email
                    Mail::to($booking->user->email)->send(new BookingConfirmation($booking, $qrCodeUrl));
                }
                
                $booking->save();
                
                Log::info('Payment successful for booking: ' . $booking->id);
            } else {
                Log::error('Payment failed for booking: ' . $booking->id, $callbackData);
            }
            
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            Log::error('Payment callback error: ' . $e->getMessage());
            return response()->json(['error' => 'Callback processing failed'], 500);
        }
    }

    /**
     * Handle payment return URL
     */
    public function handlePaymentReturn(Request $request)
    {
        // Get booking from session or URL parameter
        $bookingId = $request->session()->get('booking_id') ?? $request->get('booking_id');
        
        if ($bookingId) {
            $booking = Booking::find($bookingId);
            if ($booking) {
                return redirect()->route('home')->with('success', 'Payment processed. Please check your booking status.');
            }
        }
        
        return redirect()->route('home')->with('message', 'Payment processed.');
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
    private function sendOtpWithBrevo($phone, $otp)
    {
        $client = new Client();

        $response = $client->post('https://api.brevo.com/v3/transactionalSMS/sms', [
            'headers' => [
                'api-key' => env('BREVO_API_KEY'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'sender'  => env('BREVO_SMS_SENDER'),
                'recipient' => $phone,
                'content' => "Your OTP code is: {$otp}",
                'type' => 'transactional',
            ]
        ]);

        return json_decode((string) $response->getBody(), true);
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
