@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-b from-amber-50 to-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center" data-aos="fade-up">
                <h1 class="text-5xl font-serif font-bold text-brown-900 mb-4">Discover Timeless Furniture</h1>
                <p class="text-lg text-brown-600 max-w-2xl mx-auto">Elevate your living space with our curated collection of
                    handcrafted furniture pieces.</p>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section id="featured-products" class="bg-white py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-amber-800 text-sm font-bold tracking-wider uppercase">Handpicked Selection</span>
                <h2 class="mt-2 text-4xl font-serif font-bold text-brown-900 sm:text-5xl">Featured Collections</h2>
                <div class="mt-4 h-1 w-24 bg-amber-800 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-16">
                @foreach ($topProducts as $product)
                    <a href="{{ route('product', ['id' => $product->id]) }}" class="group relative block" data-aos="fade-up"
                        data-aos-duration="700" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="relative overflow-hidden rounded-xl shadow-lg bg-amber-50">
                            <div
                                class="aspect-w-4 aspect-h-3 bg-amber-100 group-hover:scale-105 transition-transform duration-500">
                                @if ($product->image)
                                    <img src="{{ asset('storage/images/product/' . $product->image) }}"
                                        alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('assets/img/marigold sofa.jpg') }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover">
                                @endif
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-brown-900/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                            </div>
                            <div
                                class="absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                                <h3
                                    class="text-xl font-serif font-bold leading-tight group-hover:text-amber-200 transition-colors">
                                    {{ $product->name }}
                                </h3>
                                <div
                                    class="flex items-center mt-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <p class="ml-1 text-sm">{{ number_format($product->rating, 1) }}
                                            <span class="text-amber-200">({{ $product->review_count }})</span>
                                        </p>
                                    </div>
                                    <p class="ml-auto text-xl font-bold">${{ number_format($product->price, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- All Products Section -->
    <section class="bg-amber-50 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-amber-800 text-sm font-bold tracking-wider uppercase">Explore Our Selection</span>
                <h2 class="mt-2 text-4xl font-serif font-bold text-brown-900 sm:text-5xl">Complete Collection</h2>
                <div class="mt-4 h-1 w-24 bg-amber-800 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($products as $product)
                    <a href="{{ route('product', ['id' => $product->id]) }}" class="group" data-aos="fade-up"
                        data-aos-duration="700" data-aos-delay="{{ $loop->index * 50 }}">
                        <div
                            class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="aspect-w-1 aspect-h-1 bg-amber-50">
                                @if ($product->image)
                                    <img src="{{ asset('storage/images/product/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <img src="{{ asset('assets/img/side table.jpg') }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                @endif
                            </div>
                            <div class="p-6">
                                <h3
                                    class="text-lg font-serif font-semibold text-brown-900 group-hover:text-amber-800 transition-colors">
                                    {{ $product->name }}
                                </h3>
                                <div class="flex items-center mt-2">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <p class="ml-1 text-sm text-brown-600">
                                            {{ number_format($product->rating, 1) }}
                                            <span class="text-brown-400">({{ $product->review_count }})</span>
                                        </p>
                                    </div>
                                    <p class="ml-auto text-lg font-bold text-brown-900">
                                        ${{ number_format($product->price, 2) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .text-brown-900 {
            color: #362517;
        }

        .text-brown-600 {
            color: #6B4423;
        }

        .text-brown-400 {
            color: #9C6644;
        }

        .bg-brown-900 {
            background-color: #362517;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 800,
            easing: 'ease-out'
        });
    </script>
@endpush
