@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Rooms</h1>
        <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary mb-3">Add New Room</a>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Rooms List</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Hotel</th>
                            <th>Number</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $room)
                            <tr>
                                <td>{{ $room->id }}</td>
                                <td>{{ $room->hotel->name }}</td>
                                <td>{{ $room->number }}</td>
                                <td>{{ $room->type }}</td>
                                <td>{{ $room->price }}</td>
                                <td>
                                    <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" style="display: inline;">
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
