@extends('frontend.layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Rooms</h2>
    <div class="row">
        @foreach($rooms as $room)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ $room->image_url }}" class="card-img-top" alt="{{ $room->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $room->name }}</h5>
                    <p class="card-text">{{ Str::limit($room->description, 100) }}</p>
                    <p class="card-text"><strong>Price:</strong> {{ $room->price }} MAD</p>
                    <a href="{{ route('frontend.rooms.show', $room->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
