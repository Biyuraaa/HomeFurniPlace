@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-[#F5E6D3] to-[#E2D4C3] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Animated Header -->
            <div class="text-center mb-16 transform transition-all duration-500 opacity-0 translate-y-4 animate-fade-in-up">
                <h2 class="text-4xl font-bold text-[#8B4513] tracking-tight sm:text-5xl font-serif">
                    Furniture Purchases
                </h2>
                <p class="mt-4 text-lg text-[#A0522D] max-w-2xl mx-auto">
                    Track your exquisite furniture selections and order journey
                </p>
            </div>

            @if ($sales->isEmpty())
                <!-- Enhanced Empty State -->
                <div
                    class="max-w-md mx-auto text-center py-16 px-4 sm:py-20 transform hover:scale-105 transition-transform duration-300">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center justify-center animate-pulse">
                            <div class="h-32 w-32 rounded-full bg-[#D2B48C]"></div>
                        </div>
                        <svg class="relative mx-auto h-32 w-32 text-[#8B4513]" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-xl font-semibold text-[#6B4423]">No furniture purchases yet</h3>
                    <p class="mt-3 text-base text-[#8B4513] max-w-sm mx-auto">
                        Ready to transform your space? Explore our curated furniture collection.
                    </p>
                    <div class="mt-8">
                        <a href="{{ route('products') }}"
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full
                                   text-white bg-[#8B4513] hover:bg-[#6B4423] transition-colors duration-300
                                   focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#A0522D]">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Browse Furniture
                        </a>
                    </div>
                </div>
            @else
                <!-- Filter Tabs -->
                <div class="flex justify-center mb-8 space-x-4">
                    <button
                        class="px-4 py-2 text-sm font-medium text-[#8B4513] bg-[#F5DEB3] rounded-full hover:bg-[#DEB887] focus:outline-none focus:ring-2 focus:ring-[#A0522D] focus:ring-offset-2 transition-all duration-300">
                        All Orders
                    </button>
                    <button
                        class="px-4 py-2 text-sm font-medium text-[#6B4423] hover:text-[#8B4513] hover:bg-[#F5DEB3] rounded-full focus:outline-none focus:ring-2 focus:ring-[#A0522D] focus:ring-offset-2 transition-all duration-300">
                        Processing
                    </button>
                    <button
                        class="px-4 py-2 text-sm font-medium text-[#6B4423] hover:text-[#8B4513] hover:bg-[#F5DEB3] rounded-full focus:outline-none focus:ring-2 focus:ring-[#A0522D] focus:ring-offset-2 transition-all duration-300">
                        Shipped
                    </button>
                    <button
                        class="px-4 py-2 text-sm font-medium text-[#6B4423] hover:text-[#8B4513] hover:bg-[#F5DEB3] rounded-full focus:outline-none focus:ring-2 focus:ring-[#A0522D] focus:ring-offset-2 transition-all duration-300">
                        Delivered
                    </button>
                </div>

                <!-- Enhanced Purchases Grid -->
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($sales as $sale)
                        <div
                            class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-[#D2B48C]">
                            <div class="relative overflow-hidden">
                                <img src="{{ $sale->product->image ? asset('storage/images/products/' . $sale->product->image) : 'https://via.placeholder.com/300' }}"
                                    alt="{{ $sale->product->name }}"
                                    class="w-full h-56 object-cover rounded-t-2xl transform group-hover:scale-105 transition-transform duration-500">

                                <!-- Status Badge -->
                                <div class="absolute top-4 right-4">
                                    <span
                                        class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-medium tracking-wide
                                        {{ $sale->status == 'purchased'
                                            ? 'bg-[#E6F3E6] text-[#2E8B57]'
                                            : ($sale->status == 'shipped'
                                                ? 'bg-[#FFF8DC] text-[#DAA520]'
                                                : ($sale->status == 'delivered'
                                                    ? 'bg-[#F0F8FF] text-[#4682B4]'
                                                    : 'bg-[#FFF0F5] text-[#B22222]')) }}">
                                        <span
                                            class="w-2 h-2 mr-2 rounded-full
                                            {{ $sale->status == 'purchased'
                                                ? 'bg-green-400'
                                                : ($sale->status == 'shipped'
                                                    ? 'bg-yellow-400'
                                                    : ($sale->status == 'delivered'
                                                        ? 'bg-blue-400'
                                                        : 'bg-red-400')) }}">
                                        </span>
                                        {{ ucfirst($sale->status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3
                                    class="text-xl font-bold text-[#6B4423] group-hover:text-[#8B4513] transition-colors duration-300 font-serif">
                                    {{ $sale->product->name }}
                                </h3>

                                <div class="mt-6 space-y-4">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-[#A0522D]">Price</span>
                                        <span class="font-semibold text-[#6B4423]">Rp.
                                            {{ number_format($sale->product->price, 2, ',', '.') }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-[#A0522D]">Quantity</span>
                                        <span class="font-semibold text-[#6B4423]">{{ $sale->quantity }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-[#A0522D]">Order Date</span>
                                        <span
                                            class="font-semibold text-[#6B4423]">{{ $sale->created_at->format('d M Y') }}</span>
                                    </div>

                                    <!-- Progress Bar for Shipped Status -->
                                    @if ($sale->status == 'shipped')
                                        <div class="mt-4">
                                            <div class="w-full bg-[#D2B48C] rounded-full h-2">
                                                <div
                                                    class="bg-[#8B4513] h-2 rounded-full w-2/3 transition-all duration-500">
                                                </div>
                                            </div>
                                            <div class="flex justify-between mt-2 text-xs text-[#A0522D]">
                                                <span>Ordered</span>
                                                <span>Shipped</span>
                                                <span>Delivered</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-8 flex justify-between items-center space-x-4">
                                    <a href="{{ route('sales.view', $sale->id) }}"
                                        class="flex-1 inline-flex items-center justify-center px-4 py-2.5 border border-transparent
                                               text-sm font-medium rounded-xl text-white bg-[#8B4513] 
                                               hover:bg-[#6B4423] focus:outline-none focus:ring-2 
                                               focus:ring-offset-2 focus:ring-[#A0522D] transition-colors duration-300">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View Details
                                    </a>

                                    @if ($sale->status == 'purchased')
                                        <form action="{{ route('sales.cancel', $sale) }}" method="POST" class="flex-1">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent
                                                       text-sm font-medium rounded-xl text-[#B22222] bg-[#FFF0F5]
                                                       hover:bg-[#FFE4E1] focus:outline-none focus:ring-2
                                                       focus:ring-offset-2 focus:ring-[#B22222] transition-colors duration-300">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Cancel Order
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <style>
        @keyframes fade-in-up {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
        }
    </style>
@endsection
