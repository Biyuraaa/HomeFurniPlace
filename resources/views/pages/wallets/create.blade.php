@extends('pages.components.layout')
@section('content')
    <div class="create-wallet-container">
        <h2>Create Wallet</h2>
        <form action="{{ route('wallets-users.store') }}" method="POST" class="create-wallet-form">
            @method('POST')
            @csrf
            <div class="form-group">
                <label for="balance">Initial Balance</label>
                <input type="number" name="balance" id="balance" value="{{ old('balance') ?? 0 }}" class="form-control"
                    required>
            </div>
            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create Wallet</button>
                <a href="{{ route('profile-user.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
