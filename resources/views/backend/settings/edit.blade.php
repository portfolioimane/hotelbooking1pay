@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Edit Settings</h1>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Settings Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="site_name">Site Name</label>
                        <input type="text" name="site_name" id="site_name" class="form-control" value="{{ $settings->site_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="contact_email">Contact Email</label>
                        <input type="email" name="contact_email" id="contact_email" class="form-control" value="{{ $settings->contact_email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control" required>{{ $settings->address }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $settings->phone_number }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Settings</button>
                </form>
            </div>
        </div>
    </div>
@endsection
