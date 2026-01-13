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
                'id'          => 1,
                'name'        => 'Minuman',
                'slug'        => 'minuman',
                'description' => 'Berbagai jenis minuman seperti air mineral dan jus',
                'is_active'   => true,
            ],
            [
                'id'          => 2,
                'name'        => 'Snack Siap Saji',
                'slug'        => 'snack-siap-saji',
                'description' => 'Snack siap saji dan makanan ringan',
                'is_active'   => true,
            ],
            [
                'id'          => 3,
                'name'        => 'Snack Kemasan',
                'slug'        => 'snack-kemasan',
                'description' => 'Snack dalam kemasan dan makanan ringan',
                'is_active'   => true,
            ],
            [
                'id'          => 4,
                'name'        => 'Makanan Kering',
                'slug'        => 'makanan-kering',
                'description' => 'Berbagai makanan kering',
                'is_active'   => true,
            ],
            [
                'id'          => 5,
                'name'        => 'Makanan Basah',
                'slug'        => 'makanan-basah',
                'description' => 'Berbagai makanan basah tradisional',
                'is_active'   => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['id' => $category['id']],
                $category
            );
        }

        $this->command->info('✅ Categories seeded with fixed IDs!');
    }
}
