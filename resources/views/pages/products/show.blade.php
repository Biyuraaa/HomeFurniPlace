@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Product Main Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Product Image Section -->
            <div class="relative">
                <div class="sticky top-8">
                    <div class="group relative overflow-hidden rounded-xl bg-amber-50">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-brown-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        @if ($product->image)
                            <img src="{{ asset('storage/images/products/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-[600px] object-cover transform group-hover:scale-105 transition-transform duration-700"
                                id="product-image">
                        @else
                            <img src="{{ asset('assets/img/cushion.avif') }}" alt="Default Product Image"
                                class="w-full h-[600px] object-cover transform group-hover:scale-105 transition-transform duration-700"
                                id="product-image">
                        @endif
                        <!-- Image Navigation Dots -->
                        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-3">
                            <button
                                class="w-3 h-3 rounded-full bg-amber-800 opacity-75 hover:opacity-100 transition-opacity"></button>
                            <button
                                class="w-3 h-3 rounded-full bg-amber-800/50 hover:opacity-100 transition-opacity"></button>
                            <button
                                class="w-3 h-3 rounded-full bg-amber-800/50 hover:opacity-100 transition-opacity"></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="space-y-8">
                <!-- Product Title & Price -->
                <div>
                    <div class="flex items-start justify-between">
                        <h1 class="text-4xl font-serif font-bold text-brown-900">{{ $product->name }}</h1>
                        <button class="p-2 rounded-full hover:bg-amber-50 transition-colors" id="heart-icon">
                            <svg class="w-6 h-6 text-amber-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-4 flex items-center gap-4">
                        <span class="text-3xl font-bold text-amber-800">${{ number_format($product->price, 2) }}</span>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-amber-100 text-amber-800">
                            In Stock
                        </span>
                    </div>
                </div>

                <!-- Product Description -->
                <div>
                    <h2 class="text-lg font-serif font-semibold text-brown-900 mb-3">Product Description</h2>
                    <p class="text-brown-600 leading-relaxed">{{ $product->description }}</p>
                </div>

                <!-- Stock Counter -->
                <div class="bg-amber-50 rounded-xl p-6 space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-brown-600">Available Stock:</span>
                        <span class="font-semibold text-amber-800">{{ $product->stock }} items left</span>
                    </div>
                    <div class="h-px bg-amber-200"></div>
                    <div class="flex justify-between items-center">
                        <span class="text-brown-600">Quantity:</span>
                        <div class="flex items-center bg-white rounded-lg border border-amber-200">
                            <button class="p-2 hover:bg-amber-50 transition-colors" id="stock-minus">
                                <svg class="w-5 h-5 text-brown-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </button>
                            <input type="text"
                                class="w-16 text-center border-x border-amber-200 py-2 focus:outline-none focus:ring-1 focus:ring-amber-500"
                                id="stock-value" value="1">
                            <button class="p-2 hover:bg-amber-50 transition-colors" id="stock-plus">
                                <svg class="w-5 h-5 text-brown-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4">
                    <form action="{{ route('carts.store', $product->id) }}" method="POST" class="block">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" id="quantity" value="{{ old('quantity') ?? 1 }}">

                        <button type="submit"
                            class="w-full bg-amber-800 text-white py-4 px-6 rounded-xl font-semibold flex items-center justify-center gap-2 hover:bg-amber-900 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Add to Cart
                        </button>
                    </form>

                    <button
                        class="w-full border-2 border-amber-200 text-brown-900 py-4 px-6 rounded-xl font-semibold flex items-center justify-center gap-2 hover:border-amber-300 hover:bg-amber-50 transition-all"
                        id="chat-to-seller-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Chat with Seller
                    </button>
                </div>
            </div>
        </div>

        <!-- Matching Products Section -->
        <section class="mt-24">
            <div class="text-center mb-12">
                <span class="text-amber-800 text-sm font-bold tracking-wider uppercase">Perfect Combinations</span>
                <h2 class="mt-2 text-3xl font-serif font-bold text-brown-900">Complete Your Space</h2>
                <div class="mt-4 h-1 w-24 bg-amber-800 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($matches as $matchProduct)
                    <a href="{{ route('product', $matchProduct->id) }}" class="group">
                        <div
                            class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="aspect-w-1 aspect-h-1 bg-amber-50">
                                @if ($matchProduct->image)
                                    <img src="{{ asset('storage/images/products/' . $matchProduct->image) }}"
                                        alt="{{ $matchProduct->name }}"
                                        class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <img src="{{ asset('assets/img/bed.avif') }}" alt="Default Product Image"
                                        class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                @endif
                            </div>
                            <div class="p-6">
                                <h3
                                    class="text-lg font-serif font-semibold text-brown-900 group-hover:text-amber-800 transition-colors">
                                    {{ $matchProduct->name }}
                                </h3>
                                <p class="mt-2 text-xl font-bold text-amber-800">
                                    ${{ number_format($matchProduct->price, 2) }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Chat Modal -->
        <div class="fixed inset-0 z-50 overflow-y-auto hidden" id="chatModal">
            <div class="flex min-h-screen items-end justify-end p-4 text-center sm:items-center">
                <div class="fixed inset-0 bg-brown-900 bg-opacity-75 transition-opacity"></div>

                <div
                    class="relative w-full max-w-md transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all">
                    <!-- Modal Header -->
                    <div class="border-b border-amber-200 px-6 py-4 flex items-center justify-between bg-amber-50">
                        <h3 class="text-lg font-serif font-semibold text-brown-900">Chat with Seller</h3>
                        <button type="button" class="text-brown-600 hover:text-brown-900" id="closeChatModal">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Chat Messages -->
                    <div class="h-96 overflow-y-auto p-6 bg-amber-50" id="chatMessages">
                        <!-- Messages will be added here -->
                    </div>

                    <!-- Chat Input -->
                    <div class="border-t border-amber-200 p-4 bg-white">
                        <div class="flex items-center gap-4">
                            <button class="p-2 text-brown-600 hover:text-brown-900 rounded-full hover:bg-amber-50">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </button>
                            <input type="text" id="messageInput"
                                class="flex-1 rounded-xl border border-amber-200 px-4 py-2 focus:border-amber-500 focus:ring-1 focus:ring-amber-500"
                                placeholder="Type your message...">
                            <button id="sendMessage"
                                class="bg-amber-800 text-white px-4 py-2 rounded-xl hover:bg-amber-900 transition-colors">
                                Send
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .text-brown-900 {
                color: #362517;
            }

            .text-brown-600 {
                color: #6B4423;
            }

            .bg-brown-900 {
                background-color: #362517;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // [Script tetap sama seperti sebelumnya, hanya perlu mengganti class-class warna 
            // dari indigo/rose menjadi amber/brown sesuai dengan yang sudah diubah di HTML]
        </script>
    @endpush
@endsection
