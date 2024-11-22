<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='products'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Products"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="d-flex justify-content-between align-items-center px-3">
                                    <h6 class="text-white text-capitalize ps-3 mb-0">Product List</h6>
                                    @if (Auth::user()->isSeller())
                                        <a href="{{ route('products.create') }}"
                                            class="btn btn-light btn-sm d-flex align-items-center">
                                            <i class="material-icons me-2">add</i>
                                            Add New Product
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Search and Filter Section -->
                        <div class="card-header pb-0">
                            <form method="GET" action="{{ route('products.index') }}" id="filterForm">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="input-group input-group-outline my-3">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Search products..." value="{{ request('search') }}"
                                                id="searchProduct">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select" name="category" id="categoryFilter">
                                            <option value="">All Categories</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">
                                                Product</th>
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                Category</th>
                                            @if (Auth::user()->isAdmin())
                                                <th
                                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Seller</th>
                                            @endif
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                Price</th>
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                Stock</th>
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-3 py-1">
                                                        <div class="me-3">
                                                            <!-- Add product image if available -->
                                                            <img src="{{ $product->image ? asset('storage/images/products/' . $product->image) : asset('images/default-product.png') }}"
                                                                class="avatar avatar-sm border-radius-lg"
                                                                alt="{{ $product->name }}">

                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $product->name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">#{{ $product->id }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge badge-sm bg-gradient-info">{{ $product->category->name }}</span>
                                                </td>
                                                @if (Auth::user()->isAdmin())
                                                    <td class="text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $product->seller->user->name }}</span>
                                                    </td>
                                                @endif
                                                <td class="text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">${{ number_format($product->price, 2) }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $product->stock }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge badge-sm bg-gradient-{{ $product->status === 'active' ? 'success' : 'danger' }}">
                                                        {{ $product->status }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('products.show', $product->id) }}"
                                                            class="btn btn-link text-info px-2 mb-0"
                                                            data-bs-toggle="tooltip" title="View Details">
                                                            <i class="material-icons text-sm">visibility</i>
                                                        </a>
                                                        @if (Auth::user()->isSeller())
                                                            <a href="{{ route('products.edit', $product->id) }}"
                                                                class="btn btn-link text-warning px-2 mb-0"
                                                                data-bs-toggle="tooltip" title="Edit Product">
                                                                <i class="material-icons text-sm">edit</i>
                                                            </a>
                                                            <form
                                                                action="{{ route('products.destroy', $product->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-link text-danger px-2 mb-0"
                                                                    data-bs-toggle="tooltip" title="Delete Product"
                                                                    onclick="return confirm('Are you sure you want to delete this product?');">
                                                                    <i class="material-icons text-sm">delete</i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ($products->isEmpty())
                                    <div class="alert alert-warning text-white text-center mx-4 mt-4">
                                        <i class="material-icons me-2">inventory_2</i>
                                        No products found.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>

<!-- Add this at the end of your layout -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Get references to the search and category elements
        const searchInput = document.getElementById('searchProduct');
        const categoryFilter = document.getElementById('categoryFilter');
        const filterForm = document.getElementById('filterForm');

        // Trigger form submission when search input changes
        searchInput.addEventListener('keyup', function() {
            filterForm.submit();
        });

        // Trigger form submission when category changes
        categoryFilter.addEventListener('change', function() {
            filterForm.submit();
        });
    });
</script>
