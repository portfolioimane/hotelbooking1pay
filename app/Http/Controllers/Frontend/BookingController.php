<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\ApiErrorException;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class BookingController extends Controller
{
    private $paypal;

    public function __construct()
    {
        $this->paypal = new PayPalClient;
        $this->paypal->setApiCredentials(config('paypal'));
        $this->paypal->setAccessToken($this->paypal->getAccessToken());
    }

    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->get();
        return view('frontend.bookings.index', compact('bookings'));
    }

    public function create($roomId)
    {
        $room = Room::findOrFail($roomId);
        return view('frontend.bookings.create', compact('room'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'payment_method' => 'required|in:stripe,paypal,cash',
            'payment_method_id' => 'required_if:payment_method,stripe',
        ]);

        $user = Auth::user();

        if (!$user) {
            $user = \App\Models\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make(Str::random(8)),
            ]);
            Auth::login($user);
        }

        Log::info('Processing booking', ['user_id' => $user->id, 'room_id' => $request->room_id]);

        if ($request->payment_method === 'stripe') {
            return $this->handleStripePayment($request, $user);
        } elseif ($request->payment_method === 'paypal') {
            return $this->handlePayPalPayment($request);
        } else {
            // Handle cash payment
            return $this->storeBooking($request, $user, 'cash');
        }
    }

private function handleStripePayment(Request $request, $user)
{
    try {
        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentIntent = PaymentIntent::create([
            'amount' => 1000, // Amount in cents (e.g., 1000 cents = $10.00)
            'currency' => 'usd',
            'description' => 'Room Booking',
            'payment_method' => $request->payment_method_id,
            'confirm' => true,
            'automatic_payment_methods' => [
                'enabled' => true,
                'allow_redirects' => 'never'
            ],
        ]);

        Log::info('Stripe PaymentIntent created', ['payment_intent' => $paymentIntent]);

        // Handle the different statuses of the PaymentIntent
        switch ($paymentIntent->status) {
            case 'requires_action':
            case 'requires_source_action':
                // If payment requires additional action, redirect to the URL provided by Stripe
                return redirect($paymentIntent->next_action->redirect_to_url->url);
            
            case 'succeeded':
                // If payment succeeded, proceed with booking
                return $this->storeBooking($request, $user, 'stripe');

            case 'requires_payment_method':
                // Handle the case where the payment method needs to be updated
                Log::error('Payment method required', ['payment_intent_status' => $paymentIntent->status]);
                return back()->withErrors(['error' => 'Payment method required.']);
            
            default:
                Log::error('Payment failed', ['payment_intent_status' => $paymentIntent->status]);
                throw new \Exception('Payment failed.');
        }
    } catch (ApiErrorException $e) {
        Log::error('Stripe API Error', ['error' => $e->getMessage()]);
        return back()->withErrors(['error' => $e->getMessage()]);
    } catch (\Exception $e) {
        Log::error('General Error', ['error' => $e->getMessage()]);
        return back()->withErrors(['error' => $e->getMessage()]);
    }
}



    private function handlePayPalPayment(Request $request)
    {
        // Store all booking details in session
        session()->put('booking_details', $request->except('payment_method_id'));

        $amount = ['value' => '10.00', 'currency_code' => 'USD'];
        $redirectUrls = [
            'return_url' => route('frontend.bookings.paypal.callback'),
            'cancel_url' => route('frontend.bookings.create', ['roomId' => $request->room_id]),
        ];

        $paymentData = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => $amount,
                    'description' => 'Room Booking',
                ],
            ],
            'application_context' => [
                'return_url' => $redirectUrls['return_url'],
                'cancel_url' => $redirectUrls['cancel_url'],
            ],
        ];

        try {
            $payment = $this->paypal->createOrder($paymentData);
            if (!isset($payment['id']) || !isset($payment['links'][1]['href'])) {
                Log::error('PayPal Order Creation Failed', ['paypalOrder' => $payment]);
                throw new \Exception('PayPal order creation failed.');
            }

            $approvalUrl = $payment['links'][1]['href'];

            return redirect()->away($approvalUrl); // Redirect user to PayPal
        } catch (\Exception $e) {
            Log::error('PayPal Error', ['error' => $e->getMessage()]);
            return redirect()->route('frontend.bookings.create', ['roomId' => $request->room_id])
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function paypalCallback(Request $request)
    {
        $paymentId = $request->query('token'); // Capture token from query parameters

        // Retrieve booking details from session
        $bookingDetails = session()->get('booking_details');

        if (!$bookingDetails) {
            return redirect()->route('frontend.bookings.create')
                ->withErrors(['error' => 'Booking details not found in session.']);
        }

        try {
            $payment = $this->paypal->capturePaymentOrder($paymentId); // Capture the payment

            Log::info('PayPal Payment Captured', ['payment' => $payment]);

            if ($payment['status'] === 'COMPLETED') {
                return $this->storeBooking((object) $bookingDetails, Auth::user(), 'paypal');
            } else {
                Log::error('PayPal Payment Not Completed', ['payment_state' => $payment]);
                throw new \Exception('Payment was not completed.');
            }
        } catch (\Exception $e) {
            Log::error('PayPal Callback Error', ['error' => $e->getMessage()]);
            return redirect()->route('frontend.bookings.create', ['roomId' => $bookingDetails['room_id']])
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function storeBooking($requestData, $user, $paymentMethod = 'cash')
    {
        Booking::create([
            'room_id' => $requestData->room_id,
            'user_id' => $user->id,
            'name' => $requestData->name,
            'email' => $requestData->email,
            'phone' => $requestData->phone,
            'check_in' => $requestData->check_in,
            'check_out' => $requestData->check_out,
            'payment_method' => $paymentMethod,
        ]);

        return redirect()->route('frontend.bookings.index')->with('success', 'Booking successful!');
    }
}
