@extends('pages.components.layout')
@section('content')
    <div class="edit-profile-container">
        <h2>Edit Profile</h2>
        <form action="{{ route('profile-user.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data"
            class="edit-profile-form" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}"
                    class="form-control" required>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}"
                    class="form-control" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address', Auth::user()->address) }}"
                    class="form-control">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', Auth::user()->phone) }}"
                    class="form-control">
            </div>

            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth"
                    value="{{ old('date_of_birth', Auth::user()->date_of_birth) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="image">Profile Picture</label>
                <input type="file" name="image" id="image" class="form-control-file">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('profile-user.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
