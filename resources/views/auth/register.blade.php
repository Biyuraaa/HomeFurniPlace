@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-amber-100 to-amber-50"
        x-data="{
            fullName: '',
            email: '',
            password: '',
            confirmPassword: '',
            termsAccepted: false,
            step: 1
        }">
        <div class="max-w-5xl w-full flex rounded-3xl shadow-2xl overflow-hidden bg-white">
            <!-- Left Side - Register Form -->
            <div class="w-full lg:w-1/2 p-8 space-y-8 bg-gradient-to-br from-amber-800 to-amber-900 slide-in">
                <div class="text-center space-y-6">
                    <div class="flex justify-center">
                        <div
                            class="w-24 h-24 bg-amber-50 rounded-full flex items-center justify-center hover-scale shadow-lg transition-all duration-300 ease-in-out">
                            <svg class="w-14 h-14 text-amber-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-5xl font-bold text-amber-50 tracking-tight">Design Your Journey</h2>
                    <p class="text-amber-200 text-lg">Join our exclusive collection of premium furniture enthusiasts</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6" x-data="{ isLoading: false }">
                    @csrf
                    <!-- Step 1: Basic Info -->
                    <div x-show="step === 1" class="space-y-4">
                        <div class="relative group">
                            <input type="text" name="name" x-model="fullName"
                                class="w-full px-4 py-3 bg-white bg-opacity-10 rounded-lg text-white placeholder-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-400 transition-all duration-300 ease-in-out @error('name') border-red-500 @enderror"
                                placeholder="Full Name" required>
                            <label
                                class="absolute left-4 top-3 text-amber-200 transition-all duration-300 ease-in-out opacity-0 group-focus-within:opacity-100 group-focus-within:-translate-y-6 group-focus-within:text-xs">
                                Full Name
                            </label>
                            @error('name')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="relative group">
                            <input type="email" name="email" x-model="email"
                                class="w-full px-4 py-3 bg-white bg-opacity-10 rounded-lg text-white placeholder-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-400 transition-all duration-300 ease-in-out @error('email') border-red-500 @enderror"
                                placeholder="Email address" required>
                            <label
                                class="absolute left-4 top-3 text-amber-200 transition-all duration-300 ease-in-out opacity-0 group-focus-within:opacity-100 group-focus-within:-translate-y-6 group-focus-within:text-xs">
                                Email address
                            </label>
                            @error('email')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="button" @click="step = 2"
                            class="w-full bg-amber-50 text-amber-800 py-3 rounded-lg font-semibold hover:bg-amber-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-300 ease-in-out transform hover:scale-105"
                            x-bind:disabled="!fullName || !email">
                            Continue to Security Setup
                        </button>
                    </div>

                    <!-- Step 2: Security -->
                    <div x-show="step === 2" class="space-y-4">
                        <div class="relative group">
                            <input type="password" name="password" x-model="password"
                                class="w-full px-4 py-3 bg-white bg-opacity-10 rounded-lg text-white placeholder-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-400 transition-all duration-300 ease-in-out @error('password') border-red-500 @enderror"
                                placeholder="Password" required>
                            <label
                                class="absolute left-4 top-3 text-amber-200 transition-all duration-300 ease-in-out opacity-0 group-focus-within:opacity-100 group-focus-within:-translate-y-6 group-focus-within:text-xs">
                                Password
                            </label>
                            @error('password')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="relative group">
                            <input type="password" name="password_confirmation" x-model="confirmPassword"
                                class="w-full px-4 py-3 bg-white bg-opacity-10 rounded-lg text-white placeholder-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-400 transition-all duration-300 ease-in-out"
                                placeholder="Confirm Password" required>
                            <label
                                class="absolute left-4 top-3 text-amber-200 transition-all duration-300 ease-in-out opacity-0 group-focus-within:opacity-100 group-focus-within:-translate-y-6 group-focus-within:text-xs">
                                Confirm Password
                            </label>
                        </div>

                        <div class="flex items-center space-x-2 text-amber-200">
                            <input type="checkbox" x-model="termsAccepted"
                                class="rounded border-amber-300 text-amber-600 focus:ring-amber-500">
                            <label class="text-sm">
                                I agree to the <a href="" class="underline hover:text-white">Terms and
                                    Conditions</a>
                            </label>
                        </div>

                        <div class="flex space-x-4">
                            <button type="button" @click="step = 1"
                                class="w-1/2 bg-transparent border border-amber-200 text-white py-3 rounded-lg font-semibold hover:bg-white hover:bg-opacity-10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-300 ease-in-out">
                                Back to Details
                            </button>
                            <button type="submit"
                                class="w-1/2 bg-amber-50 text-amber-800 py-3 rounded-lg font-semibold hover:bg-amber-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-300 ease-in-out transform hover:scale-105"
                                x-bind:class="{
                                    'opacity-75 cursor-not-allowed': !password || !confirmPassword || !termsAccepted ||
                                        password !== confirmPassword
                                }"
                                x-bind:disabled="!password || !confirmPassword || !termsAccepted || password !== confirmPassword"
                                @click="isLoading = true">
                                <span x-show="!isLoading">Create Your Account</span>
                                <span x-show="isLoading" class="flex items-center justify-center">
                                    <svg class="animate-spin h-5 w-5 mr-3" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4" fill="none"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                    </svg>
                                    Setting up your space...
                                </span>
                            </button>
                        </div>
                    </div>

                    <p class="text-center text-amber-200">
                        Already part of our collection?
                        <a href="{{ route('login') }}"
                            class="font-semibold text-white hover:underline transition-all duration-200">
                            Sign in to your account
                        </a>
                    </p>
                </form>
            </div>

            <!-- Right Side - Decorative -->
            <div class="hidden lg:block w-1/2 bg-amber-50 p-12">
                <div class="h-full flex flex-col justify-center items-center space-y-8">
                    <div class="w-full max-w-md float-animation">
                        <img src="https://images.unsplash.com/photo-1631679706909-1844bbd07221?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                            alt="Premium Wooden Furniture" class="rounded-2xl shadow-2xl object-cover w-full h-64">
                    </div>
                    <div class="text-center space-y-4">
                        <h3 class="text-3xl font-bold text-amber-900">Craft Your Space</h3>
                        <p class="text-amber-700 text-lg">Join our community of furniture enthusiasts and interior design
                            lovers</p>
                    </div>
                    <div class="flex flex-wrap justify-center gap-4">
                        <span class="px-4 py-2 bg-amber-100 text-amber-800 rounded-full text-sm font-medium">
                            Member-Only Collection
                        </span>
                        <span class="px-4 py-2 bg-amber-100 text-amber-800 rounded-full text-sm font-medium">
                            Design Consultation
                        </span>
                        <span class="px-4 py-2 bg-amber-100 text-amber-800 rounded-full text-sm font-medium">
                            Custom Orders
                        </span>
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
                gsap.to('.slide-in', {
                    x: 0,
                    opacity: 1,
                    duration: 1,
                    ease: 'power3.out'
                });

                gsap.from('.float-animation', {
                    y: 30,
                    opacity: 0,
                    duration: 1.5,
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
            @keyframes float {

                0%,
                100% {
                    transform: translateY(0px);
                }

                50% {
                    transform: translateY(-20px);
                }
            }

            .bg-gradient {
                background: linear-gradient(135deg, #92400e 0%, #78350f 100%);
            }

            .hover-scale {
                transition: all 0.3s ease;
            }

            .hover-scale:hover {
                transform: scale(1.05);
            }

            .slide-in {
                opacity: 0;
                transform: translateX(-100px);
            }
        </style>
    @endpush
@endsection
