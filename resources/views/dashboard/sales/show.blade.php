<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='sales'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Sales"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Sales Detail</h6>
                            <a href="{{ route('sales.index') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-arrow-left me-2"></i>Back to Sales
                            </a>
                        </div>

                        <div class="card-body">
                            <!-- Product Information Section -->
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    @if ($sale->product->image)
                                        <div class="product-image-container border rounded p-2 mb-3">
                                            <img src="{{ asset('storage/images/products/' . $sale->product->image) }}"
                                                alt="{{ $sale->product->name }}" class="img-fluid rounded"
                                                style="max-height: 300px; width: 100%; object-fit: contain;">
                                        </div>
                                    @else
                                        <div class="border rounded p-3 text-center bg-light">
                                            <i class="fas fa-image fa-3x text-muted"></i>
                                            <p class="mt-2 mb-0">No image available</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-8">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title border-bottom pb-2">Product Details</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><strong>Name:</strong> {{ $sale->product->name }}</p>
                                                    <p><strong>Category:</strong> {{ $sale->product->category->name }}
                                                    </p>
                                                    <p><strong>Price:</strong>
                                                        ${{ number_format($sale->product->price, 2) }}</p>
                                                    <p><strong>Quantity:</strong> {{ $sale->quantity }}</p>
                                                    <p><strong>Total:</strong>
                                                        ${{ number_format($sale->quantity * $sale->product->price, 2) }}
                                                    </p>
                                                    <p><strong>Status:</strong>
                                                        <span
                                                            class="badge 
                                                            @if ($sale->status === 'purchased') bg-success
                                                            @elseif($sale->status === 'pending') bg-warning
                                                            @elseif($sale->status === 'canceled') bg-danger
                                                            @elseif($sale->status === 'shipped') bg-info @endif">
                                                            {{ ucfirst($sale->status) }}
                                                        </span>
                                                    </p>
                                                    @if ($sale->status === 'shipped')
                                                        <p><strong>Courier:</strong> {{ $sale->courier->name }}</p>
                                                        <p><strong>Phone:</strong> {{ $sale->courier->phone }}</p>
                                                        <p><strong>Address:</strong> {{ $sale->courier->address }}
                                                        </p>
                                                        <p><strong>Shipped At:</strong>
                                                            {{ $sale->courier->created_at->format('d F Y H:i') }}</p>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Description:</strong></p>
                                                    <p class="text-muted">{{ $sale->product->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Konfirmasi Pemesanan (Jika Status "Purchased") -->
                            @if ($sale->status === 'purchased')
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#courierModal">
                                        Confirm Order & Select Courier
                                    </button>
                                </div>
                            @endif

                            <!-- Modal untuk Memilih Kurir -->
                            <div class="modal fade" id="courierModal" tabindex="-1" aria-labelledby="courierModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="courierModalLabel">Select Courier</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('sales.confirm', $sale->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <div class="mb-3">
                                                    <label for="courier_id" class="form-label">Select Courier</label>
                                                    <select name="courier_id" id="courier_id" class="form-select"
                                                        required>
                                                        @foreach ($couriers as $courier)
                                                            <option value="{{ $courier->id }}">{{ $courier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Confirm &
                                                        Ship</button>
                                                </div>
                                            </form>
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
