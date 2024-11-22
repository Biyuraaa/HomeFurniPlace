@extends('pages.components.layout')

@section('content')
    <div class="container mt-5">
        <h3 class="mb-4 text-center fw-bold text-primary">Track Your Order</h3>

        <!-- Back Button -->
        <div class="text-center mb-4">
            <a href="{{ route('sales.purchased') }}" class="btn btn-outline-primary">
                <i class="fas fa-chevron-left me-2"></i>Back to Purchased Items
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Progress Timeline -->
                <div class="card shadow border-0 mb-4">
                    <div class="card-body p-4">
                        <div class="position-relative">
                            <!-- Progress Bar -->
                            <div class="progress" style="height: 2px;">
                                <div class="progress-bar bg-primary" role="progressbar"
                                    style="width: {{ $sale->status == 'purchased' ? '33%' : ($sale->status == 'shipped' ? '66%' : ($sale->status == 'delivered' ? '100%' : '0%')) }};"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>

                            <!-- Status Icons -->
                            <div class="d-flex justify-content-between position-relative" style="margin-top: -25px;">
                                <div class="text-center">
                                    <div class="rounded-circle {{ $sale->status != 'canceled' ? 'bg-success' : 'bg-secondary' }} d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 50px; height: 50px;">
                                        <i class="fas fa-check-circle fa-lg text-white"></i>
                                    </div>
                                    <p class="text-sm mb-0">Confirmed</p>
                                </div>
                                <div class="text-center">
                                    <div class="rounded-circle {{ $sale->status == 'shipped' || $sale->status == 'delivered' ? 'bg-primary' : 'bg-secondary' }} d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 50px; height: 50px;">
                                        <i class="fas fa-truck fa-lg text-white"></i>
                                    </div>
                                    <p class="text-sm mb-0">Shipped</p>
                                </div>
                                <div class="text-center">
                                    <div class="rounded-circle {{ $sale->status == 'delivered' ? 'bg-success' : 'bg-secondary' }} d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 50px; height: 50px;">
                                        <i class="fas fa-box fa-lg text-white"></i>
                                    </div>
                                    <p class="text-sm mb-0">Delivered</p>
                                </div>
                            </div>
                        </div>

                        <!-- Confirmation Button -->
                        @if ($sale->status == 'shipped')
                            <div class="text-center mt-4">
                                <form action="{{ route('sales.confirmDelivery', $sale->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success"
                                        onclick="return confirm('Are you sure you have received this order?')">
                                        <i class="fas fa-check-circle me-2"></i>Confirm Order Received
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Order Summary Card -->
                <div class="card shadow border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">Order Summary</h5>
                            <span
                                class="badge {{ $sale->status == 'purchased'
                                    ? 'bg-info'
                                    : ($sale->status == 'shipped'
                                        ? 'bg-warning'
                                        : ($sale->status == 'delivered'
                                            ? 'bg-success'
                                            : 'bg-danger')) }} px-3 py-2">
                                {{ ucfirst($sale->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Order ID</p>
                                <p class="fw-bold mb-0">#{{ $sale->id }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Order Date</p>
                                <p class="fw-bold mb-0">{{ $sale->created_at->format('d M Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Quantity</p>
                                <p class="fw-bold mb-0">{{ $sale->quantity }} items</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Total Amount</p>
                                <p class="fw-bold mb-0 text-primary">Rp.
                                    {{ number_format($sale->product->price * $sale->quantity, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="card shadow border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">Product Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="{{ $sale->product->image ? asset('storage/images/products/' . $sale->product->image) : 'https://via.placeholder.com/100' }}"
                                alt="{{ $sale->product->name }}" class="rounded-3 me-3"
                                style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">{{ $sale->product->name }}</h6>
                                <p class="text-muted mb-1">Category: {{ $sale->product->category->name }}</p>
                                <p class="text-primary fw-bold mb-0">Rp.
                                    {{ number_format($sale->product->price, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seller & Shipping Information -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow border-0 mb-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0 fw-bold">Seller Information</h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-2"><i
                                        class="fas fa-user me-2 text-primary"></i>{{ $sale->product->seller->user->name }}
                                </p>
                                <p class="mb-2"><i
                                        class="fas fa-envelope me-2 text-primary"></i>{{ $sale->product->seller->user->email }}
                                </p>
                                <p class="mb-0"><i
                                        class="fas fa-phone me-2 text-primary"></i>{{ $sale->product->seller->user->phone ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow border-0 mb-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0 fw-bold">Shipping Information</h5>
                            </div>
                            <div class="card-body">
                                @if ($sale->courier)
                                    <p class="mb-2"><i
                                            class="fas fa-shipping-fast me-2 text-primary"></i>{{ $sale->courier->name }}
                                    </p>
                                    <p class="mb-2"><i
                                            class="fas fa-phone me-2 text-primary"></i>{{ $sale->courier->phone }}</p>
                                    <p class="mb-2"><i
                                            class="fas fa-map-marker-alt me-2 text-primary"></i>{{ $sale->courier->address }}
                                    </p>
                                    {{-- <p class="mb-2"><i
                                            class="fas fa-barcode me-2 text-primary"></i>{{ $sale->tracking_number }}</p> --}}
                                    {{-- <p class="mb-0"><i class="fas fa-calendar me-2 text-primary"></i>Est. Delivery:
                                        {{ $sale->estimated_delivery_date->format('d M Y') }}</p> --}}
                                @else
                                    <p class="text-muted mb-0">No courier information available for canceled orders.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Font Awesome if not already included in layout -->
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @endpush
@endsection
