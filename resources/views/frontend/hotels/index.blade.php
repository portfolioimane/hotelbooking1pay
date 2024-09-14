@extends('frontend.layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Hotels</h2>
    <div class="row">
        @foreach($hotels as $hotel)
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
</div>
@endsection
