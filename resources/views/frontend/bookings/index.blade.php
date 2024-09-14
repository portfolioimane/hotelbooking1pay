@extends('frontend.layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Bookings Table -->
    <h2 class="mb-4">Your Bookings</h2>
    @if($bookings->isEmpty())
    <div class="alert alert-info">You have no bookings yet.</div>
    @else
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Room</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Payment Method</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->room->name }}</td>
                <td>{{ $booking->check_in }}</td>
                <td>{{ $booking->check_out }}</td>
                <td>{{ ucfirst($booking->payment_method) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Password Change Section -->
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title">Change Password</h4>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('frontend.updatePassword') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Update Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
