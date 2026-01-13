<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [

            // ================= MINUMAN (ID: 1) =================
            [
                'category_id' => 1,
                'name'        => 'Air Mineral Gelas',
                'description' => 'Air mineral segar kemasan gelas.',
                'price'       => 3000,
                'stock'       => 120,
            ],
            [
                'category_id' => 1,
                'name'        => 'Air Mineral Botol',
                'description' => 'Air mineral kemasan botol praktis.',
                'price'       => 5000,
                'stock'       => 100,
            ],
            [
                'category_id' => 1,
                'name'        => 'Es Teh Manis',
                'description' => 'Teh manis dingin menyegarkan.',
                'price'       => 4000,
                'stock'       => 80,
            ],
            [
                'category_id' => 1,
                'name'        => 'Jus Jeruk',
                'description' => 'Jus jeruk segar kaya vitamin C.',
                'price'       => 7000,
                'stock'       => 60,
            ],
            [
                'category_id' => 1,
                'name'        => 'Susu Kotak',
                'description' => 'Susu kotak bergizi untuk anak sekolah.',
                'price'       => 6000,
                'stock'       => 70,
            ],
            [
                'category_id' => 1,
                'name'        => 'Teh Botol',
                'description' => 'Teh botol siap minum.',
                'price'       => 5000,
                'stock'       => 90,
            ],

            // ================= SNACK SIAP SAJI (ID: 2) =================
            [
                'category_id' => 2,
                'name'        => 'Risol Mayo',
                'description' => 'Risol isi mayo dan daging.',
                'price'       => 5000,
                'stock'       => 50,
            ],
            [
                'category_id' => 2,
                'name'        => 'Sosis Goreng',
                'description' => 'Sosis goreng gurih.',
                'price'       => 4000,
                'stock'       => 60,
            ],
            [
                'category_id' => 2,
                'name'        => 'Tahu Crispy',
                'description' => 'Tahu goreng crispy.',
                'price'       => 4000,
                'stock'       => 70,
            ],
            [
                'category_id' => 2,
                'name'        => 'Bakwan Sayur',
                'description' => 'Bakwan sayur renyah.',
                'price'       => 3000,
                'stock'       => 80,
            ],
            [
                'category_id' => 2,
                'name'        => 'Nugget Goreng',
                'description' => 'Nugget ayam goreng siap saji.',
                'price'       => 6000,
                'stock'       => 55,
            ],
            [
                'category_id' => 2,
                'name'        => 'Cireng Isi',
                'description' => 'Cireng isi pedas.',
                'price'       => 4000,
                'stock'       => 65,
            ],

            // ================= SNACK KEMASAN (ID: 3) =================
            [
                'category_id' => 3,
                'name'        => 'Chiki Jagung',
                'description' => 'Snack jagung renyah kemasan.',
                'price'       => 5000,
                'stock'       => 100,
            ],
            [
                'category_id' => 3,
                'name'        => 'Biskuit Coklat',
                'description' => 'Biskuit coklat manis.',
                'price'       => 6000,
                'stock'       => 90,
            ],
            [
                'category_id' => 3,
                'name'        => 'Wafer Keju',
                'description' => 'Wafer keju renyah.',
                'price'       => 5000,
                'stock'       => 85,
            ],
            [
                'category_id' => 3,
                'name'        => 'Permen Buah',
                'description' => 'Permen aneka rasa buah.',
                'price'       => 3000,
                'stock'       => 120,
            ],
            [
                'category_id' => 3,
                'name'        => 'Coklat Batang',
                'description' => 'Coklat batang manis.',
                'price'       => 7000,
                'stock'       => 70,
            ],
            [
                'category_id' => 3,
                'name'        => 'Snack Kentang',
                'description' => 'Snack kentang gurih.',
                'price'       => 8000,
                'stock'       => 60,
            ],

            // ================= MAKANAN KERING (ID: 4) =================
            [
                'category_id' => 4,
                'name'        => 'Keripik Singkong',
                'description' => 'Keripik singkong renyah.',
                'price'       => 10000,
                'stock'       => 50,
            ],
            [
                'category_id' => 4,
                'name'        => 'Kerupuk Udang',
                'description' => 'Kerupuk udang siap goreng.',
                'price'       => 12000,
                'stock'       => 40,
            ],
            [
                'category_id' => 4,
                'name'        => 'Kacang Goreng',
                'description' => 'Kacang goreng gurih.',
                'price'       => 9000,
                'stock'       => 60,
            ],
            [
                'category_id' => 4,
                'name'        => 'Abon Sapi',
                'description' => 'Abon sapi kering.',
                'price'       => 20000,
                'stock'       => 30,
            ],
            [
                'category_id' => 4,
                'name'        => 'Emping Melinjo',
                'description' => 'Emping melinjo gurih.',
                'price'       => 15000,
                'stock'       => 35,
            ],
            [
                'category_id' => 4,
                'name'        => 'Keripik Pisang',
                'description' => 'Keripik pisang manis.',
                'price'       => 10000,
                'stock'       => 55,
            ],

            // ================= MAKANAN BASAH (ID: 5) =================
            [
                'category_id' => 5,
                'name'        => 'Kue Putu Ayu',
                'description' => 'Kue basah aroma pandan.',
                'price'       => 4000,
                'stock'       => 40,
            ],
            [
                'category_id' => 5,
                'name'        => 'Klepon',
                'description' => 'Klepon isi gula merah.',
                'price'       => 4000,
                'stock'       => 45,
            ],
            [
                'category_id' => 5,
                'name'        => 'Bolu Kukus',
                'description' => 'Bolu kukus lembut.',
                'price'       => 5000,
                'stock'       => 35,
            ],
            [
                'category_id' => 5,
                'name'        => 'Onde-onde',
                'description' => 'Onde-onde isi kacang hijau.',
                'price'       => 4000,
                'stock'       => 40,
            ],
            [
                'category_id' => 5,
                'name'        => 'Dadar Gulung',
                'description' => 'Dadar gulung isi kelapa.',
                'price'       => 4000,
                'stock'       => 30,
            ],
            [
                'category_id' => 5,
                'name'        => 'Lemper Ayam',
                'description' => 'Lemper ketan isi ayam.',
                'price'       => 6000,
                'stock'       => 25,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                [
                    'slug' => Str::slug($product['name']),
                ],
                [
                    'category_id' => $product['category_id'],
                    'name'        => $product['name'],
                    'slug'        => Str::slug($product['name']),
                    'description' => $product['description'],
                    'price'       => $product['price'],
                    'stock'       => $product['stock'],
                    'is_active'   => true,
                ]
            );
        }

        $this->command->info('✅ Products seeded sesuai kategori (6 produk per kategori)');
    }
}
