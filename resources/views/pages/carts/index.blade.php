@extends('layouts.app')

@section('title', 'Shopping Cart - Furniture Haven')

@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <div class="bg-gradient-to-b from-[#F5E6D3] to-[#E2D4C3] min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-4xl font-bold text-amber-900">Your Cart</h1>
                <a href="{{ route('products') }}" class="text-amber-700 hover:text-amber-800 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Continue Shopping
                </a>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Please check the following errors:</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <form id="cart-form" action="{{ route('sales.store') }}" method="POST">
                @csrf
                <div class="bg-white rounded-xl shadow-lg border border-amber-200 overflow-hidden mb-8">
                    @if ($carts->isEmpty())
                        <div class="p-12 text-center">
                            <div class="w-24 h-24 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-amber-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-amber-900 mb-2">Your cart is empty</h3>
                            <p class="text-amber-700 mb-6">Discover our beautiful furniture collection and start decorating
                                your home.</p>
                            <a href="{{ route('products') }}"
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors">
                                Browse Furniture
                            </a>
                        </div>
                    @else
                        <ul class="divide-y divide-amber-200">
                            @foreach ($carts as $cart)
                                <li class="cart-item hover:bg-amber-50 transition-colors"
                                    data-cart-id="{{ $cart->id }}">
                                    <div class="p-6 sm:py-6 sm:px-8">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center flex-1">
                                                <div class="flex items-center">
                                                    <input type="checkbox" name="cartItems[]" value="{{ $cart->id }}"
                                                        class="cart-checkbox h-5 w-5 text-amber-600 focus:ring-amber-500 border-amber-300 rounded transition-all cursor-pointer">
                                                    <div class="relative ml-6">
                                                        <img class="h-24 w-24 rounded-lg object-cover border border-amber-200"
                                                            src="{{ $cart->product->image ? asset('storage/images/products/' . $cart->product->image) : 'https://via.placeholder.com/96' }}"
                                                            alt="{{ $cart->product->name }}">
                                                    </div>
                                                </div>
                                                <div class="ml-6">
                                                    <h2 class="text-xl font-semibold text-amber-900 mb-1">
                                                        {{ $cart->product->name }}</h2>
                                                    <p class="text-sm text-amber-700">Price per item:
                                                        <span class="font-medium text-amber-900">Rp.
                                                            <span
                                                                class="product-price">{{ number_format($cart->product->price, 2, ',', '.') }}</span>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-8">
                                                <div
                                                    class="flex items-center bg-amber-50 rounded-lg border border-amber-200">
                                                    <button type="button"
                                                        class="quantity-btn minus p-3 hover:bg-amber-100 rounded-l-lg transition-colors">
                                                        <svg class="w-4 h-4 text-amber-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M20 12H4"></path>
                                                        </svg>
                                                    </button>
                                                    <input type="number" name="quantities[{{ $cart->id }}]"
                                                        value="{{ $cart->quantity }}" min="1"
                                                        class="quantity-input w-16 text-center border-0 bg-transparent focus:ring-0 text-amber-900 font-medium"
                                                        data-cart-id="{{ $cart->id }}"
                                                        data-price-per-item="{{ $cart->product->price }}">
                                                    <button type="button"
                                                        class="quantity-btn plus p-3 hover:bg-amber-100 rounded-r-lg transition-colors">
                                                        <svg class="w-4 h-4 text-amber-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-sm text-amber-700 mb-1">Total</p>
                                                    <p class="text-lg font-semibold text-amber-900">Rp.
                                                        <span
                                                            class="item-price">{{ number_format($cart->quantity * $cart->product->price, 2, ',', '.') }}</span>
                                                    </p>
                                                </div>
                                                <button type="button"
                                                    class="remove-btn p-2 text-amber-400 hover:text-red-500 transition-colors"
                                                    data-cart-id="{{ $cart->id }}">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                @if (!$carts->isEmpty())
                    <div class="fixed bottom-0 inset-x-0 pb-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="bg-white border border-amber-200 rounded-xl shadow-lg p-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-6">
                                        <span class="flex items-center justify-center w-12 h-12 bg-amber-100 rounded-full">
                                            <svg class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </span>
                                        <div>
                                            <p class="text-sm text-amber-700">Total Price</p>
                                            <p class="text-2xl font-bold text-amber-900">Rp. <span
                                                    id="total-price">0</span></p>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="inline-flex items-center px-8 py-4 border border-transparent text-base font-medium rounded-lg text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors">
                                        Proceed to Checkout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const quantities = document.querySelectorAll('.quantity-input');
                const checkboxes = document.querySelectorAll('.cart-checkbox');
                const totalPriceElement = document.getElementById('total-price');
                const removeButtons = document.querySelectorAll('.remove-btn');
                const minusButtons = document.querySelectorAll('.quantity-btn.minus');
                const plusButtons = document.querySelectorAll('.quantity-btn.plus');

                function updateTotalPrice() {
                    let totalPrice = 0;
                    quantities.forEach(function(input) {
                        const pricePerItem = parseFloat(input.dataset.pricePerItem);
                        const quantity = parseInt(input.value) || 0;
                        const newPrice = quantity * pricePerItem;
                        const itemPriceElement = input.closest('.cart-item').querySelector('.item-price');
                        itemPriceElement.innerText = newPrice.toFixed(2).replace('.', ',');
                        if (input.closest('.cart-item').querySelector('.cart-checkbox').checked) {
                            totalPrice += newPrice;
                        }
                    });
                    totalPriceElement.innerText = totalPrice.toFixed(2).replace('.', ',');
                }

                async function saveQuantity(cartId, quantity) {
                    try {
                        const response = await fetch(`/carts/${cartId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                quantity: quantity
                            })
                        });
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        const data = await response.json();
                        if (data.success) {
                            // Optionally show a success message
                            console.log('Quantity updated successfully');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        // Optionally show an error message to the user
                    }
                }

                async function removeCartItem(cartId) {
                    try {
                        const response = await fetch(`/carts/${cartId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        const data = await response.json();
                        if (data.success) {
                            document.querySelector(`[data-cart-id="${cartId}"]`).remove();
                            updateTotalPrice();
                            // Optionally show a success message
                            console.log('Item removed successfully');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        // Optionally show an error message to the user
                    }
                }

                quantities.forEach(input => {
                    input.addEventListener('change', function() {
                        const cartId = input.closest('.cart-item').dataset.cartId;
                        const quantity = parseInt(input.value);
                        saveQuantity(cartId, quantity);
                        updateTotalPrice();
                    });
                });

                checkboxes.forEach(checkbox => checkbox.addEventListener('change', updateTotalPrice));

                removeButtons.forEach(button => button.addEventListener('click', function() {
                    const cartId = button.dataset.cartId;
                    if (confirm('Are you sure you want to remove this item from the cart?')) {
                        removeCartItem(cartId);
                    }
                }));

                minusButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const input = this.nextElementSibling;
                        if (input.value > 1) {
                            input.value = parseInt(input.value) - 1;
                            input.dispatchEvent(new Event('change'));
                        }
                    });
                });

                plusButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const input = this.previousElementSibling;
                        input.value = parseInt(input.value) + 1;
                        input.dispatchEvent(new Event('change'));
                    });
                });

                updateTotalPrice();
            });
        </script>
    @endpush
@endsection
