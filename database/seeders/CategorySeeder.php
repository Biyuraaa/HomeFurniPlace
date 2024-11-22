<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create([
            'name' => 'Mirror',
            'description' => 'Mirror',
        ]);

        Category::create([
            'name' => 'Bed',
            'description' => 'Bed',
        ]);

        Category::create([
            'name' => 'Chair',
            'description' => 'Chair',
        ]);

        Category::create([
            'name' => 'Cushion',
            'description' => 'Cushion',
        ]);

        Category::create([
            'name' => 'Sofa',
            'description' => 'Sofa',
        ]);

        Category::create([
            'name' => 'Lamp',
            'description' => 'Lamp',
        ]);
    }
}
