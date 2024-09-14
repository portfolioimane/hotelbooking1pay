@extends('frontend.layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Featured Hotels -->
    <h2 class="mb-4">Featured Hotels</h2>
    <div class="row">
        @foreach($featuredHotels as $hotel)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ $hotel->image_url }}" class="card-img-top" alt="{{ $hotel->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $hotel->name }}</h5>
                    <p class="card-text">{{ Str::limit($hotel->description, 100) }}</p>
                    <a href="{{ route('frontend.hotels.show', $hotel->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Top Rooms -->
    <h2 class="mb-4">Top Rooms</h2>
    <div class="row">
        @foreach($rooms as $room)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ $room->image_url }}" class="card-img-top" alt="{{ $room->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $room->name }}</h5>
                    <p class="card-text">{{ Str::limit($room->description, 100) }}</p>
                    <a href="{{ route('frontend.rooms.show', $room->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
