<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='products'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Product Details"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center pb-0">
                            <h6 class="mb-0">
                                <i class="fas fa-box me-2"></i>Product Details
                            </h6>
                            <div>
                                <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-arrow-left me-1"></i>Back
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="row">
                                <!-- Product Image Column -->
                                <div class="col-md-4">
                                    <div class="product-image-container border rounded p-2 bg-light text-center mb-3">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/images/products/' . $product->image) }}"
                                                class="img-fluid rounded" alt="{{ $product->name }}"
                                                style="max-height: 300px; width: 100%; object-fit: contain;">
                                        @else
                                            <div class="py-5">
                                                <i class="fas fa-image fa-4x text-muted"></i>
                                                <p class="mt-3 text-muted">No image available</p>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Product Status Card -->
                                    <div class="card border shadow-none">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="text-muted">Status</span>
                                                <span
                                                    class="badge {{ $product->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ ucfirst($product->status) }}
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="text-muted">Stock</span>
                                                <span
                                                    class="badge {{ $product->stock > 0 ? 'bg-info' : 'bg-warning' }}">
                                                    {{ $product->stock }} units
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted">Price</span>
                                                <span class="text-primary fw-bold">
                                                    ${{ number_format($product->price, 2) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product Details Column -->
                                <div class="col-md-8">
                                    <div class="card border shadow-none h-100">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0">{{ $product->name }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <!-- Product Category -->
                                            <div class="mb-4">
                                                <span class="badge bg-primary">
                                                    <i class="fas fa-tag me-1"></i>
                                                    {{ $product->category->name }}
                                                </span>
                                            </div>

                                            <!-- Product Description -->
                                            <div class="mb-4">
                                                <h6 class="text-uppercase text-muted mb-2">Description</h6>
                                                <p class="text-muted">{{ $product->description }}</p>
                                            </div>

                                            <!-- Additional Product Details -->
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="card bg-light">
                                                        <div class="card-body py-2">
                                                            <small class="text-muted d-block">Created</small>
                                                            <span>{{ $product->created_at->format('M d, Y') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card bg-light">
                                                        <div class="card-body py-2">
                                                            <small class="text-muted d-block">Last Updated</small>
                                                            <span>{{ $product->updated_at->format('M d, Y') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Seller Information (Admin Only) -->
                                            @if (auth()->user()->role === 'admin')
                                                <div class="mt-4">
                                                    <h6 class="text-uppercase text-muted mb-3">
                                                        <i class="fas fa-user me-2"></i>Seller Information
                                                    </h6>
                                                    <div class="card border">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <p class="mb-2">
                                                                        <strong>Name:</strong><br>
                                                                        {{ $product->seller->user->name }}
                                                                    </p>
                                                                    <p class="mb-2">
                                                                        <strong>Email:</strong><br>
                                                                        {{ $product->seller->user->email }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p class="mb-2">
                                                                        <strong>Phone:</strong><br>
                                                                        {{ $product->seller->user->phone ?? 'N/A' }}
                                                                    </p>
                                                                    <p class="mb-2">
                                                                        <strong>Address:</strong><br>
                                                                        {{ $product->seller->user->address ?? 'N/A' }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
