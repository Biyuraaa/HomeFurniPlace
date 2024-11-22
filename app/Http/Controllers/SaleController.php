<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Courier;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::user()->role === 'admin') {
            return view('dashboard.sales.index', [
                'sales' => Sale::all()
            ]);
        } else if (Auth::user()->role === 'seller') {
            $productIds = Product::where('seller_id', Auth::user()->seller->id)->pluck('id');
            $sale = Sale::whereIn('product_id', $productIds)->paginate(10);
            return view('dashboard.sales.index', ['sales' => $sale]);
        } else {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to access this page');
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        //
        $request->validated();
        $cartItems = $request->input('cartItems');
        $quantities = $request->input('quantities');
        $userId = Auth::user()->id;


        // Retrieve the user's wallet
        $wallet = Wallet::where('user_id', $userId)->first();
        if (!$wallet) {
            return redirect()->back()->with('error', 'Wallet not found.');
        }


        try {
            $totalAmount = 0;
            foreach ($cartItems as $cartId) {
                $cart = Sale::find($cartId);
                if ($cart && $cart->wallet_id == Auth::user()->wallet->id && $cart->status == 'pending') {
                    $quantity = $quantities[$cartId] ?? 1; // Default to 1 if quantity not found
                    $totalAmount += $cart->product->price * $quantity;
                }
            }

            // Check if wallet has enough balance
            if ($wallet->balance < $totalAmount) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Insufficient balance.');
            }

            foreach ($cartItems as $cartId) {
                $cart = Sale::find($cartId);
                if ($cart && $cart->wallet->id == Auth::user()->wallet->id && $cart->status == 'pending') {
                    $quantity = $quantities[$cartId] ?? 1; // Default to 1 if quantity not found
                    $cart->update([
                        'status' => 'purchased',
                        'quantity' => $quantity,
                    ]);
                    // Create a new transaction for each sale
                    Transaction::create([
                        'wallet_id' => $wallet->id,
                        'sale_id' => $cart->id,
                        'type' => 'purchase',
                        'amount' => $cart->product->price * $quantity,
                    ]);
                }
            }

            // Deduct the total amount from the wallet
            $wallet->balance -= $totalAmount;
            $wallet->save();
            //menampilkan log
            Log::info('Checkout successful', ['user_id' => $userId, 'total_amount' => $totalAmount]);
            DB::commit();
            return redirect()->route('carts.index')->with('success', 'Checkout successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Checkout failed. Please try again.');
        }
    }

    public function confirm(Request $request, $saleId)
    {
        $sale = Sale::findOrFail($saleId);
        $courierId = $request->input('courier_id');

        // Mengubah status pesanan menjadi "confirmed" dan memilih kurir
        $sale->status = 'shipped';
        $sale->courier_id = $courierId;
        $sale->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('sales.show', $sale->id)->with('success', 'Order confirmed and courier assigned.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //

        $couriers = Courier::all();
        return view('dashboard.sales.show', [
            'sale' => $sale,
            'couriers' => $couriers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function showPurchased()
    {
        // Retrieve the current user
        $user = Auth::user();

        // Get the orders where status is 'purchased', 'shipped', or 'delivered'
        $sales = Sale::where('wallet_id', $user->wallet->id) // Ensure the order belongs to the authenticated user
            ->whereIn('status', ['purchased', 'shipped', 'delivered', 'canceled']) // Filter by status
            ->get(); // Retrieve the data

        // Pass the sales data to the view
        return view('pages.sales.showPurchased', compact('sales'));
    }

    public function cancel(Sale $sale)
    {
        // Check if the user is the seller or the buyer involved in the sale
        if (Auth::user()->role === 'seller' && $sale->product->seller_id === Auth::user()->id) {
            $buyerWallet = $sale->wallet->user->wallet; // Assuming wallet is a relation to the user
            $buyerWallet->balance += $sale->product->price * $sale->quantity; // Add the sale amount to the buyer's wallet
            $buyerWallet->save();

            $sale->status = 'canceled';
            $sale->save();

            return redirect()->route('sales.index')->with('success', 'Order canceled successfully, buyer has been refunded.');
        } elseif ($sale->wallet->user_id === Auth::user()->id) {
            // Buyer is canceling the order - refund the buyer's money
            $buyerWallet = $sale->wallet->user->wallet; // Assuming wallet is a relation to the user
            $buyerWallet->balance += $sale->product->price * $sale->quantity; // Add the sale amount to the buyer's wallet
            $buyerWallet->save();

            $sale->status = 'canceled';
            $sale->save();

            return redirect()->route('sales.purchased')->with('success', 'Order canceled successfully, your money has been refunded.');
        } else {
            return redirect()->route('sales.index')->with('error', 'You are not authorized to cancel this order');
        }
    }

    public function viewDetail($id)
    {
        $sale = Sale::findOrFail($id);
        return view('pages.sales.viewDetails', compact('sale'));
    }

    public function confirmDelivery($id)
    {
        // Find the sale by ID
        $sale = Sale::findOrFail($id);

        // Ensure the sale is eligible for confirmation (i.e., it should be in 'shipped' status)
        if ($sale->status !== 'shipped') {
            return redirect()->back()->with('error', 'The order cannot be confirmed at this stage.');
        }

        // Begin transaction to ensure data consistency
        DB::beginTransaction();

        try {
            // Update sale status to 'delivered'
            $sale->status = 'delivered';
            $sale->save();

            // Update product stock
            $product = $sale->product;
            $product->stock -= $sale->quantity;
            $product->save();

            // Calculate payment with 5% tax
            $totalAmount = $sale->quantity * $product->price;
            $tax = $totalAmount * 0.05;
            $sellerAmount = $totalAmount - $tax;

            // Update seller's wallet
            $seller = $product->seller->user;
            $seller->wallet->balance += $sellerAmount;
            $seller->wallet->save();

            // Update admin's wallet with tax amount
            $admin = User::where('role', 'admin')->first();
            if ($admin) {
                $admin->wallet->balance += $tax;
                $admin->save();
            }

            // Commit the transaction
            DB::commit();

            return redirect()->back()->with('success', 'Order confirmed and seller wallet updated successfully.');
        } catch (\Exception $e) {
            // Rollback transaction if any error occurs
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while confirming the delivery: ' . $e->getMessage());
        }
    }
}
