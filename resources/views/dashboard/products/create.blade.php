<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='products'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Create Product"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center pb-0">
                            <h6 class="mb-0">
                                <i class="fas fa-plus-circle me-2"></i>Create New Product
                            </h6>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-arrow-left me-2"></i>Back to Products
                            </a>
                        </div>

                        <div class="card-body px-4 pt-4">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong><i class="fas fa-exclamation-circle me-2"></i>Error!</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="seller_id" value="{{ Auth::user()->seller->id }}">

                                <div class="row">
                                    <!-- Left Column - Basic Information -->
                                    <div class="col-md-8">
                                        <div class="card shadow-none border">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Basic
                                                    Information</h6>
                                            </div>
                                            <div class="card-body">
                                                <!-- Name Input -->
                                                <div class="mb-4">
                                                    <label for="name" class="form-label">Product Name</label>
                                                    <div class="input-group input-group-outline">
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" required value="{{ old('name') }}"
                                                            placeholder="Enter product name">
                                                    </div>
                                                </div>

                                                <!-- Category & Status Row -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-4">
                                                            <label for="category_id" class="form-label">Category</label>
                                                            <select class="form-select border px-2" name="category_id"
                                                                id="category_id" required>
                                                                <option value="">Select a Category</option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}"
                                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                                        {{ $category->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-4">
                                                            <label for="status" class="form-label">Status</label>
                                                            <select class="form-select border px-2" name="status"
                                                                id="status" required>
                                                                <option value="">Select Status</option>
                                                                <option value="active"
                                                                    {{ old('status') == 'active' ? 'selected' : '' }}>
                                                                    Active</option>
                                                                <option value="inactive"
                                                                    {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                                    Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Description Textarea -->
                                                <div class="mb-4">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea name="description" class="form-control border" rows="4" id="description" required
                                                        placeholder="Enter product description">{{ old('description') }}</textarea>
                                                </div>

                                                <!-- Price & Stock Row -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-4">
                                                            <label for="price" class="form-label">Price ($)</label>
                                                            <div class="input-group input-group-outline">
                                                                <input type="number" step="0.01"
                                                                    class="form-control" id="price" name="price"
                                                                    required value="{{ old('price') }}"
                                                                    placeholder="0.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-4">
                                                            <label for="stock" class="form-label">Stock</label>
                                                            <div class="input-group input-group-outline">
                                                                <input type="number" class="form-control"
                                                                    id="stock" name="stock" required
                                                                    value="{{ old('stock') }}" placeholder="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Column - Image Upload -->
                                    <div class="col-md-4">
                                        <div class="card shadow-none border">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0"><i class="fas fa-image me-2"></i>Product Image</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mb-3">
                                                    <img id="imagePreview" src=""
                                                        class="img-fluid rounded border" alt="Product Preview">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Upload Image</label>
                                                    <input type="file" class="form-control border" name="image"
                                                        id="imageInput" accept="image/*">
                                                    <div class="form-text">
                                                        Recommended size: 800x600 pixels
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-save me-2"></i>Create Product
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview functionality
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');

        imageInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                }

                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // Form validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const price = document.getElementById('price').value;
            const stock = document.getElementById('stock').value;

            if (parseFloat(price) < 0) {
                e.preventDefault();
                alert('Price cannot be negative');
            }

            if (parseInt(stock) < 0) {
                e.preventDefault();
                alert('Stock cannot be negative');
            }
        });
    });
</script>
