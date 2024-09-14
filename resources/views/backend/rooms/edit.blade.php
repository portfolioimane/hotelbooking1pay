@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Edit Room</h1>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Room Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="hotel_id">Hotel</label>
                        <select name="hotel_id" id="hotel_id" class="form-control" required>
                            @foreach($hotels as $hotel)
                                <option value="{{ $hotel->id }}" {{ $room->hotel_id == $hotel->id ? 'selected' : '' }}>
                                    {{ $hotel->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="number">Room Number</label>
                        <input type="text" name="number" id="number" class="form-control" value="{{ $room->number }}" required>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" name="type" id="type" class="form-control" value="{{ $room->type }}" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ $room->price }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Room</button>
                </form>
            </div>
        </div>
    </div>
@endsection
