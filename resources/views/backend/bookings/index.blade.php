@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Bookings</h1>
        <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary mb-3">Add New Booking</a>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Bookings List</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Room</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Check-in Date</th>
                            <th>Check-out Date</th>
                            <th>Payment Method</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->room->number }}</td>
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->email }}</td>
                                <td>{{ $booking->phone }}</td>
                                <td>{{ $booking->check_in }}</td>
                                <td>{{ $booking->check_out }}</td>
                                <td>{{ ucfirst($booking->payment_method) }}</td>
                                <td>
                                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
