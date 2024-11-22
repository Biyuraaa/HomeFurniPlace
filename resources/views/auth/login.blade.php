@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-amber-100 to-amber-50">
        <div class="max-w-5xl w-full flex rounded-3xl shadow-2xl overflow-hidden bg-white">
            <!-- Left Side - Login Form -->
            <div class="w-full lg:w-1/2 p-8 space-y-8 bg-gradient-to-br from-amber-800 to-amber-900 slide-in">
                <div class="text-center space-y-6">
                    <div class="flex justify-center">
                        <div
                            class="w-24 h-24 bg-amber-50 rounded-full flex items-center justify-center hover-scale shadow-lg transition-all duration-300 ease-in-out">
                            <svg class="w-14 h-14 text-amber-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-5xl font-bold text-amber-50 tracking-tight">Welcome Home!</h2>
                    <p class="text-amber-200 text-lg">Create your perfect living space with our premium furniture</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div class="space-y-4">
                        <div class="relative group">
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                autofocus
                                class="w-full px-4 py-3 bg-white bg-opacity-10 rounded-lg text-white placeholder-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-400 transition-all duration-300 ease-in-out @error('email') border-red-500 @enderror"
                                placeholder="Email address">
                            <label for="email"
                                class="absolute left-4 top-3 text-amber-200 transition-all duration-300 ease-in-out opacity-0 group-focus-within:opacity-100 group-focus-within:-translate-y-6 group-focus-within:text-xs">
                                Email address
                            </label>
                            @error('email')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="relative group">
                            <input type="password" id="password" name="password" required
                                class="w-full px-4 py-3 bg-white bg-opacity-10 rounded-lg text-white placeholder-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-400 transition-all duration-300 ease-in-out @error('password') border-red-500 @enderror"
                                placeholder="Password">
                            <label for="password"
                                class="absolute left-4 top-3 text-amber-200 transition-all duration-300 ease-in-out opacity-0 group-focus-within:opacity-100 group-focus-within:-translate-y-6 group-focus-within:text-xs">
                                Password
                            </label>
                            @error('password')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-amber-200">
                        <label class="flex items-center space-x-2 cursor-pointer group">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                                class="rounded border-amber-300 text-amber-600 focus:ring-amber-500">
                            <span class="group-hover:text-white transition-colors duration-200">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="hover:text-white transition-colors duration-200">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                        class="w-full bg-amber-50 text-amber-800 py-3 rounded-lg font-semibold hover:bg-amber-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-300 ease-in-out transform hover:scale-105">
                        Sign In
                    </button>

                    <p class="text-center text-amber-200">
                        New to HomeFurniPlace?
                        <a href="{{ route('register') }}"
                            class="font-semibold text-white hover:underline transition-all duration-200">Create an
                            account</a>
                    </p>
                </form>
            </div>

            <!-- Right Side - Decorative -->
            <div class="hidden lg:block w-1/2 bg-amber-50 p-12">
                <div class="h-full flex flex-col justify-center items-center space-y-8">
                    <div class="w-full max-w-md">
                        <img src="https://images.unsplash.com/photo-1631679706909-1844bbd07221?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                            alt="Luxury Furniture Preview" class="rounded-2xl shadow-2xl object-cover w-full h-64">
                    </div>
                    <div class="text-center space-y-4">
                        <h3 class="text-3xl font-bold text-amber-900">HomeFurniPlace Collection</h3>
                        <p class="text-amber-700 text-lg">Discover our handcrafted wooden furniture pieces</p>
                    </div>
                    <div class="flex flex-wrap justify-center gap-4">
                        <span
                            class="px-4 py-2 bg-amber-100 text-amber-800 rounded-full text-sm font-medium">Handcrafted</span>
                        <span class="px-4 py-2 bg-amber-100 text-amber-800 rounded-full text-sm font-medium">Premium
                            Wood</span>
                        <span class="px-4 py-2 bg-amber-100 text-amber-800 rounded-full text-sm font-medium">Lifetime
                            Warranty</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                gsap.from('.slide-in', {
                    x: -100,
                    opacity: 0,
                    duration: 1,
                    ease: 'power3.out'
                });

                const badges = document.querySelectorAll('.bg-amber-100');
                badges.forEach((badge, index) => {
                    gsap.from(badge, {
                        opacity: 0,
                        y: 20,
                        duration: 0.5,
                        delay: 0.2 * (index + 1),
                        ease: 'power2.out'
                    });
                });
            });
        </script>
    @endpush

    @push('styles')
        <style>
            .bg-gradient {
                background: linear-gradient(135deg, #92400e 0%, #78350f 100%);
            }

            .hover-scale {
                transition: all 0.3s ease;
            }

            .hover-scale:hover {
                transform: scale(1.05);
            }
        </style>
    @endpush
@endsection
