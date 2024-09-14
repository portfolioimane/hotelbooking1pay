@extends('frontend.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <img src="{{ $room->image_url }}" class="card-img-top" alt="{{ $room->name }}">
        <div class="card-body">
            <h2 class="card-title">{{ $room->name }}</h2>
            <p class="card-text">{{ $room->description }}</p>
            <p class="card-text"><strong>Price:</strong> {{ $room->price }} MAD</p>
            <p class="card-text"><strong>Capacity:</strong> {{ $room->capacity }} guests</p>
            <form action="{{ route('frontend.rooms.checkAvailability', $room->id) }}" method="GET" id="availabilityForm">
                @csrf
                <div class="row">
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
                </div>
                <button type="submit" class="btn btn-primary mt-3">Check Availability</button>
            </form>
            <div id="availabilityResult" class="mt-3"></div>
        </div>
    </div>
</div>
<script>
document.getElementById('availabilityForm').addEventListener('submit', function (event) {
    event.preventDefault();
    
    let form = event.target;
    let formData = new FormData(form);
    let params = new URLSearchParams(formData).toString();
    
    fetch(`${form.action}?${params}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        let resultDiv = document.getElementById('availabilityResult');
        if (data.available) {
            // Redirect to booking page if available
            window.location.href = `{{ route('frontend.bookings.create', $room->id) }}`;
        } else {
            resultDiv.innerHTML = '<div class="alert alert-danger">Room is not available.</div>';
        }
    });
});
</script>

@endsection
