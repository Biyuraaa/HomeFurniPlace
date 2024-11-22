<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Product;
use App\Models\User;
use App\Models\Sale;
use App\Models\Category;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->role === 'seller') {
            return view('dashboard.index');
        } elseif (Auth::user()->role === 'admin') {
            $todaySales = Sale::whereDate('created_at', Carbon::today())->sum('total');
            $totalUsers = User::count();
            $newClients = User::whereDate('created_at', Carbon::today())->count();
            $totalSales = Sale::sum('total');

            // Monthly Sales
            $monthlySales = Sale::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total_sales, SUM(total) as total_revenue')
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            // Sales by Status
            $salesByStatus = Sale::selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->get();

            // Top Selling Products
            $topSellingProducts = Sale::select('product_id')
                ->selectRaw('COUNT(*) as total_sales, SUM(total) as total_revenue')
                ->groupBy('product_id')
                ->orderBy('total_sales', 'desc')
                ->take(5)
                ->get();

            // New Registrations
            $newRegistrations = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d") as date, COUNT(*) as total')
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            // Users by Role
            $usersByRole = User::selectRaw('role, COUNT(*) as count')
                ->groupBy('role')
                ->get();

            // Top Buyers
            $topBuyers = Sale::with('wallet.user') // Eager load the relationships
                ->select('wallet_id')
                ->selectRaw('COUNT(*) as purchase_frequency, SUM(total) as total_spent')
                ->groupBy('wallet_id')
                ->orderBy('total_spent', 'desc')
                ->take(5)
                ->get();

            // Recent Orders
            $recentOrders = Sale::orderBy('created_at', 'desc')->take(5)->get();

            return view('dashboard.index', compact(
                'todaySales',
                'totalUsers',
                'newClients',
                'totalSales',
                'monthlySales',
                'salesByStatus',
                'topSellingProducts',
                'newRegistrations',
                'usersByRole',
                'topBuyers',
                'recentOrders'
            ));
        } else {
            return view('welcome', ['products' => Product::all(), 'users' => User::all(), 'categories' => Category::all()]);
        }
    }
}
