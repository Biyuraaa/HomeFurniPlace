<!-- resources/views/sellers/show.blade.php -->

<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='sellers'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Seller Detail"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Seller Information</h6>
                            <a href="{{ route('sellers.index') }}" class="btn btn-primary btn-sm">Back</a>
                        </div>
                        <div class="card-body px-3 pt-3 pb-2">
                            <div class="mb-3">
                              @if ($seller->user->image)
                              <strong>Image:</strong>
                                    <img src="{{ asset('storage/users/' . $seller->user->image) }}" alt="{{ $seller->user->name }}" class="img-fluid">
                                @else
                                <strong>Image:</strong> No image available
                                @endif

                                <h5>Name: {{ $seller->user->name }}</h5>
                                <p>Email: {{ $seller->user->email }}</p>
                                <p>Phone: {{ $seller->user->phone }}</p>
                                <p>Address: {{ $seller->user->address }}</p>
                                <p>Date of Birth: {{ optional($seller->user->date_of_birth)->format('Y-m-d') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Products</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Product ID</th>
                                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Product Name</th>
                                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Stock</th>
                                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Sales Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($seller->products as $product)
                                            <tr>
                                                <td class="text-center">{{ $product->id }}</td>
                                                <td class="text-center">{{ $product->name }}</td>
                                                <td class="text-center">{{ number_format($product->price, 2) }}</td>
                                                <td class="text-center">{{ $product->stock }}</td>
                                                <td class="text-center">{{ $product->sales->sum('quantity') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No products found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</x-layout>
