@extends('layouts.app')
@section('content')
    <div class="min-h-screen bg-gradient-to-b from-[#F5E6D3] to-[#E2D4C3] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Wallet Card -->
            <div class="bg-gradient-to-r from-[#8B4513] to-[#D2691E] rounded-3xl shadow-2xl overflow-hidden mb-8">
                <div class="px-8 py-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[#F4D03F] text-sm font-medium tracking-wide">Furniture Wallet Balance</p>
                            <h2 class="text-white text-4xl font-bold mt-2 font-serif">
                                ${{ number_format(Auth::user()->wallet->balance, 2) }}</h2>
                        </div>
                        <button id="depositButton"
                            class="px-6 py-3 bg-[#F5DEB3] text-[#8B4513] rounded-xl font-semibold 
                               hover:bg-[#DEB887] transform transition-all duration-200 hover:scale-105 
                               focus:outline-none focus:ring-2 focus:ring-[#D2691E] focus:ring-offset-2">
                            + Add Funds
                        </button>
                    </div>
                </div>
            </div>

            <!-- Transactions Section -->
            <div class="bg-white rounded-2xl shadow-md border border-[#D2B48C] overflow-hidden">
                <div class="px-6 py-4 border-b border-[#D2B48C]">
                    <h3 class="text-lg font-semibold text-[#8B4513]">Transaction History</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#D2B48C]">
                        <thead class="bg-[#F5DEB3]">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#8B4513] uppercase tracking-wider">
                                    Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#8B4513] uppercase tracking-wider">
                                    Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#8B4513] uppercase tracking-wider">
                                    Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#D2B48C]">
                            @foreach ($transactions as $transaction)
                                <tr class="hover:bg-[#FFF8DC] transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $transaction->type == 'purchase' ? 'bg-[#FFDAB9] text-[#8B4513]' : 'bg-[#E6F3E6] text-[#2E8B57]' }}">
                                            {{ ucfirst($transaction->type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#8B4513]">
                                        ${{ number_format($transaction->amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#A0522D]">
                                        {{ $transaction->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Deposit Modal -->
        <div id="depositModal" class="fixed inset-0 bg-[#8B4513] bg-opacity-75 hidden transition-opacity">
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="relative transform overflow-hidden rounded-2xl bg-[#F5DEB3] px-4 pt-5 pb-4 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                        <div class="absolute top-0 right-0 pt-4 pr-4">
                            <button id="closeModal" type="button" class="text-[#8B4513] hover:text-[#D2691E]">
                                <span class="sr-only">Close</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="text-center">
                            <h3 class="text-2xl font-semibold text-[#8B4513] mb-6">Add Funds to Wallet</h3>
                            <form action="{{ route('wallets-users.storeDeposit', Auth::user()->wallet) }}" method="POST"
                                class="mt-3">
                                @csrf
                                @method('POST')
                                <div class="mb-6">
                                    <label for="depositAmount" class="block text-sm font-medium text-[#8B4513] mb-2">Amount
                                        ($)</label>
                                    <input type="number" name="balance" id="depositAmount" min="1"
                                        class="block w-full rounded-xl border-[#D2B48C] shadow-sm focus:border-[#8B4513] focus:ring-[#8B4513]"
                                        required>
                                </div>
                                <button type="submit"
                                    class="w-full py-3 px-4 rounded-xl bg-[#8B4513] text-[#F5DEB3] font-medium hover:bg-[#D2691E] 
                                       focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#A0522D] 
                                       transition-colors duration-200">
                                    Confirm Deposit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const depositButton = document.getElementById('depositButton');
            const depositModal = document.getElementById('depositModal');
            const closeModal = document.getElementById('closeModal');

            depositButton.addEventListener('click', () => {
                depositModal.classList.remove('hidden');
            });

            closeModal.addEventListener('click', () => {
                depositModal.classList.add('hidden');
            });

            window.addEventListener('click', (event) => {
                if (event.target === depositModal) {
                    depositModal.classList.add('hidden');
                }
            });
        </script>
    </div>
@endsection
