@extends('pages.components.layout')

@section('content')
    <div class="container mt-5">
        <h3 class="mb-4 text-center text-primary">Your Purchased Items</h3>
        <div class="row">
            @forelse ($sales as $sale)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0">
                        <img src="{{ $sale->product->image ? asset('storage/images/products/' . $sale->product->image) : 'https://via.placeholder.com/300' }}"
                            alt="{{ $sale->product->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $sale->product->name }}</h5>
                            <p class="card-text">Status:
                                <span
                                    class="badge 
                                    @if ($sale->status == 'purchased') bg-info 
                                    @elseif($sale->status == 'shipped') bg-warning 
                                    @elseif($sale->status == 'delivered') bg-success
                                    @else bg-danger @endif">
                                    {{ ucfirst($sale->status) }}
                                </span>
                            </p>
                            <p class="card-text">Price: Rp. {{ number_format($sale->product->price, 2, ',', '.') }}</p>
                            <p class="card-text">Quantity: {{ $sale->quantity }}</p>
                            <p class="card-text">Order Date: {{ $sale->created_at->format('d M Y') }}</p>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('sales.view', $sale->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye"></i> View Details
                                </a>

                                @if ($sale->status == 'purchased')
                                    <form action="{{ route('sales.cancel', $sale) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-times"></i> Cancel
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No purchased items found.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
