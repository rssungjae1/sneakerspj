<?php
  
namespace Database\Seeders;
// php artisan db:seed --class=ProductSeeder
use Illuminate\Database\Seeder;
use App\Models\Product;
  
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Air Jordan 1 Retro High OG',
                'description' => 'Michael Jordan first basketball shoes for games. High.',
                'price' => 18000
            ],
            [
                'name' => 'Air Jordan 6 Chrome',
                'description' => 'Design motivated gundam.',
                'price' => 20000
            ],
            [
                'name' => 'Nike Dunk Low Retro Black',
                'description' => 'The cutest Killer whale',
                'price' => 28000
            ],
            [
                'name' => 'Nike Air Force 1 Low',
                'description' => 'Out of the original ones, the original.',
                'price' => 15000
            ],
            [
                'name' => 'OZWEEGO',
                'description' => 'Adidas Ozwigo iKONIC I-STAY and bold midsole line, which have been creating new trends since the late 1990s.',
                'price' => 15000
            ]
        ];
  
        foreach ($products as $key => $value) {
            Product::create($value);
        }
    }
}