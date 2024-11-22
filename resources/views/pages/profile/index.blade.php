@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-[#F5E6D3] to-[#E2D4C3] py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Profile Header -->
            <div class="bg-[#8B4513] bg-opacity-10 rounded-2xl shadow-lg border border-[#6B4423] overflow-hidden mb-6">
                <div class="relative h-48 bg-gradient-to-r from-[#A0522D] to-[#6B4423]">
                    <div class="absolute -bottom-12 left-8">
                        @if (Auth::user()->image)
                            <img src="{{ asset('storage/images/users/' . Auth::user()->image) }}" alt="Profile Image"
                                class="w-32 h-32 rounded-xl border-4 border-[#D2691E] shadow-md object-cover">
                        @else
                            <div
                                class="w-32 h-32 rounded-xl border-4 border-[#D2691E] shadow-md bg-gradient-to-br from-[#DEB887] to-[#D2691E] flex items-center justify-center">
                                <svg class="w-16 h-16 text-[#8B4513]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="absolute bottom-4 right-6">
                        <div class="flex space-x-3">
                            <a href="{{ route('profile-user.edit') }}"
                                class="inline-flex items-center px-4 py-2 rounded-lg bg-[#DEB887] text-[#8B4513] border border-[#A0522D] shadow-sm hover:bg-[#CD853F] transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>

                <div class="pt-16 px-8 pb-8">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-2xl font-bold text-[#5D3A1A]">{{ Auth::user()->name }}</h1>
                        </div>
                        <div class="bg-[#D2691E] bg-opacity-10 rounded-lg px-4 py-3 text-center">
                            <p class="text-sm text-[#8B4513] font-medium">Wallet Balance</p>
                            <p class="text-2xl font-bold text-[#5D3A1A]">
                                ${{ number_format(Auth::user()->wallet->balance ?? 0, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Personal Information -->
                <div class="bg-[#F4A460] bg-opacity-10 rounded-xl shadow-lg border border-[#A0522D] p-6">
                    <h2 class="text-lg font-semibold text-[#5D3A1A] mb-4">Personal Information</h2>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-[#8B4513] mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-sm text-[#6B4423]">Email</p>
                                <p class="font-medium text-[#5D3A1A]">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-[#8B4513] mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <div>
                                <p class="text-sm text-[#6B4423]">Address</p>
                                <p class="font-medium text-[#5D3A1A]">{{ Auth::user()->address ?? 'Not set' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-[#8B4513] mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <div>
                                <p class="text-sm text-[#6B4423]">Phone</p>
                                <p class="font-medium text-[#5D3A1A]">{{ Auth::user()->phone ?? 'Not set' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-[#8B4513] mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-sm text-[#6B4423]">Date of Birth</p>
                                <p class="font-medium text-[#5D3A1A]">{{ Auth::user()->date_of_birth ?? 'Not set' }}</p>
                            </div>
                        </div>
                        <!-- Other personal info sections remain similar, with brown color palette -->
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-[#F4A460] bg-opacity-10 rounded-xl shadow-lg border border-[#A0522D] p-6">
                    <h2 class="text-lg font-semibold text-[#5D3A1A] mb-4">Quick Actions</h2>
                    <div class="space-y-4">
                        @if (Auth::user()->wallet)
                            <a href="{{ route('wallets-users.index') }}"
                                class="flex items-center p-4 rounded-lg border border-[#A0522D] hover:border-[#8B4513] hover:bg-[#DEB887] transition-colors group">
                                <div
                                    class="flex-shrink-0 w-12 h-12 rounded-lg bg-[#D2691E] bg-opacity-20 flex items-center justify-center group-hover:bg-[#D2691E] transition-colors">
                                    <svg class="w-6 h-6 text-[#8B4513]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="text-base font-medium text-[#5D3A1A] group-hover:text-[#8B4513]">Manage
                                        Wallet</h3>
                                    <p class="text-sm text-[#6B4423]">View transactions and manage your balance</p>
                                </div>
                            </a>
                        @else
                            <a href="{{ route('wallets-users.create') }}"
                                class="flex items-center p-4 rounded-lg border border-[#A0522D] hover:border-[#8B4513] hover:bg-[#DEB887] transition-colors group">
                                <!-- Similar styling with brown color palette -->
                            </a>
                        @endif

                        <a href="{{ route('sales.purchased') }}"
                            class="flex items-center p-4 rounded-lg border border-[#A0522D] hover:border-[#8B4513] hover:bg-[#DEB887] transition-colors group">
                            <div
                                class="flex-shrink-0 w-12 h-12 rounded-lg bg-[#D2691E] bg-opacity-20 flex items-center justify-center group-hover:bg-[#D2691E] transition-colors">
                                <svg class="w-6 h-6 text-[#8B4513]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-base font-medium text-[#5D3A1A] group-hover:text-[#8B4513]">Purchase
                                    History
                                </h3>
                                <p class="text-sm text-[#6B4423]">View your past orders and transactions</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
