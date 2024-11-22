@extends('pages.components.layout')

@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Your Cart</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="cart-form" action="{{ route('sales.store') }}" method="POST">
            @csrf
            <div class="list-group mb-5">
                @foreach ($carts as $cart)
                    <div class="list-group-item d-flex justify-content-between align-items-center cart-item p-3 mb-2 shadow-sm rounded"
                        data-cart-id="{{ $cart->id }}">
                        <div class="d-flex align-items-center">
                            <input type="checkbox" name="cartItems[]" value="{{ $cart->id }}"
                                class="form-check-input me-3 cart-checkbox">
                            <img src="{{ $cart->product->image ? asset('storage/images/products/' . $cart->product->image) : 'https://via.placeholder.com/50' }}"
                                alt="{{ $cart->product->name }}" width="60" height="60" class="me-3 rounded-circle">
                            <div>
                                <h6 class="mb-1">{{ $cart->product->name }}</h6>
                                <p class="mb-0 text-muted">Price: Rp. <span
                                        class="product-price">{{ number_format($cart->product->price, 2, ',', '.') }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="number" name="quantities[{{ $cart->id }}]" value="{{ $cart->quantity }}"
                                min="1" class="form-control quantity-input me-2" style="width: 70px;"
                                data-cart-id="{{ $cart->id }}" data-price-per-item="{{ $cart->product->price }}">
                            <p class="mb-0 text-muted me-2">Total: Rp. <span
                                    class="item-price">{{ number_format($cart->quantity * $cart->product->price, 2, ',', '.') }}</span>
                            </p>
                            <button type="button" class="btn btn-outline-danger btn-sm remove-btn"
                                data-cart-id="{{ $cart->id }}">
                                <i class="fas fa-trash-alt"></i> Remove
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="cart-footer d-flex justify-content-between align-items-center p-3 rounded shadow">
                <span class="fw-bold">Total: Rp. <span id="total-price">0</span></span>
                <button type="submit" class="btn btn-primary">Checkout</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantities = document.querySelectorAll('.quantity-input');
            const checkboxes = document.querySelectorAll('.cart-checkbox');
            const totalPriceElement = document.getElementById('total-price');
            const removeButtons = document.querySelectorAll('.remove-btn');

            function updateTotalPrice() {
                let totalPrice = 0;
                quantities.forEach(function(input) {
                    const pricePerItem = parseFloat(input.dataset.pricePerItem);
                    const quantity = parseInt(input.value) || 0;
                    const newPrice = quantity * pricePerItem;
                    const itemPriceElement = input.closest('.list-group-item').querySelector('.item-price');
                    itemPriceElement.innerText = newPrice.toFixed(2).replace('.', ',');
                    if (input.closest('.list-group-item').querySelector('.cart-checkbox').checked) {
                        totalPrice += newPrice;
                    }
                });
                totalPriceElement.innerText = totalPrice.toFixed(2).replace('.', ',');
            }

            async function saveQuantity(cartId, quantity) {
                await fetch(`/carts/${cartId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        quantity: quantity
                    })
                }).catch(error => console.error('Error:', error));
            }

            async function removeCartItem(cartId) {
                await fetch(`/carts/${cartId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.querySelector(`[data-cart-id="${cartId}"]`).remove();
                            updateTotalPrice();
                        }
                    }).catch(error => console.error('Error:', error));
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

            updateTotalPrice();
        });
    </script>
@endsection

@section('styles')
    <style>
        .cart-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #f8f9fa;
            padding: 10px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .cart-item img {
            border-radius: 50%;
        }

        .btn-outline-danger {
            color: #dc3545;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .list-group-item {
            transition: background-color 0.3s;
        }

        .list-group-item:hover {
            background-color: #f1f1f1;
        }
    </style>
@endsection
