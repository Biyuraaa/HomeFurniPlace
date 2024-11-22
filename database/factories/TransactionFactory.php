<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Sale;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'wallet_id' => Wallet::factory(),
            'sale_id' => Sale::factory(),
            'type' => 'purchase',
            'amount' => $this->faker->randomFloat(2, 10, 500), // Amount spent on purchase
        ];
    }
}
