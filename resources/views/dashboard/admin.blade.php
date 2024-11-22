<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <!-- Today's Sales -->
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-header p-3 d-flex align-items-center">
                            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 me-3">
                                <i class="material-icons opacity-10">weekend</i>
                            </div>
                            <div class="text-end">
                                <p class="text-sm mb-0 text-capitalize">Today's Sales</p>
                                <h4 class="mb-0">${{ number_format($todaySales, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-header p-3 d-flex align-items-center">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 me-3">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <div class="text-end">
                                <p class="text-sm mb-0 text-capitalize">Total Users</p>
                                <h4 class="mb-0">{{ $totalUsers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- New Clients -->
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-header p-3 d-flex align-items-center">
                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 me-3">
                                <i class="material-icons opacity-10">person_add</i>
                            </div>
                            <div class="text-end">
                                <p class="text-sm mb-0 text-capitalize">New Clients</p>
                                <h4 class="mb-0">{{ $newClients }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Sales -->
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-header p-3 d-flex align-items-center">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 me-3">
                                <i class="material-icons opacity-10">monetization_on</i>
                            </div>
                            <div class="text-end">
                                <p class="text-sm mb-0 text-capitalize">Total Sales</p>
                                <h4 class="mb-0">${{ number_format($totalSales, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Sales Chart -->
            <div class="row mt-4">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Monthly Sales Chart</h5>
                            <canvas width="400" height="400" id="monthlySalesChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Sales by Status -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sales by Status</h5>
                            <canvas width="300" height="300" id="salesByStatusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Selling Products and New Registrations -->
            <div class="row mt-4">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Top Selling Products</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Total Sales</th>
                                        <th>Total Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topSellingProducts as $product)
                                        <tr>
                                            <td>{{ $product->product_id }}</td>
                                            <td>{{ $product->total_sales }}</td>
                                            <td>${{ number_format($product->total_revenue, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">New Registrations</h5>
                            <canvas id="newRegistrationsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users by Role -->
            <div class="row mt-4">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Users by Role</h5>
                            <canvas id="usersByRoleChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Top Buyers</h5>
                            <table class="table table-hover text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Username</th>
                                        <th scope="col">Purchase Frequency</th>
                                        <th scope="col">Total Spent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topBuyers as $buyer)
                                        <tr>
                                            <td>{{ $buyer->wallet->user->name ?? 'N/A' }}</td>
                                            <td>{{ $buyer->purchase_frequency }}</td>
                                            <td>${{ number_format($buyer->total_spent, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="row mt-4">
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Recent Orders</h5>
                            <table class="table table-hover text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentOrders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->product->name }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>${{ number_format($order->total, 2) }}</td>
                                            <td>{{ $order->created_at->format('d F Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Monthly Sales Chart
        const monthlySalesData = @json($monthlySales);
        const monthlyLabels = monthlySalesData.map(sale => sale.month);
        const monthlySales = monthlySalesData.map(sale => sale.total_sales);
        const monthlyRevenue = monthlySalesData.map(sale => sale.total_revenue);

        const ctxMonthly = document.getElementById('monthlySalesChart').getContext('2d');
        new Chart(ctxMonthly, {
            type: 'bar',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Total Sales',
                    data: monthlySales,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                },
                {
                    label: 'Total Revenue',
                    data: monthlyRevenue,
                    backgroundColor: 'rgba(255, 206, 86, 0.6)',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });

        // Sales by Status Chart
        const salesStatusData = @json($salesByStatus);
        const salesStatusLabels = salesStatusData.map(status => status.status);
        const salesStatusCounts = salesStatusData.map(status => status.count);

        const ctxStatus = document.getElementById('salesByStatusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'pie',
            data: {
                labels: salesStatusLabels,
                datasets: [{
                    data: salesStatusCounts,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                }]
            },
            options: {
                responsive: true,
            }
        });

        // New Registrations Chart
        const registrationsData = @json($newRegistrations);
        const registrationsLabels = registrationsData.map(reg => reg.date);
        const registrationsCounts = registrationsData.map(reg => reg.count);

        const ctxRegistrations = document.getElementById('newRegistrationsChart').getContext('2d');
        new Chart(ctxRegistrations, {
            type: 'line',
            data: {
                labels: registrationsLabels,
                datasets: [{
                    label: 'New Registrations',
                    data: registrationsCounts,
                    borderColor: '#4BC0C0',
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });

        // Users by Role Chart
        const usersRoleData = @json($usersByRole);
        const roleLabels = usersRoleData.map(role => role.role);
        const roleCounts = usersRoleData.map(role => role.count);

        const ctxRole = document.getElementById('usersByRoleChart').getContext('2d');
        new Chart(ctxRole, {
            type: 'bar',
            data: {
                labels: roleLabels,
                datasets: [{
                    label: 'Users by Role',
                    data: roleCounts,
                    backgroundColor: '#FF6384',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
    </script>
</x-layout>
