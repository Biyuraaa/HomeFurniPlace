<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Wallet;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    protected $model = Sale::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        $quantity = $this->faker->numberBetween(1, 3); // Purchase 1 to 3 of a product
        $total = $product->price * $quantity;

        return [
            'wallet_id' => Wallet::factory(), // Link to a user's wallet
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total' => $total,
            'status' => $this->faker->randomElement(['pending', 'purchased', 'confirmed', 'shipped', 'delivered', 'canceled']),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'created_at' => $this->faker->dateTimeBetween('-15 month'),
        ];
    }
}
