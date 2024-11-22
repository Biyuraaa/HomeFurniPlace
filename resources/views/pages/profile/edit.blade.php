@extends('layouts.app')
@section('content')
    <div class="min-h-screen bg-gradient-to-b from-[#F5E6D3] to-[#E2D4C3] py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Card Container with wood-inspired styling -->
            <div
                class="transform transition-all duration-300 hover:scale-[1.01] bg-[#F4A460] bg-opacity-20 rounded-3xl shadow-2xl overflow-hidden border border-[#A0522D]">
                <!-- Header Section with warm tones -->
                <div class="relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#D2691E] to-[#8B4513] opacity-10"></div>
                    <div class="relative px-8 py-10">
                        <h2 class="text-3xl font-bold text-[#5D3A1A] tracking-tight">Edit Profile</h2>
                        <p class="mt-2 text-sm text-[#6B4423]">Customize your profile information and personal details.</p>
                    </div>
                </div>

                <form action="{{ route('profile-user.update', Auth::user()->id) }}" method="POST"
                    enctype="multipart/form-data" class="px-8 py-6">
                    @csrf
                    @method('PATCH')

                    <!-- Profile Picture Section with wood-inspired styling -->
                    <div
                        class="flex flex-col sm:flex-row items-center gap-8 p-6 bg-[#DEB887] bg-opacity-20 rounded-2xl mb-8">
                        <div class="relative group">
                            <div class="h-32 w-32 rounded-full overflow-hidden ring-4 ring-[#8B4513] shadow-lg">
                                <img id="preview-image"
                                    class="h-full w-full object-cover transition duration-300 group-hover:scale-110"
                                    src="{{ Auth::user()->image ? asset('storage/images/users/' . Auth::user()->image) : asset('assets/img/default-avatar.png') }}"
                                    alt="Profile photo">
                            </div>
                            <div
                                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <div
                                    class="bg-[#5D3A1A] bg-opacity-70 rounded-full h-32 w-32 flex items-center justify-center">
                                    <span class="text-[#F4A460] text-sm font-medium">Change Photo</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <label class="block text-sm font-medium text-[#5D3A1A] mb-2">Profile Picture</label>
                            <input type="file" name="image" id="image" accept="image/*"
                                class="block w-full text-sm text-[#6B4423] 
                  file:mr-4 file:py-2.5 file:px-4 
                  file:rounded-full file:border-0 
                  file:text-sm file:font-semibold
                  file:bg-[#D2691E] file:bg-opacity-20 file:text-[#8B4513] 
                  hover:file:bg-[#D2691E] hover:file:bg-opacity-40
                  transition duration-300 ease-in-out">
                            <p class="mt-2 text-xs text-[#6B4423]">Recommended: Square image, at least 400x400px</p>
                        </div>
                    </div>

                    <!-- Form Grid with warm color scheme -->
                    <div class="grid grid-cols-1 gap-y-8 gap-x-6 sm:grid-cols-2 mb-8">
                        <!-- Name Field -->
                        <div class="relative group">
                            <label for="name" class="block text-sm font-medium text-[#5D3A1A] mb-2">Full Name</label>
                            <input type="text" name="name" id="name"
                                value="{{ old('name', Auth::user()->name) }}"
                                class="block w-full px-4 py-3 rounded-xl border-[#A0522D] 
                                          focus:border-[#8B4513] focus:ring focus:ring-[#D2691E] 
                                          focus:ring-opacity-50 transition duration-300
                                          group-hover:border-[#D2691E] 
                                          bg-white text-[#5D3A1A]"
                                required>
                        </div>

                        <!-- Email Field -->
                        <div class="relative group">
                            <label for="email" class="block text-sm font-medium text-[#5D3A1A] mb-2">Email
                                Address</label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', Auth::user()->email) }}"
                                class="block w-full px-4 py-3 rounded-xl border-[#A0522D] 
                                          focus:border-[#8B4513] focus:ring focus:ring-[#D2691E] 
                                          focus:ring-opacity-50 transition duration-300
                                          group-hover:border-[#D2691E] 
                                          bg-gray-100 text-[#6B4423]"
                                disabled>
                        </div>

                        <!-- Phone Field -->
                        <div class="relative group">
                            <label for="phone" class="block text-sm font-medium text-[#5D3A1A] mb-2">Phone Number</label>
                            <input type="tel" name="phone" id="phone"
                                value="{{ old('phone', Auth::user()->phone) }}"
                                class="block w-full px-4 py-3 rounded-xl border-[#A0522D] 
                                          focus:border-[#8B4513] focus:ring focus:ring-[#D2691E] 
                                          focus:ring-opacity-50 transition duration-300
                                          group-hover:border-[#D2691E] 
                                          bg-white text-[#5D3A1A]">
                        </div>

                        <!-- Date of Birth Field -->
                        <div class="relative group">
                            <label for="date_of_birth" class="block text-sm font-medium text-[#5D3A1A] mb-2">Date of
                                Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth"
                                value="{{ old('date_of_birth', Auth::user()->date_of_birth) }}"
                                class="block w-full px-4 py-3 rounded-xl border-[#A0522D] 
                                          focus:border-[#8B4513] focus:ring focus:ring-[#D2691E] 
                                          focus:ring-opacity-50 transition duration-300
                                          group-hover:border-[#D2691E] 
                                          bg-white text-[#5D3A1A]">
                        </div>

                        <!-- Address Field -->
                        <div class="sm:col-span-2 relative group">
                            <label for="address" class="block text-sm font-medium text-[#5D3A1A] mb-2">Complete
                                Address</label>
                            <textarea name="address" id="address" rows="4"
                                class="block w-full px-4 py-3 rounded-xl border-[#A0522D] 
                                             focus:border-[#8B4513] focus:ring focus:ring-[#D2691E] 
                                             focus:ring-opacity-50 transition duration-300
                                             group-hover:border-[#D2691E] 
                                             bg-white text-[#5D3A1A]">{{ old('address', Auth::user()->address) }}</textarea>
                        </div>
                    </div>

                    <!-- Action Buttons with wood-inspired colors -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-[#A0522D]">
                        <a href="{{ route('profile-user.index') }}"
                            class="inline-flex items-center px-6 py-3 rounded-xl border border-[#8B4513] 
                                  text-sm font-medium text-[#5D3A1A] bg-[#DEB887] shadow-sm 
                                  hover:bg-[#D2691E] hover:text-white
                                  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8B4513]
                                  transition duration-300">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 rounded-xl border border-transparent 
                                       text-sm font-medium text-white bg-[#8B4513] shadow-sm
                                       hover:bg-[#5D3A1A] focus:outline-none focus:ring-2 
                                       focus:ring-offset-2 focus:ring-[#D2691E]
                                       transition duration-300">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('image');
            const preview = document.getElementById('preview-image');

            input.addEventListener('change', function() {
                const file = this.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.add('animate-pulse');
                        setTimeout(() => {
                            preview.classList.remove('animate-pulse');
                        }, 1000);
                    }

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
