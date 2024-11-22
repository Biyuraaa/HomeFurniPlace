@extends('pages.components.layout')
@section('content')
    <h1 class="current-best-selling-products-h1">Current Best Selling Products</h1>
    <div class="current-best-selling-products">
        @foreach ($topProducts as $product)
            <a href="{{ route('product', ['id' => $product->id]) }}" style="text-decoration: none">
                <div class="current-best-selling-product" data-aos="fade-up" data-aos-duration="700">
                    <!-- Dynamic Product Image -->
                    @if ($product->image)
                        <img src="{{ asset('storage/images/product' . $product->iimage) }}" alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('assets/img/marigold sofa.jpg') }}" alt="">
                    @endif

                    <div class="current-best-selling-products-description">
                        <!-- Product Name -->
                        <h2 style="color: black">{{ $product->name }}</h2>

                        <p style="margin-top: -10px;color: black;">{{ number_format($product->rating, 1) }}
                            ({{ $product->review_count }} Reviews)
                        </p>
                        <!-- Product Price -->
                        <h3 style="font-family: 'Poppins'; color: black;">{{ number_format($product->price, 2) }}
                            <span>USD</span>
                        </h3>
                    </div>
                </div>
            </a>
        @endforeach

    </div>
    <div class="living-room-products">
        @foreach ($products as $product)
            <a href="{{ route('product', ['id' => $product->id]) }}" style="text-decoration: none">
                <div class="product">
                    @if ($product->image)
                        <img src="{{ asset('storage/images/product' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('assets/img/side table.jpg') }}" alt="">
                    @endif
                    <div class="product-description"
                        style="display: flex;flex-direction: column;align-items: center;justify-content: center;">
                        <h2 style="color: black;">{{ $product->name }}</h2>
                        <p style="margin-top: -10px;color: black;">{{ number_format($product->rating, 1) }}
                            ({{ $product->review_count }} Reviews)
                        </p>
                        <h3 style="font-family: 'Poppins';color: black;">{{ number_format($product->price, 2) }}
                            <span>USD</span>
                        </h3>
                    </div>
                </div>
            </a>
        @endforeach

    </div>
    <div class="count-container">
        <p style="border:1px solid;border-radius: 50%;padding:7px 15px;">1</p>
        <p>2</p>
        <p>3</p>
        <p>.</p>
        <p>.</p>
        <p>.</p>
        <p>9</p>
        <i class="fa-solid fa-chevron-right"></i>
    </div>
@endsection
