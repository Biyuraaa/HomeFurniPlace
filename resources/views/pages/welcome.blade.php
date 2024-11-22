@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-amber-50 to-orange-50 py-20 sm:py-24 lg:py-32">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 bg-[url('/path/to/wood-pattern.png')] opacity-5"></div>
        <div class="absolute -top-24 -left-20 w-96 h-96 bg-amber-100 rounded-full filter blur-3xl opacity-30 animate-blob">
        </div>
        <div
            class="absolute -bottom-24 -right-20 w-96 h-96 bg-orange-100 rounded-full filter blur-3xl opacity-30 animate-blob animation-delay-2000">
        </div>

        <div class="relative container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <!-- Content Side -->
                <div class="max-w-2xl" data-aos="fade-right" data-aos-duration="1000">
                    <div class="mb-8">
                        <div class="inline-flex items-center rounded-full bg-amber-100 px-6 py-2 text-amber-800 mb-6">
                            <span class="text-sm font-medium tracking-wide">Welcome to HomeFurniPlace</span>
                        </div>
                        <h1
                            class="text-4xl sm:text-5xl lg:text-6xl font-bold text-amber-900 leading-tight tracking-tight mb-6">
                            Furniture that
                            <span class="relative">
                                <span class="relative inline-block text-amber-700">
                                    makes home better
                                    <svg class="absolute -bottom-2 w-full" viewBox="0 0 358 8" fill="none">
                                        <path d="M2 5.8C65.3333 2.46667 196.667 2.46667 356 5.8" stroke="#B45309"
                                            stroke-width="3" stroke-linecap="round" />
                                    </svg>
                                </span>
                            </span>
                        </h1>
                        <p class="text-xl text-amber-800 leading-relaxed mb-10">
                            Discover timeless furniture pieces that blend comfort with elegance. Create your perfect living
                            space with our carefully curated collection.
                        </p>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('products') }}"
                            class="inline-flex items-center px-8 py-4 text-base font-medium rounded-xl text-white bg-amber-700 hover:bg-amber-800 shadow-lg shadow-amber-700/30 hover:shadow-amber-700/40 transform hover:-translate-y-0.5 transition-all duration-200">
                            Shop Collection
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#featured"
                            class="inline-flex items-center px-8 py-4 text-base font-medium rounded-xl text-amber-900 bg-white hover:bg-amber-50 border border-amber-200 shadow-sm transform hover:-translate-y-0.5 transition-all duration-200">
                            Browse Catalog
                        </a>
                    </div>

                    <!-- Trust Badges -->
                    <div class="mt-12 pt-8 border-t border-amber-100">
                        <div class="flex flex-wrap gap-8 items-center">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-sm text-amber-800">4.9/5 Rating</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm text-amber-800">Quality Guaranteed</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                <span class="text-sm text-amber-800">Free Delivery</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Side -->
                <div class="relative" data-aos="fade-left" data-aos-duration="1000">
                    <div class="relative rounded-3xl overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-tr from-amber-500/10 to-orange-500/10"></div>
                        <img src="{{ asset('assets/img/furniture_front.jpg') }}" alt="Modern Furniture Collection"
                            class="w-full h-auto object-cover rounded-3xl shadow-2xl transform hover:scale-105 transition-transform duration-700">
                    </div>

                    <!-- Floating Elements -->
                    <div
                        class="absolute -right-4 -bottom-4 bg-white rounded-2xl shadow-xl p-4 transform rotate-3 animate-float">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-amber-900">Handcrafted</p>
                                <p class="text-xs text-amber-600">Premium Wood</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- New Products Section -->
    <section class="py-20 bg-amber-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span
                    class="inline-block px-4 py-1 text-sm font-semibold tracking-wider text-amber-900 uppercase bg-amber-100 rounded-full"
                    data-aos="fade-up">
                    Koleksi Terbaru
                </span>
                <h2 class="mt-6 text-3xl font-serif font-bold text-amber-950 sm:text-4xl lg:text-5xl" data-aos="fade-up"
                    data-aos-delay="100">
                    Temukan Perabotan Impian Anda
                </h2>
                <p class="mt-4 max-w-2xl mx-auto text-lg text-amber-800" data-aos="fade-up" data-aos-delay="200">
                    Eksplorasi koleksi furniture terbaru kami yang dirancang untuk menciptakan ruang yang nyaman dan elegan
                </p>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($newProducts->take(6) as $index => $product)
                    <div class="group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div
                            class="relative aspect-[3/4] overflow-hidden rounded-xl border border-amber-200 bg-white transition-all duration-300 group-hover:shadow-2xl">
                            <a href="{{ route('product', $product->id) }}" class="block h-full">
                                @if ($product->image)
                                    <img src="{{ asset('storage/images/products/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-center object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <img src="{{ asset('assets/img/chair.avif') }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-center object-cover transition-transform duration-500 group-hover:scale-105">
                                @endif
                                <div
                                    class="absolute inset-0 bg-amber-950 bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                            </a>

                            <!-- Wishlist Button -->
                            <div class="absolute top-4 right-4">
                                <button
                                    class="bg-white rounded-full p-3 text-amber-800 hover:text-amber-600 hover:bg-amber-50 transition-colors duration-200 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Product Info -->
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-white bg-opacity-95 p-6 border-t border-amber-100">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-lg font-serif font-semibold text-amber-950">
                                            <a href="{{ route('product', $product->id) }}"
                                                class="hover:text-amber-700 transition-colors duration-200">
                                                {{ $product->name }}
                                            </a>
                                        </h3>
                                        <p class="mt-1 text-sm text-amber-700">{{ $product->category->name }}</p>
                                    </div>
                                    <p class="text-xl font-bold text-amber-800">${{ number_format($product->price, 2) }}
                                    </p>
                                </div>

                                <!-- Add to Cart Button -->
                                <button
                                    class="w-full bg-amber-800 text-white py-3 px-4 rounded-lg hover:bg-amber-900 transition-all duration-300 flex items-center justify-center group">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 mr-2 transition-transform duration-300 group-hover:scale-110"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All Products Button -->
            <div class="mt-20 text-center">
                <a href="{{ route('products') }}"
                    class="inline-flex items-center px-8 py-4 border-2 border-amber-800 text-lg font-medium rounded-lg text-amber-800 hover:bg-amber-800 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl">
                    Lihat Semua Produk
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 ml-2 transition-transform duration-300 group-hover:translate-x-1"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Sale Section -->
    <section class="py-24 bg-gradient-to-b from-amber-50 to-amber-100 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div
            class="absolute top-0 left-0 w-64 h-64 bg-amber-200 rounded-full filter blur-3xl opacity-20 -translate-x-1/2 -translate-y-1/2">
        </div>
        <div
            class="absolute bottom-0 right-0 w-96 h-96 bg-amber-300 rounded-full filter blur-3xl opacity-20 translate-x-1/2 translate-y-1/2">
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="lg:grid lg:grid-cols-2 lg:gap-12 lg:items-center">
                <!-- Left Content -->
                <div class="relative" data-aos="fade-right">
                    <span
                        class="inline-block px-4 py-1 text-sm font-semibold tracking-wider text-amber-900 uppercase bg-amber-200 rounded-full mb-6">
                        Penawaran Spesial
                    </span>
                    <h3 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-amber-950 tracking-tight">
                        Mega Sale<br />
                        <span class="text-amber-700">Diskon Hingga 75%</span>
                    </h3>
                    <p class="mt-6 text-lg text-amber-800 leading-relaxed">
                        Jangan lewatkan kesempatan terbaik untuk mempercantik ruangan Anda dengan koleksi furniture premium
                        kami dengan harga terbaik.
                    </p>

                    <dl class="mt-12 space-y-8">
                        @foreach ($lowStockProducts->take(3) as $product)
                            <div class="relative bg-white p-6 rounded-2xl shadow-md transform transition-transform duration-300 hover:-translate-y-1 hover:shadow-xl"
                                data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                                <dt class="flex items-center">
                                    <div
                                        class="flex items-center justify-center h-14 w-14 rounded-xl bg-amber-800 text-amber-100">
                                        <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                                        </svg>
                                    </div>
                                    <div class="ml-6">
                                        <p class="text-xl font-semibold text-amber-900">{{ $product->name }}</p>
                                        <div class="mt-2 flex items-baseline">
                                            <span
                                                class="text-2xl font-bold text-amber-700">${{ number_format($product->price * 0.75, 2) }}</span>
                                            <span
                                                class="ml-2 text-lg text-amber-500 line-through">${{ number_format($product->price, 2) }}</span>
                                            <span
                                                class="ml-4 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                                Hemat 25%
                                            </span>
                                        </div>
                                    </div>
                                </dt>
                                <dd class="mt-4 flex justify-between items-center">
                                    <span class="text-sm text-amber-600">*Stok terbatas</span>
                                    <a href="{{ route('product', $product->id) }}"
                                        class="text-amber-800 hover:text-amber-600 font-medium flex items-center">
                                        Lihat Detail
                                        <svg class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </dd>
                            </div>
                        @endforeach
                    </dl>
                </div>

                <!-- Right Image -->
                <div class="mt-12 lg:mt-0" data-aos="fade-left">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <div class="absolute inset-0 bg-gradient-to-t from-amber-900/40 to-transparent z-10"></div>
                        <img class="w-full h-full object-cover transform transition-transform duration-700 hover:scale-105"
                            src="{{ asset('assets/img/marigold sofa.jpg') }}" alt="Marigold Sofa">
                        <!-- Promo Badge -->
                        <div
                            class="absolute top-6 right-6 bg-amber-800 text-amber-100 rounded-full p-4 shadow-lg z-20 transform rotate-12">
                            <div class="text-center">
                                <span class="block text-2xl font-bold">75%</span>
                                <span class="block text-sm">OFF</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Button -->
            <div class="mt-16 text-center">
                <a href="{{ route('products') }}"
                    class="inline-flex items-center px-8 py-4 text-lg font-medium rounded-full bg-amber-800 text-white hover:bg-amber-900 focus:outline-none focus:ring-4 focus:ring-amber-500 focus:ring-offset-2 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl group">
                    Jelajahi Koleksi Sale
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 ml-2 transform transition-transform duration-300 group-hover:translate-x-1"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    @push('styles')
        <!-- Required CSS for animations -->
        <style>
            @keyframes float {
                0% {
                    transform: translateY(0px) rotate(3deg);
                }

                50% {
                    transform: translateY(-10px) rotate(3deg);
                }

                100% {
                    transform: translateY(0px) rotate(3deg);
                }
            }

            @keyframes blob {
                0% {
                    transform: translate(0px, 0px) scale(1);
                }

                33% {
                    transform: translate(30px, -30px) scale(1.1);
                }

                66% {
                    transform: translate(-20px, 20px) scale(0.9);
                }

                100% {
                    transform: translate(0px, 0px) scale(1);
                }
            }

            .animate-float {
                animation: float 6s ease-in-out infinite;
            }

            .animate-blob {
                animation: blob 7s infinite;
            }

            .animation-delay-2000 {
                animation-delay: 2s;
            }
        </style>
    @endpush
@endsection
