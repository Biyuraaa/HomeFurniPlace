<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='user-profile'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Profile"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-6">
                    <a href="{{ route('profile.index') }}" class="btn btn-primary btn-sm">Back</a>
                    <div class="card shadow-lg">
                        <div class="card-body text-center py-5">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('profile.update') }}" id="profileForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH') <!-- Use PATCH here for partial updates -->
                                <div class="mb-4 text-center">
                                    <img src="https://via.placeholder.com/150" alt="Profile Picture" class="profile-pic" id="profilePic" style="max-width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
                                    <input type="file" class="form-control mt-3" name="image" id="profilePicInput" accept="image/*">
                                </div>
                                <div class="input-group input-group-outline mb-4">
                                    <label for="email" class="form-label"></label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}" disabled>
                                </div>
                                <div class="input-group input-group-static mb-4">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ Auth::user()->name }}" required>
                                </div>
                                <div class="input-group input-group-static mb-4">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" value="{{ Auth::user()->address }}" placeholder="Enter your address" required>
                                </div>
                                <div class="input-group input-group-static mb-4">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class="form-control" name="phone" id="phone" value="{{ Auth::user()->phone }}" placeholder="Enter your phone number" required>
                                </div>
                                <div class="input-group input-group-static mb-4">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ Auth::user()->date_of_birth }}" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>

<script>
    // Preview the selected image
    document.getElementById('profilePicInput').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const profilePic = document.getElementById('profilePic');
            profilePic.src = reader.result; // Set the image source to the FileReader result
        }
        reader.readAsDataURL(event.target.files[0]); // Read the uploaded file as a data URL
    });
</script>
