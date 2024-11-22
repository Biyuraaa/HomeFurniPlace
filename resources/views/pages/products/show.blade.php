@extends('pages.components.layout')

@section('content')
    <div class="container py-5">
        <!-- Product Main Section -->
        <div class="row g-5">
            <!-- Product Image Section -->
            <div class="col-lg-6">
                <div class="position-sticky" style="top: 2rem;">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        @if ($product->image)
                            <img id="product-image" src="{{ asset('storage/images/products/' . $product->image) }}"
                                alt="{{ $product->name }}" class="img-fluid zoom"
                                style="height: 600px; width: 100%; object-fit: cover;">
                        @else
                            <img id="product-image" src="{{ asset('assets/img/cushion.avif') }}" alt="Default Product Image"
                                class="img-fluid zoom" style="height: 600px; width: 100%; object-fit: cover;">
                        @endif
                    </div>
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="col-lg-6">
                <div class="ps-lg-4">
                    <!-- Product Title & Price -->
                    <div class="mb-4">
                        <h1 class="display-6 fw-bold mb-3">{{ $product->name }}</h1>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <h2 class="h1 fw-bold text-primary mb-0">${{ number_format($product->price, 2) }}</h2>
                            <span class="badge bg-success">In Stock</span>
                        </div>
                    </div>

                    <!-- Product Description -->
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Product Description</h5>
                        <p class="text-muted" style="line-height: 1.8;">{{ $product->description }}</p>
                    </div>

                    <!-- Stock Counter -->
                    <div class="card border-0 bg-light rounded-3 mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Available Stock:</span>
                                <span class="fw-bold text-success">{{ $product->stock }} items left</span>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="text-muted">Quantity:</span>
                                <div class="input-group" style="width: 140px;">
                                    <button class="btn btn-outline-secondary" type="button" id="stock-minus">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="text" class="form-control text-center" id="stock-value" value="1">
                                    <button class="btn btn-outline-secondary" type="button" id="stock-plus">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-3">
                        <div class="d-flex gap-3">
                            <button class="btn btn-light rounded-circle p-3" id="heart-icon" title="Add to Wishlist">
                                <i class="far fa-heart fs-4 text-danger"></i>
                            </button>
                            <form action="{{ route('carts.store', $product->id) }}" method="POST" class="flex-grow-1">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" id="quantity" value="{{ old('quantity') ?? 1 }}">

                                <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold"
                                    id="add-to-cart-btn">
                                    <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                </button>
                            </form>
                        </div>
                        <button class="btn btn-outline-primary py-3 rounded-3 fw-bold" id="chat-to-seller-btn">
                            <i class="fas fa-comments me-2"></i>Chat with Seller
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Matching Products Section -->
        <section class="mt-5 pt-5">
            <h2 class="display-6 fw-bold text-center mb-5">Good Matching Products</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach ($matches as $matchProduct)
                    <div class="col">
                        <a href="{{ route('product', $matchProduct->id) }}" class="text-decoration-none">
                            <div class="card h-100 border-0 shadow-sm rounded-4 transition-hover"
                                style="transition: transform 0.2s ease-in-out;">
                                @if ($matchProduct->image)
                                    <img src="{{ asset('storage/images/products/' . $matchProduct->image) }}"
                                        class="card-img-top" alt="{{ $matchProduct->name }}"
                                        style="height: 250px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/img/bed.avif') }}" class="card-img-top"
                                        alt="Default Product Image" style="height: 250px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-dark mb-2">{{ $matchProduct->name }}</h5>
                                    <p class="card-text fw-bold text-primary mb-0">
                                        ${{ number_format($matchProduct->price, 2) }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
        <!-- Chat Modal -->
        <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-right"
                style="max-width: 400px; right: 0; position: fixed;">
                <div class="modal-content h-100 border-0 rounded-0">
                    <!-- Modal Header -->
                    <div class="modal-header bg-white border-bottom shadow-sm">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <h5 class="modal-title ms-2" id="chatModalLabel">Chat with Seller</h5>
                    </div>

                    <!-- Modal Body -->
                    {{-- <div class="modal-body p-0 d-flex flex-column h-100">
                        <!-- Chat Header -->
                        <div class="p-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('assets/img/seller-avatar.png') }}" alt="Seller Avatar"
                                        class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0 fw-bold">{{ $product->seller->user->name ?? 'Seller Name' }}</h6>
                                    <small class="text-muted">Active now</small>
                                </div>
                            </div>
                        </div>

                        <!-- Chat Messages -->
                        <div id="chatMessages" class="chat-messages p-3 flex-grow-1 overflow-auto"
                            style="max-height: calc(100vh - 240px);">
                            <!-- Messages will appear here -->
                        </div>

                        <!-- Chat Input -->
                        <div class="border-top p-3 bg-white">
                            <div class="input-group">
                                <button class="btn btn-light border" type="button">
                                    <i class="far fa-image"></i>
                                </button>
                                <input type="text" class="form-control border" id="messageInput"
                                    placeholder="Type your message...">
                                <button class="btn btn-primary" id="sendMessage" type="button">Send</button>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

    </div>

    @push('styles')
        <style>
            .transition-hover:hover {
                transform: translateY(-5px);
            }

            .zoom {
                transition: transform 0.2s ease;
            }

            .zoom:hover {
                transform: scale(1.1);
                cursor: zoom-in;
            }

            .chat-messages {
                background-color: #f8f9fa;
                overflow-y: auto;
                padding-bottom: 10px;
            }

            .chat-messages::-webkit-scrollbar {
                width: 6px;
            }

            .chat-messages::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            .chat-messages::-webkit-scrollbar-thumb {
                background: #888;
                border-radius: 3px;
            }

            .chat-messages::-webkit-scrollbar-thumb:hover {
                background: #555;
            }

            .input-group input {
                border-radius: 30px;
            }

            .input-group button {
                border-radius: 30px;
            }

            .modal-dialog-right .modal-content {
                border-radius: 0;
            }
        </style>
    @endpush

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const stockMinus = document.getElementById("stock-minus");
            const stockPlus = document.getElementById("stock-plus");
            const stockValue = document.getElementById("stock-value");
            const quantityInput = document.getElementById("quantity");
            const maxStock = {{ $product->stock }}; // Maximum stock

            function updateQuantity(newValue) {
                stockValue.value = newValue; // Update visible quantity
                quantityInput.value = newValue; // Update hidden form input
            }

            stockMinus.addEventListener("click", () => {
                let quantity = parseInt(stockValue.value);
                if (quantity > 1) {
                    updateQuantity(quantity - 1);
                }
            });

            stockPlus.addEventListener("click", () => {
                let quantity = parseInt(stockValue.value);
                if (quantity < maxStock) {
                    updateQuantity(quantity + 1);
                }
            })

            updateQuantity(parseInt(stockValue.value));

            // Animate heart icon on click
            const heartIcon = document.getElementById("heart-icon");
            heartIcon.addEventListener("click", function() {
                const icon = this.querySelector('i');
                icon.classList.toggle('far');
                icon.classList.toggle('fas');
                this.classList.add('animate__animated', 'animate__heartBeat');
                setTimeout(() => {
                    this.classList.remove('animate__animated', 'animate__heartBeat');
                }, 1000);
            });

            // Open chat with seller modal (example)
            const chatButton = document.getElementById('chat-to-seller-btn');
            const chatModal = new bootstrap.Modal(document.getElementById('chatModal'));
            chatButton.addEventListener('click', function() {
                chatModal.show();
            });


            const sendMessageButton = document.getElementById('sendMessage');
            const messageInput = document.getElementById('messageInput');
            const chatMessagesContainer = document.getElementById('chatMessages');



            // Handle message send
            sendMessageButton.addEventListener('click', function() {
                const message = messageInput.value.trim();
                if (message) {
                    appendMessage(message, 'user'); // Append user message
                    messageInput.value = ''; // Clear input field

                    // Simulate seller reply after a delay
                    setTimeout(() => {
                        appendMessage("Hello! How can I assist you?",
                            'seller'); // Simulated seller message
                    }, 1000);
                }
            });

            // Optional: Allow Enter key to send message
            messageInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    sendMessageButton.click();
                }
            });
        });
    </script>
@endsection
