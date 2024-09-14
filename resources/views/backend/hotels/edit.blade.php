@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Edit Hotel</h1>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Hotel Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $hotel->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" id="location" class="form-control" value="{{ $hotel->location }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control">{{ $hotel->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image_url">Image URL</label>
                        <input type="text" name="image_url" id="image_url" class="form-control" value="{{ $hotel->image_url }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Hotel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
