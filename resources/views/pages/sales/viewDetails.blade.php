@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#F5F0E6] py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-[#5D4037] sm:text-4xl">Track Your Order</h2>
                <a href="{{ route('sales.purchased') }}"
                    class="mt-4 inline-flex items-center text-sm font-medium text-[#8D6E63] hover:text-[#6D4C41] transition duration-150 ease-in-out">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Back to Purchased Items
                </a>
            </div>

            <!-- Order Progress -->
            <div class="bg-white rounded-2xl shadow-lg border border-[#D7CCC8] p-8 mb-12">
                <div class="relative">
                    <!-- Progress Bar -->
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-[#D7CCC8]">
                        <div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-[#6D4C41] transition-all duration-500 ease-in-out"
                            style="width: {{ $sale->status == 'purchased' ? '33%' : ($sale->status == 'shipped' ? '66%' : ($sale->status == 'delivered' ? '100%' : '0%')) }};">
                        </div>
                    </div>

                    <!-- Status Steps -->
                    <div class="flex justify-between -mt-2">
                        @foreach (['confirmed', 'shipped', 'delivered'] as $status)
                            <div class="text-center">
                                <div
                                    class="w-10 h-10 mx-auto rounded-full flex items-center justify-center {{ $sale->status == $status || ($sale->status == 'delivered' && $status != 'delivered') || ($sale->status == 'shipped' && $status == 'confirmed') ? 'bg-[#6D4C41]' : 'bg-[#EFEBE9]' }} transition-all duration-500 ease-in-out">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="mt-2 text-sm font-medium text-[#5D4037] capitalize">{{ $status }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if ($sale->status == 'shipped')
                    <div class="mt-8 text-center">
                        <form action="{{ route('sales.confirmDelivery', $sale->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#4E342E] hover:bg-[#3E2723] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5D4037] transition duration-150 ease-in-out"
                                onclick="return confirm('Are you sure you have received this order?')">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Confirm Order Received
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Order Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Order Summary -->
                <div class="bg-white rounded-2xl shadow-lg border border-[#D7CCC8] overflow-hidden">
                    <div class="px-6 py-4 border-b border-[#D7CCC8] flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-[#5D4037]">Order Summary</h3>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $sale->status == 'purchased' ? 'bg-[#E0F2F1] text-[#00695C]' : ($sale->status == 'shipped' ? 'bg-[#FFF3E0] text-[#E65100]' : ($sale->status == 'delivered' ? 'bg-[#E8F5E9] text-[#2E7D32]' : 'bg-[#FFEBEE] text-[#C62828]')) }}">
                            {{ ucfirst($sale->status) }}
                        </span>
                    </div>
                    <div class="px-6 py-4">
                        <dl class="divide-y divide-[#D7CCC8]">
                            @foreach ([
            'Order ID' => '#' . $sale->id,
            'Order Date' => $sale->created_at->format('d M Y'),
            'Quantity' => $sale->quantity . ' items',
            'Total Amount' => 'Rp. ' . number_format($sale->product->price * $sale->quantity, 2, ',', '.'),
        ] as $label => $value)
                                <div class="py-3 flex justify-between">
                                    <dt class="text-sm text-[#8D6E63]">{{ $label }}</dt>
                                    <dd class="text-sm font-medium text-[#5D4037]">{{ $value }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="bg-white rounded-2xl shadow-lg border border-[#D7CCC8] overflow-hidden">
                    <div class="px-6 py-4 border-b border-[#D7CCC8]">
                        <h3 class="text-lg font-semibold text-[#5D4037]">Product Details</h3>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex items-center">
                            <img src="{{ $sale->product->image ? asset('storage/images/products/' . $sale->product->image) : 'https://via.placeholder.com/100' }}"
                                alt="{{ $sale->product->name }}"
                                class="w-24 h-24 rounded-xl object-cover border-2 border-[#D7CCC8]">
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-[#5D4037]">{{ $sale->product->name }}</h4>
                                <p class="text-sm text-[#8D6E63]">Category: {{ $sale->product->category->name }}</p>
                                <p class="mt-1 text-lg font-medium text-[#6D4C41]">Rp.
                                    {{ number_format($sale->product->price, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seller Information -->
                <div class="bg-white rounded-2xl shadow-lg border border-[#D7CCC8] overflow-hidden">
                    <div class="px-6 py-4 border-b border-[#D7CCC8]">
                        <h3 class="text-lg font-semibold text-[#5D4037]">Seller Information</h3>
                    </div>
                    <div class="px-6 py-4">
                        <dl class="divide-y divide-[#D7CCC8]">
                            @foreach ([
            'user' => $sale->product->seller->user->name,
            'mail' => $sale->product->seller->user->email,
            'phone' => $sale->product->seller->user->phone ?? '-',
        ] as $icon => $value)
                                <div class="py-3 flex items-center">
                                    <dt class="text-sm text-[#8D6E63]">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if ($icon == 'user')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            @elseif($icon == 'mail')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            @endif
                                        </svg>
                                    </dt>
                                    <dd class="text-sm text-[#5D4037] ml-3">{{ $value }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="bg-white rounded-2xl shadow-lg border border-[#D7CCC8] overflow-hidden">
                    <div class="px-6 py-4 border-b border-[#D7CCC8]">
                        <h3 class="text-lg font-semibold text-[#5D4037]">Shipping Information</h3>
                    </div>
                    <div class="px-6 py-4">
                        @if ($sale->courier)
                            <dl class="divide-y divide-[#D7CCC8]">
                                @foreach ([
            'truck' => $sale->courier->name,
            'phone' => $sale->courier->phone,
            'map-pin' => $sale->courier->address,
        ] as $icon => $value)
                                    <div class="py-3 flex items-center">
                                        <dt class="text-sm text-[#8D6E63]">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                @if ($icon == 'truck')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                                @elseif($icon == 'phone')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                @endif
                                            </svg>
                                        </dt>
                                        <dd class="text-sm text-[#5D4037] ml-3">{{ $value }}</dd>
                                    </div>
                                @endforeach
                            @else
                                <div class="py-8 text-center">
                                    <svg class="mx-auto h-12 w-12 text-[#8D6E63]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="mt-2 text-sm text-[#8D6E63]">No shipping information available for canceled
                                        orders.</p>
                                </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
