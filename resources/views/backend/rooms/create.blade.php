@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Add New Room</h1>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Room Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.rooms.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="hotel_id">Hotel</label>
                        <select name="hotel_id" id="hotel_id" class="form-control" required>
                            @foreach($hotels as $hotel)
                                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="number">Room Number</label>
                        <input type="text" name="number" id="number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" name="type" id="type" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Room</button>
                </form>
            </div>
        </div>
    </div>
@endsection
