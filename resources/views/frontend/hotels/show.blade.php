@extends('frontend.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <img src="{{ $hotel->image_url }}" class="card-img-top" alt="{{ $hotel->name }}">
        <div class="card-body">
            <h2 class="card-title">{{ $hotel->name }}</h2>
            <p class="card-text">{{ $hotel->description }}</p>
            <p class="card-text"><strong>Location:</strong> {{ $hotel->location }}</p>
        </div>
    </div>
</div>
@endsection
