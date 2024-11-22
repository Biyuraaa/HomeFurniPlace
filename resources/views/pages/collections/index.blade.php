@extends('pages.components.layout')

@section('content')
    <div class="container mt-5">
        <h2>Your Purchased Items</h2>

        @if ($purchasedItems->isEmpty())
            <div class="alert alert-info">You have not purchased any items yet.</div>
        @else
            <div class="list-group mb-3">
                @foreach ($purchasedItems as $item)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            @if ($item->product->image)
                                <img src="{{ asset('storage/images/product/' . $item->product->image) }}"
                                    alt="{{ $item->product->name }}" width="50" height="50" class="me-2">
                            @else
                                <img src="https://via.placeholder.com/150" alt="{{ $item->product->name }}" width="50"
                                    height="50" class="me-2">
                            @endif
                            <div>
                                <strong>{{ $item->product->name }}</strong>
                                <div>Price: Rp. <span class="product-price">{{ $item->product->price }}</span></div>
                                <div>Quantity: {{ $item->quantity }}</div>
                            </div>
                        </div>
                        <span class="text-muted">Total: Rp. {{ $item->quantity * $item->product->price }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
