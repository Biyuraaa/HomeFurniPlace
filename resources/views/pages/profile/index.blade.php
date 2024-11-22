@extends('pages.components.layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <!-- Profile Image with Placeholder Icon -->
                            <div class="me-3">
                                @if (Auth::user()->image)
                                    <img src="{{ asset('storage/images/users/' . Auth::user()->image) }}" alt="Profile Image"
                                        class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center"
                                        style="width: 80px; height: 80px;">
                                        <i class="fas fa-user text-white" style="font-size: 40px;"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- User Information Summary -->
                            <div>
                                <h5 class="mb-0">{{ Auth::user()->username }}</h5>
                                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <!-- User Details -->
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                                <p><strong>Address:</strong> {{ Auth::user()->address ?? '-' }}</p>
                                <p><strong>Phone Number:</strong> {{ Auth::user()->phone ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Date of Birth:</strong> {{ Auth::user()->date_of_birth ?? '-' }}</p>
                                <p><strong>Wallet Balance:</strong>
                                    ${{ number_format(Auth::user()->wallet->balance ?? 0, 2) }}</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary me-2">
                                <i class="fas fa-edit me-1"></i> Edit Profile
                            </a>
                            @if (Auth::user()->wallet)
                                <a href="{{ route('wallets.index', Auth::user()->wallet) }}" class="btn btn-secondary">
                                    <i class="fas fa-wallet me-1"></i> View Wallet
                                </a>
                            @else
                                <a href="{{ route('wallets.create') }}" class="btn btn-secondary">
                                    <i class="fas fa-wallet me-1"></i> Create Wallet
                                </a>
                            @endif

                            <!-- View Purchased Items Button -->
                            <a href="{{ route('sales.purchased') }}" class="btn btn-info ms-2">
                                <i class="fas fa-box-open me-1"></i> View Purchased Items
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
