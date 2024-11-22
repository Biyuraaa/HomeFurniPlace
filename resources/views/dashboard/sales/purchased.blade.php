<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='purchased'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Sales"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Sale List</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID</th>
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                Name Produk</th>
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama Pembeli</th>
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                Quantity</th>
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                Total</th>
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                Date</th>
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales as $sale)
                                            <tr>
                                                <td class="text-center">{{ $sale->id }}</td>
                                                <td class="text-center">{{ $sale->product->name }}</td>
                                                <td class="text-center">{{ $sale->wallet->user->name }}</td>
                                                <td class="text-center">{{ $sale->quantity }}</td>
                                                <td class="text-center">${{ number_format($sale->total, 2) }}</td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge 
                                                        @if ($sale->status === 'completed') bg-success
                                                        @elseif($sale->status === 'pending') bg-warning
                                                        @elseif($sale->status === 'cancelled') bg-danger @endif">
                                                        {{ ucfirst($sale->status) }}
                                                    </span>
                                                </td>
                                                <td class="text-center">{{ $sale->created_at->format('Y-m-d') }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('sales.show', $sale->id) }}"
                                                        class="btn btn-info btn-sm">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ($sales->isEmpty())
                                    <div class="alert alert-warning text-center">No sales found.</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
