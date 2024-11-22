<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWalletRequest;
use App\Http\Requests\UpdateWalletRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'seller') {
            return view('dashboard.wallets.index', [
                'wallet' => Wallet::find(Auth::user()->wallet->id),
                'last_transactions' => Wallet::find(Auth::user()->wallet->id)->transactions->last(),
                'transactions' => Wallet::find(Auth::user()->wallet->id)->transactions
            ]);
        } else {
            return view('pages.wallets.index', [
                'categories' => Category::all(),
                'wallet' => Wallet::find(Auth::user()->wallet->id),
                'last_transactions' => Wallet::find(Auth::user()->wallet->id)->transactions->last(),
                'transactions' => Wallet::find(Auth::user()->wallet->id)->transactions
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'seller') {
            return view('dashboard.wallets.create');
        } else {
            $categories = Category::all();
            return view('pages.wallets.create', compact('categories'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWalletRequest $request)
    {
        $request->validated();

        Wallet::create($request->all());
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'seller') {
            return redirect()->route('wallets.index')->with('success', 'Wallet created successfully.');
        } else {
            return redirect()->route('wallets-users.index')->with('success', 'Wallet created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWalletRequest $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wallet $wallet)
    {
        //
    }

    public function storeDeposit(Request $request)
    {
        //
        $request->validate([
            'balance' => 'required|numeric|min:1'
        ]);

        $wallet = Wallet::find(Auth::user()->wallet->id);
        $wallet->balance += $request->balance;
        $wallet->save();

        Transaction::create([
            'wallet_id' => $wallet->id,
            'amount' => $request->balance,
            'type' => 'deposit'
        ]);
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'seller') {
            return redirect()->route('wallets.index')->with('success', 'Wallet balance updated successfully.');
        } else {
            return redirect()->route('wallets-users.index')->with('success', 'Wallet balance updated successfully.');
        }
    }
}
