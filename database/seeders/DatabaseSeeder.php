<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Courier;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Wallet;
use App\Models\Sale;
use App\Models\Transaction;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@admin.com',
        //     'password' => bcrypt('password'),
        //     'role' => 'admin',
        // ]);



        // // Ensure categories exist (create only if not present)
        // if (Category::count() === 0) {
        //     Category::create(['name' => 'Mirror', 'description' => 'Mirror']);
        //     Category::create(['name' => 'Bed', 'description' => 'Bed']);
        //     Category::create(['name' => 'Chair', 'description' => 'Chair']);
        //     Category::create(['name' => 'Cushion', 'description' => 'Cushion']);
        //     Category::create(['name' => 'Sofa', 'description' => 'Sofa']);
        //     Category::create(['name' => 'Lamp', 'description' => 'Lamp']);
        // }

        // // Generate 10 sellers with 15 products each
        // Seller::factory(10)
        //     ->has(Product::factory(15), 'products')
        //     ->create();

        // User::factory(10)
        //     ->create()
        //     ->each(function ($user) {
        //         // Create a wallet for each user
        //         $wallet = $user->wallet()->create([
        //             'balance' => rand(100, 1000),
        //         ]);

        //         // Create a customer record for the user
        //         $user->customer()->create();

        //         // Generate 5 sales for the user's wallet
        //         Sale::factory(5)
        //             ->create([
        //                 'wallet_id' => $wallet->id,
        //             ])
        //             ->each(function ($sale) {
        //                 // Create a transaction for each sale
        //                 Transaction::factory()->create([
        //                     'wallet_id' => $sale->wallet_id,
        //                     'sale_id' => $sale->id,
        //                     'type' => 'purchase',
        //                     'amount' => $sale->total,
        //                 ]);
        //             });
        //     });

        // $user = User::create([
        //     'name' => 'Seller',
        //     'email' => 'seller@seller.com',
        //     'password' => bcrypt('password'),
        //     'role' => 'seller',
        // ]);

        // Seller::create([
        //     'user_id' => $user->id,
        // ]);

        // Wallet::create([
        //     'user_id' => $user->id,
        //     'balance' => 0,
        // ]);

        // Courier::factory(5)->create();

        Wallet::create([
            'user_id' => 1,
            'balance' => 0,
        ]);
    }
}
