@extends('frontend.layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Book Room: {{ $room->name }}</h2>
    
    <!-- Display success or error messages -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('frontend.bookings.store') }}" method="POST" id="payment-form">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Your Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="check_in">Check-in</label>
                            <input type="date" class="form-control" id="check_in" name="check_in" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="check_out">Check-out</label>
                            <input type="date" class="form-control" id="check_out" name="check_out" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="payment_method">Payment Method</label>
                            <select class="form-control" id="payment_method" name="payment_method" required>
                                <option value="cash">Cash</option>
                                <option value="stripe">Credit/Debit Card (Stripe)</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>
                    </div>

                    <!-- Stripe Elements -->
                    <div id="stripe-card-element" class="col-md-12" style="display: none;">
                        <div class="form-group">
                            <label for="card-element">Credit or Debit Card</label>
                            <div id="card-element" class="form-control"></div>
                            <div id="card-errors" role="alert" class="text-danger"></div>
                        </div>
                    </div>

                    <!-- PayPal Button -->
                    <div id="paypal-button-container" class="col-md-12" style="display: none;"></div>
                </div>
                <button type="submit" class="btn btn-primary mt-3" id="submit-button">Book Now</button>
            </form>
        </div>
    </div>
</div>

<!-- Stripe JS -->
<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var stripeKey = '{{ config('services.stripe.key') }}';
    var stripe = Stripe(stripeKey);
    var elements = stripe.elements();
    var card = elements.create('card');
    var cardElement = document.getElementById('card-element');
    var cardErrors = document.getElementById('card-errors');
    var stripeCardElement = document.getElementById('stripe-card-element');
    var paypalButtonContainer = document.getElementById('paypal-button-container');

    card.mount(cardElement);

    document.getElementById('payment_method').addEventListener('change', function() {
        var selectedPaymentMethod = this.value;
        if (selectedPaymentMethod === 'stripe') {
            stripeCardElement.style.display = 'block';
            paypalButtonContainer.style.display = 'none';
        } else if (selectedPaymentMethod === 'paypal') {
            stripeCardElement.style.display = 'none';
            paypalButtonContainer.style.display = 'none';
        } else {
            stripeCardElement.style.display = 'none';
            paypalButtonContainer.style.display = 'none';
        }
    });

    document.getElementById('payment-form').addEventListener('submit', function(event) {
        var paymentMethod = document.getElementById('payment_method').value;
        if (paymentMethod === 'stripe') {
            event.preventDefault();

            stripe.createPaymentMethod({
                type: 'card',
                card: card,
            }).then(function(result) {
                if (result.error) {
                    cardErrors.textContent = result.error.message;
                } else {
                    var paymentMethodInput = document.createElement('input');
                    paymentMethodInput.setAttribute('type', 'hidden');
                    paymentMethodInput.setAttribute('name', 'payment_method_id');
                    paymentMethodInput.setAttribute('value', result.paymentMethod.id);
                    document.getElementById('payment-form').appendChild(paymentMethodInput);
                    document.getElementById('payment-form').submit();
                }
            });
        }
        // No special handling needed for PayPal as redirection is handled in the backend
    });
});


</script>
@endsection
