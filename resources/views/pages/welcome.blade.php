@extends('pages.components.layout')

@section('content')
    <!-- Hero Section -->
    <section class="hero bg-light py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                    <h1 class="display-4 fw-bold mb-4">A Furniture that eases your life</h1>
                    <p class="lead text-muted mb-4">Explore world-class top furniture as per your requirements and choice</p>
                    <a href="{{ route('products') }}" class="btn btn-dark btn-lg rounded-pill">
                        Shop now <i class="fas fa-chevron-right ms-2"></i>
                    </a>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                    <img src="{{ asset('assets/img/furniture_front.jpg') }}" alt="Hero Furniture"
                        class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- New Products Section -->
    <section class="new-products py-5">
        <div class="container-fluid px-4">
            <!-- Section Header -->
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <span class="text-primary fw-semibold text-uppercase" data-aos="fade-up">Our Collection</span>
                    <h2 class="display-4 fw-bold mt-2" data-aos="fade-up" data-aos-delay="100">New Products</h2>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row gx-4">
                <!-- Main Slider -->
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <div class="swiper main-swiper">
                        <div class="swiper-wrapper">
                            @foreach ($newProducts as $product)
                                <div class="swiper-slide">
                                    <div class="card product-card border-0 h-100">
                                        <a href="{{ route('product', $product->id) }}" class="text-decoration-none">
                                            <div class="position-relative overflow-hidden">
                                                @if ($product->image)
                                                    <img src="{{ asset('storage/images/products/' . $product->image) }}"
                                                        class="main-product-img" alt="{{ $product->name }}">
                                                @else
                                                    <img src="{{ asset('assets/img/chair.avif') }}" class="main-product-img"
                                                        alt="{{ $product->name }}">
                                                @endif
                                                <div class="product-overlay">
                                                    <div class="text-center" data-aos="fade-up" data-aos-duration="700">
                                                        <h3 class="product-title fw-bold mb-2">{{ $product->name }}</h3>
                                                        <p class="product-price fw-semibold mb-2">${{ $product->price }}</p>
                                                        <p class="product-desc">{{ $product->description }}</p>
                                                        <button class="btn btn-light rounded-pill mt-3">View
                                                            Details</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <!-- Side Grid -->
                <div class="col-lg-5">
                    <div class="row g-4">
                        @foreach ($newProducts->take(4) as $product)
                            <div class="col-6">
                                <div class="card grid-card border-0 h-100">
                                    <a href="{{ route('product', $product->id) }}" class="text-decoration-none">
                                        <div class="position-relative overflow-hidden">
                                            @if ($product->image)
                                                <img src="{{ asset('storage/images/products/' . $product->image) }}"
                                                    class="grid-product-img" alt="{{ $product->name }}">
                                            @else
                                                <img src="{{ asset('assets/img/chair.avif') }}" class="grid-product-img"
                                                    alt="{{ $product->name }}">
                                            @endif
                                            <div class="grid-overlay">
                                                <div class="text-center">
                                                    <h4 class="fw-bold mb-2">{{ $product->name }}</h4>
                                                    <p class="mb-0">${{ $product->price }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sale Section -->
    <section class="sale-section py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <span class="badge bg-danger px-3 py-2 mb-3">Mega Sale up to 75%</span>
                    <h2 class="display-5 fw-bold mb-4">Fancy Sofa Set</h2>
                    <p class="text-muted mb-4">This beautiful sofa set is the perfect addition to any living room. The plush
                        cushions and comfortable design will make you want to curl up and relax for hours on end.</p>

                    <div class="low-stock-products mb-4">
                        @foreach ($lowStockProducts as $product)
                            <a href="{{ route('product', ['id' => $product->id]) }}" class="text-decoration-none">
                                <div class="card sale-product-card mb-3" data-aos="fade-up" data-aos-delay="100">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-4">
                                            <img src="{{ $product->image ? asset('storage/images/products/' . $product->image) : asset('assets/img/marigold sofa.jpg') }}"
                                                class="sale-product-img" alt="{{ $product->name }}">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <h5 class="card-title fw-bold mb-2">{{ $product->name }}</h5>
                                                <p class="card-text fw-semibold text-primary mb-0">${{ $product->price }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="text-center text-lg-start">
                        <a href="{{ route('products') }}" class="btn btn-dark btn-lg rounded-pill" data-aos="fade-up">
                            Explore Collection <i class="fas fa-chevron-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <img src="{{ asset('assets/img/marigold sofa.jpg') }}" alt="Sale Sofa"
                        class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Enhanced Custom Styles */
        .hero {
            background: linear-gradient(to right, #f8f9fa 0%, #e9ecef 100%);
        }

        .product-card {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .main-product-img {
            height: 600px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .grid-product-img {
            height: 290px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .sale-product-img {
            height: 120px;
            width: 100%;
            object-fit: cover;
            border-radius: 0.5rem;
        }

        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .grid-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .product-card:hover .product-overlay,
        .grid-card:hover .grid-overlay {
            opacity: 1;
        }

        .product-card:hover img,
        .grid-card:hover img {
            transform: scale(1.05);
        }

        .sale-product-card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .sale-product-card:hover {
            transform: translateY(-5px);
        }

        .product-title {
            font-size: 2rem;
            color: #333;
        }

        .product-price {
            font-size: 1.5rem;
            color: #0d6efd;
        }

        .product-desc {
            color: #6c757d;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .main-product-img {
                height: 500px;
            }

            .grid-product-img {
                height: 250px;
            }

            .product-title {
                font-size: 1.5rem;
            }

            .product-price {
                font-size: 1.25rem;
            }
        }

        @media (max-width: 768px) {
            .main-product-img {
                height: 400px;
            }

            .grid-product-img {
                height: 200px;
            }

            .product-title {
                font-size: 1.25rem;
            }

            .product-price {
                font-size: 1rem;
            }
        }
    </style>
@endsection
