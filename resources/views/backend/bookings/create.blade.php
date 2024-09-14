@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Add New Booking</h1>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Booking Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.bookings.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="room_id">Room</label>
                        <select name="room_id" id="room_id" class="form-control" required>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Customer Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Customer Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Customer Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="check_in">Check-in Date</label>
                        <input type="date" name="check_in" id="check_in" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="check_out">Check-out Date</label>
                        <input type="date" name="check_out" id="check_out" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="payment_method">Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-control" required>
                            <option value="stripe">Stripe</option>
                            <option value="paypal">PayPal</option>
                            <option value="cash">Cash</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Booking</button>
                </form>
            </div>
        </div>
    </div>
@endsection
