<?php
// database/seeders/CategorySeeder.php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Minuman',
                'slug'        => 'minuman',
                'description' => 'Berbagai jenis minuman seperti air mineral, jus',
                'is_active'   => true,
            ],
            [
                'name'        => 'Snack Siap Saji',
                'slug'        => 'snack-siap-saji',
                'description' => 'Snack siap saji dan makanan ringan',
                'is_active'   => true,
            ],
            [
                'name'        => 'Snack Kemasan',
                'slug'        => 'snack-kemasan',
                'description' => 'Snack dalam kemasan dan makanan ringan',
                'is_active'   => true,
            ],
            [
                'name'        => 'Makanan Kering',
                'slug'        => 'makanan-kering',
                'description' => 'Berbagai makanan kering dan bahan makanan',
                'is_active'   => true,
            ],
            [
                'name'        => 'Makanan Basah',
                'slug'        => 'makanan-basah',
                'description' => 'Berbagai makanan basah dan bahan makanan',
                'is_active'   => true,
            ],
            
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('✅ Categories seeded successfully!');
    }
}