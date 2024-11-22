<!-- resources/views/dashboard/wallets/index.blade.php -->

<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='wallets'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Wallets"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>My Wallet</h6>
                            <!-- Trigger for the deposit modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#depositModal">Deposit</button>
                        </div>
                        <div class="card-body px-4 pt-3 pb-2">
                            <h5>Balance: ${{ number_format($wallet->balance, 2) }}</h5>
                            @if ($last_transactions === null)
                                <h5>No Transaction History</h5>
                            @else
                                <h5>Last Transaction: {{ $last_transactions->created_at->format('Y-m-d') }}</h5>
                            @endif
                            
                            <h5 class="mt-4">Transaction History:</h5>
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transactions as $transaction)
                                            <tr>
                                                <td class="text-center">{{ $transaction->created_at->format('d M Y H:i') }}</td>
                                                <td class="text-center">{{ ucfirst($transaction->type) }}</td>
                                                <td class="text-center {{ $transaction->type == 'deposit' ? 'text-success' : 'text-danger' }}">
                                                    ${{ number_format($transaction->amount, 2) }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No transactions available.</td>
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

        <!-- Deposit Modal -->
        <div class="modal fade" id="depositModal" tabindex="-1" aria-labelledby="depositModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="depositModalLabel">Deposit Funds</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('wallets.storeDeposit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="balance" class="form-label">Amount to Deposit</label>
                                <input type="number" class="form-control" id="balance" name="balance" min="0.01" step="0.01" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Confirm Deposit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
