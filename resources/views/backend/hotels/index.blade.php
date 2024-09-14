@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Hotels</h1>
        <a href="{{ route('admin.hotels.create') }}" class="btn btn-primary mb-3">Add New Hotel</a>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Hotels List</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hotels as $hotel)
                            <tr>
                                <td>{{ $hotel->id }}</td>
                                <td>{{ $hotel->name }}</td>
                                <td>{{ $hotel->location }}</td>
                                <td>
                                    <a href="{{ route('admin.hotels.edit', $hotel->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.hotels.destroy', $hotel->id) }}" method="POST" style="display: inline;">
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
