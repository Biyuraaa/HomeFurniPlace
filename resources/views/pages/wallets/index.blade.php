@extends('pages.components.layout')
@section('content')
    <div class="wallet-container">
        <h2>Your Wallet</h2>
        <div class="wallet-balance-section">
            <h3 class="wallet-balance">Wallet Balance: ${{ Auth::user()->wallet->balance }}</h3>
            <button class="btn btn-primary" id="depositButton">Deposit</button>
        </div>
    </div>

    <div class="transactions-container">
        <h2>Your Transactions</h2>
        <table class="transactions-table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr class="{{ $transaction->type == 'purchase' ? 'table-danger' : 'table-success' }}">
                        <td>{{ ucfirst($transaction->type) }}</td>
                        <td>${{ $transaction->amount }}</td>
                        <td>{{ $transaction->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal for Deposit -->
    <div class="modal" id="depositModal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Deposit Funds</h2>
            <form action="{{ route('wallets-users.storeDeposit', Auth::user()->wallet) }}" method="POST"
                class="deposit-form">
                @method('POST')
                @csrf
                <div class="form-group">
                    <label for="depositAmount">Amount</label>
                    <input type="number" name="balance" id="depositAmount" min="1" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Deposit</button>
            </form>
        </div>
    </div>
    <script>
        const depositButton = document.getElementById('depositButton');
        const depositModal = document.getElementById('depositModal');
        const closeModal = document.getElementById('closeModal');

        depositButton.addEventListener('click', () => {
            depositModal.style.display = 'block';
        });

        closeModal.addEventListener('click', () => {
            depositModal.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === depositModal) {
                depositModal.style.display = 'none';
            }
        });
    </script>
@endsection
