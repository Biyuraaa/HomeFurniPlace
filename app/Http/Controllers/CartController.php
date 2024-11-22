<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        $wallet_id = Auth::user()->wallet->id;
        $carts = Sale::where('wallet_id', $wallet_id)
            ->where('status', 'pending')
            ->get();
        return view('pages.carts.index', compact('carts', 'categories'));
    }


    public function store(Request $request)
    {
        //

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);


        if (Auth::user()->wallet) {
            $wallet_id = Auth::user()->wallet->id;
            $product = Product::find($request->product_id);
            $quantity = $request->quantity;

            // Check if the sale already exists
            $sale = Sale::where([
                [
                    'wallet_id',
                    '=',
                    $wallet_id
                ],
                [
                    'product_id',
                    '=',
                    $request->product_id
                ],
                [
                    'status',
                    '=',
                    'pending'
                ]
            ])->first();

            if ($sale) {
                // Update existing sale
                $sale->quantity += $quantity;
                $sale->total += $product->price * $quantity;
                $sale->save();
            } else {
                // Create new sale
                Sale::create([
                    'wallet_id' => $wallet_id,
                    'product_id' => $request->product_id,
                    'status' => 'pending',
                    'quantity' => $quantity,
                    'total' => $product->price * $quantity
                ]);
            }

            return redirect()->back()->with('success', 'Book added to cart successfully!');
        } else {
            return redirect()->route('wallets-users.create')->with('error', 'Wallet not found. Please create a wallet first.');
        }
    }
    public function destroy($id)
    {
        $cart = Sale::find($id);
        if ($cart) {
            $cart->delete();
            return response()->json(['success' => true, 'message' => 'Item removed from cart successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Item not found in cart.'], 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the cart item using the provided ID
        $cart = Sale::find($id);
        if (!$cart) {
            return response()->json(['message' => 'Cart item not found.'], 404);
        }

        // Check if Product item exists
        $product = Product::find($cart->product_id);
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        // Update quantity and total
        $cart->quantity = $request->quantity;
        $cart->total = $cart->quantity * $product->price;

        // Save changes
        $cart->save();

        return response()->json(['message' => 'Quantity updated successfully.']);
    }
}
